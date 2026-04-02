<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAuditLog;
use App\Models\User;
use App\Support\AdminAudit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SecurityController extends Controller
{
    public function alerts(): View
    {
        $now = now();
        $maxAgeDays = max((int) env('ADMIN_PASSWORD_MAX_AGE_DAYS', 90), 30);

        $lockedAdmins = User::query()
            ->where('is_admin', true)
            ->whereNotNull('admin_locked_until')
            ->where('admin_locked_until', '>', $now)
            ->orderBy('admin_locked_until')
            ->get(['id', 'name', 'email', 'failed_admin_logins', 'admin_locked_until']);

        $passwordRotationRiskAdmins = User::query()
            ->where('is_admin', true)
            ->where(function (Builder $builder) use ($maxAgeDays): void {
                $builder
                    ->where('force_password_reset', true)
                    ->orWhereNull('password_changed_at')
                    ->orWhere('password_changed_at', '<=', now()->subDays($maxAgeDays));
            })
            ->orderBy('email')
            ->get(['id', 'name', 'email', 'force_password_reset', 'password_changed_at']);

        $failedAttemptsByEmail = AdminAuditLog::query()
            ->select('user_email', DB::raw('COUNT(*) as attempts'))
            ->whereIn('action', ['admin.login.failed', 'admin.login.locked', 'admin.login.alert.threshold'])
            ->where('created_at', '>=', $now->copy()->subDay())
            ->whereNotNull('user_email')
            ->groupBy('user_email')
            ->orderByDesc('attempts')
            ->limit(20)
            ->get();

        $failedAttemptsByIp = AdminAuditLog::query()
            ->select('ip_address', DB::raw('COUNT(*) as attempts'))
            ->whereIn('action', ['admin.login.failed', 'admin.login.locked', 'admin.login.alert.threshold'])
            ->where('created_at', '>=', $now->copy()->subDay())
            ->whereNotNull('ip_address')
            ->groupBy('ip_address')
            ->orderByDesc('attempts')
            ->limit(20)
            ->get();

        return view('admin.security.alerts', [
            'lockedAdmins' => $lockedAdmins,
            'passwordRotationRiskAdmins' => $passwordRotationRiskAdmins,
            'failedAttemptsByEmail' => $failedAttemptsByEmail,
            'failedAttemptsByIp' => $failedAttemptsByIp,
            'passwordMaxAgeDays' => $maxAgeDays,
        ]);
    }

    public function logs(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $action = trim((string) $request->query('action', ''));

        $query = AdminAuditLog::query()->latest();

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $like = '%'.$search.'%';
                $builder
                    ->where('user_email', 'like', $like)
                    ->orWhere('action', 'like', $like)
                    ->orWhere('route', 'like', $like)
                    ->orWhere('ip_address', 'like', $like)
                    ->orWhere('target_type', 'like', $like)
                    ->orWhere('target_id', 'like', $like);
            });
        }

        if ($action !== '') {
            $query->where('action', $action);
        }

        return view('admin.security.logs', [
            'events' => $query->paginate(50)->withQueryString(),
            'filters' => [
                'q' => $search,
                'action' => $action,
            ],
            'actions' => AdminAuditLog::query()->select('action')->distinct()->orderBy('action')->pluck('action')->all(),
        ]);
    }

    public function editPassword(): View
    {
        $user = Auth::user();
        $changedAt = $user?->password_changed_at;
        $passwordAgeDays = $changedAt ? (int) $changedAt->diffInDays(now()) : null;

        return view('admin.security.password', [
            'passwordAgeDays' => $passwordAgeDays,
            'passwordMaxAgeDays' => max((int) env('ADMIN_PASSWORD_MAX_AGE_DAYS', 90), 30),
            'mustRotate' => (bool) ($user?->force_password_reset),
        ]);
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::min(12)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $user = $request->user();

        if (!$user) {
            return redirect()->route('admin.login');
        }

        if (Hash::check($validated['password'], (string) $user->password)) {
            return back()->withErrors([
                'password' => 'Le nouveau mot de passe doit être différent de l\'ancien.',
            ]);
        }

        $user->forceFill([
            'password' => $validated['password'],
            'password_changed_at' => now(),
            'force_password_reset' => false,
            'failed_admin_logins' => 0,
            'admin_locked_until' => null,
        ])->save();

        $request->session()->regenerate();
        $request->session()->put('admin_last_activity_at', time());

        AdminAudit::record($request, 'admin.password.changed', [
            'status_code' => 302,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Mot de passe admin mis à jour avec succès.');
    }
}
