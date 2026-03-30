<?php

namespace App\Http\Middleware;

use App\Support\AdminAudit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuditMiddleware
{
    private const LOGGABLE_GET_ROUTES = [
        'admin.candidatures.export.csv',
        'admin.contact-messages.export.csv',
        'admin.candidatures.cv.download',
        'admin.security.logs',
        'admin.security.alerts',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldLog($request)) {
            AdminAudit::record($request, 'admin.route', [
                'status_code' => $response->getStatusCode(),
                'query' => $request->query(),
            ]);
        }

        return $response;
    }

    private function shouldLog(Request $request): bool
    {
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return true;
        }

        return in_array((string) $request->route()?->getName(), self::LOGGABLE_GET_ROUTES, true);
    }
}