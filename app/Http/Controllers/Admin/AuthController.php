<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\AdminAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()?->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $maxAttempts = max((int) env('ADMIN_LOGIN_MAX_FAILED_ATTEMPTS', 5), 3);
        $lockMinutes = max((int) env('ADMIN_LOGIN_LOCK_MINUTES', 15), 5);

        $credentials = [
            'email' => Str::lower(trim((string) $validated['email'])),
            'password' => trim((string) $validated['password']),
        ];

        $user = User::query()->where('email', $credentials['email'])->first();

        if ($user?->is_admin && $user->admin_locked_until && $user->admin_locked_until->isFuture()) {
            AdminAudit::record($request, 'admin.login.locked', [
                'status_code' => 423,
                'email' => $credentials['email'],
                'locked_until' => $user->admin_locked_until->toDateTimeString(),
            ]);

            return back()->withErrors([
                'email' => 'Compte admin temporairement verrouillé. Réessayez plus tard.',
            ])->onlyInput('email');
        }

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            if ($user?->is_admin) {
                $failedCount = ((int) $user->failed_admin_logins) + 1;

                $user->forceFill([
                    'failed_admin_logins' => $failedCount,
                    'admin_locked_until' => $failedCount >= $maxAttempts ? now()->addMinutes($lockMinutes) : null,
                ])->save();

                if ($failedCount >= $maxAttempts) {
                    AdminAudit::record($request, 'admin.login.alert.threshold', [
                        'status_code' => 423,
                        'email' => $credentials['email'],
                        'failed_attempts' => $failedCount,
                        'lock_minutes' => $lockMinutes,
                    ]);
                }
            }

            AdminAudit::record($request, 'admin.login.failed', [
                'status_code' => 422,
                'email' => $credentials['email'],
            ]);

            return back()->withErrors([
                'email' => 'Identifiants invalides.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        if (!Auth::user()?->is_admin) {
            AdminAudit::record($request, 'admin.login.rejected', [
                'status_code' => 403,
                'email' => $credentials['email'],
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Accès admin refusé.',
            ])->onlyInput('email');
        }

        /** @var User $admin */
        $admin = Auth::user();

        $admin->forceFill([
            'failed_admin_logins' => 0,
            'admin_locked_until' => null,
            'last_admin_login_at' => now(),
            'password_changed_at' => $admin->password_changed_at ?? now(),
        ])->save();

        $request->session()->put('admin_last_activity_at', time());
        AdminAudit::record($request, 'admin.login.success', [
            'status_code' => 302,
            'remember' => $request->boolean('remember'),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        AdminAudit::record($request, 'admin.logout', [
            'status_code' => 302,
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
