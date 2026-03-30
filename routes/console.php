<?php

use App\Models\AdminAuditLog;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:audit-prune', function () {
    $days = max((int) env('ADMIN_AUDIT_RETENTION_DAYS', 180), 30);
    $deleted = AdminAuditLog::query()
        ->where('created_at', '<', now()->subDays($days))
        ->delete();

    $this->info("Admin audit logs pruned: {$deleted} row(s) deleted (retention {$days} days).");
})->purpose('Prune old admin audit logs.');

Schedule::command('admin:audit-prune')->dailyAt(env('ADMIN_AUDIT_PRUNE_AT', '03:10'));
