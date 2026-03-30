<?php

namespace App\Support;

use App\Models\AdminAuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AdminAudit
{
    public static function record(Request $request, string $action, array $context = []): void
    {
        try {
            $user = Auth::user();
            $route = $request->route();
            [$targetType, $targetId] = self::resolveTarget($route?->parametersWithoutNulls() ?? []);

            AdminAuditLog::query()->create([
                'user_id' => $user?->id,
                'user_email' => $user?->email,
                'action' => $action,
                'method' => $request->method(),
                'route' => $route?->getName() ?? $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => self::truncate($request->userAgent(), 500),
                'target_type' => $targetType,
                'target_id' => $targetId,
                'status_code' => isset($context['status_code']) ? (int) $context['status_code'] : null,
                'context' => $context,
            ]);
        } catch (Throwable) {
            // Security logging must never break the request flow.
        }
    }

    private static function resolveTarget(array $parameters): array
    {
        foreach ($parameters as $key => $value) {
            if (is_object($value) && method_exists($value, 'getKey')) {
                return [class_basename($value), (string) $value->getKey()];
            }

            if (is_scalar($value)) {
                return [(string) $key, (string) $value];
            }
        }

        return [null, null];
    }

    private static function truncate(?string $value, int $max): ?string
    {
        if ($value === null) {
            return null;
        }

        return mb_substr($value, 0, $max);
    }
}