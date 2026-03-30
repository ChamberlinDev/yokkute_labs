<?php

namespace App\Http\Middleware;

use App\Support\AdminAudit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionSecurityMiddleware
{
    private const PASSWORD_EXEMPT_ROUTES = [
        'admin.password.edit',
        'admin.password.update',
        'admin.logout',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $session = $request->session();
        $timeoutSeconds = max((int) env('ADMIN_IDLE_TIMEOUT', 900), 300);
        $lastActivity = (int) $session->get('admin_last_activity_at', 0);

        if ($lastActivity > 0 && (time() - $lastActivity) > $timeoutSeconds) {
            AdminAudit::record($request, 'admin.session.expired', [
                'status_code' => 440,
                'idle_timeout_seconds' => $timeoutSeconds,
            ]);

            Auth::logout();
            $session->invalidate();
            $session->regenerateToken();

            return redirect()
                ->route('admin.login')
                ->withErrors(['email' => 'Session admin expiree apres inactivite.']);
        }

        $session->put('admin_last_activity_at', time());

        $user = $request->user();
        $maxAgeDays = max((int) env('ADMIN_PASSWORD_MAX_AGE_DAYS', 90), 30);
        $mustRotate = false;

        if ($user?->is_admin) {
            if ($user->force_password_reset) {
                $mustRotate = true;
            } elseif ($user->password_changed_at) {
                $mustRotate = $user->password_changed_at->lt(now()->subDays($maxAgeDays));
            }
        }

        if ($mustRotate && !in_array((string) $request->route()?->getName(), self::PASSWORD_EXEMPT_ROUTES, true)) {
            AdminAudit::record($request, 'admin.password.rotation.required', [
                'status_code' => 302,
                'password_max_age_days' => $maxAgeDays,
            ]);

            return redirect()
                ->route('admin.password.edit')
                ->withErrors(['password' => 'Rotation de mot de passe requise pour continuer.']);
        }

        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Thu, 01 Jan 1970 00:00:00 GMT');

        return $response;
    }
}