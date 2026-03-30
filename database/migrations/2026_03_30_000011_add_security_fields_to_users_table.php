<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->timestamp('password_changed_at')->nullable()->after('password');
            $table->boolean('force_password_reset')->default(false)->after('is_admin');
            $table->unsignedSmallInteger('failed_admin_logins')->default(0)->after('force_password_reset');
            $table->timestamp('admin_locked_until')->nullable()->after('failed_admin_logins');
            $table->timestamp('last_admin_login_at')->nullable()->after('admin_locked_until');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'password_changed_at',
                'force_password_reset',
                'failed_admin_logins',
                'admin_locked_until',
                'last_admin_login_at',
            ]);
        });
    }
};