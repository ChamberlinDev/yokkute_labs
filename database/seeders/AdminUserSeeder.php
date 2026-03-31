<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = $this->adminConfig();

        Validator::make($admin, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => [
                'required',
                'string',
                Password::min(12)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'force_password_reset' => ['required', 'boolean'],
        ], [
            'name.required' => 'ADMIN_DEFAULT_NAME doit etre defini dans .env.production.',
            'email.required' => 'ADMIN_DEFAULT_EMAIL doit etre defini dans .env.production.',
            'password.required' => 'ADMIN_DEFAULT_PASSWORD doit etre defini dans .env.production.',
        ])->validate();

        $user = User::query()
            ->whereRaw('LOWER(email) = ?', [$admin['email']])
            ->first() ?? new User();

        $passwordChanged = !$user->exists || !Hash::check($admin['password'], (string) $user->password);

        $user->forceFill([
            'name' => $admin['name'],
            'email' => $admin['email'],
            'is_admin' => true,
            'force_password_reset' => $admin['force_password_reset'],
            'failed_admin_logins' => 0,
            'admin_locked_until' => null,
        ]);

        if ($passwordChanged) {
            $user->password = $admin['password'];
            $user->password_changed_at = now();
        } elseif (!$user->password_changed_at) {
            $user->password_changed_at = now();
        }

        $user->save();
    }

    /**
     * @return array{name: string, email: string, password: string, force_password_reset: bool}
     */
    private function adminConfig(): array
    {
        $isProduction = app()->environment('production');

        $name = trim((string) env('ADMIN_DEFAULT_NAME', $isProduction ? '' : 'Admin Yokkute'));
        $email = mb_strtolower(trim((string) env('ADMIN_DEFAULT_EMAIL', $isProduction ? '' : 'admin@yokkute.com')));
        $password = (string) env('ADMIN_DEFAULT_PASSWORD', $isProduction ? '' : 'Admin12345!');

        $forcePasswordResetRaw = env('ADMIN_FORCE_PASSWORD_RESET', $isProduction ? null : 'false');

        if ($forcePasswordResetRaw === null || $forcePasswordResetRaw === '') {
            throw new RuntimeException('ADMIN_FORCE_PASSWORD_RESET doit etre defini dans .env.production.');
        }

        $forcePasswordReset = filter_var($forcePasswordResetRaw, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($forcePasswordReset === null) {
            throw new RuntimeException('ADMIN_FORCE_PASSWORD_RESET doit etre true ou false dans .env.production.');
        }

        return [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'force_password_reset' => $forcePasswordReset,
        ];
    }
}
