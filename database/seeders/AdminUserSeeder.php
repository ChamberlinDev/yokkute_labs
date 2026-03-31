<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = $this->adminConfig();
        $this->assertValidAdminConfig($admin);

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

    /**
     * @param array{name: string, email: string, password: string, force_password_reset: bool} $admin
     */
    private function assertValidAdminConfig(array $admin): void
    {
        $errors = [];

        if ($admin['name'] === '') {
            $errors[] = 'ADMIN_DEFAULT_NAME doit etre defini dans .env.production.';
        } elseif (mb_strlen($admin['name']) > 255) {
            $errors[] = 'ADMIN_DEFAULT_NAME ne doit pas depasser 255 caracteres.';
        }

        if ($admin['email'] === '') {
            $errors[] = 'ADMIN_DEFAULT_EMAIL doit etre defini dans .env.production.';
        } elseif (!filter_var($admin['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'ADMIN_DEFAULT_EMAIL doit contenir une adresse e-mail valide.';
        } elseif (mb_strlen($admin['email']) > 255) {
            $errors[] = 'ADMIN_DEFAULT_EMAIL ne doit pas depasser 255 caracteres.';
        }

        $password = $admin['password'];

        if ($password === '') {
            $errors[] = 'ADMIN_DEFAULT_PASSWORD doit etre defini dans .env.production.';
        } else {
            if (mb_strlen($password) < 12) {
                $errors[] = 'ADMIN_DEFAULT_PASSWORD doit contenir au moins 12 caracteres.';
            }

            if (!preg_match('/[a-z]/', $password)) {
                $errors[] = 'ADMIN_DEFAULT_PASSWORD doit contenir au moins une lettre minuscule.';
            }

            if (!preg_match('/[A-Z]/', $password)) {
                $errors[] = 'ADMIN_DEFAULT_PASSWORD doit contenir au moins une lettre majuscule.';
            }

            if (!preg_match('/\d/', $password)) {
                $errors[] = 'ADMIN_DEFAULT_PASSWORD doit contenir au moins un chiffre.';
            }

            if (!preg_match('/[^A-Za-z0-9]/', $password)) {
                $errors[] = 'ADMIN_DEFAULT_PASSWORD doit contenir au moins un symbole.';
            }
        }

        if ($errors !== []) {
            throw new RuntimeException(implode(' ', $errors));
        }
    }
}
