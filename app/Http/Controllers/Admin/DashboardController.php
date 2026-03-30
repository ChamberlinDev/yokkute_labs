<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAuditLog;
use App\Models\Candidature;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = now()->startOfDay();

        return view('admin.dashboard', [
            'stats' => [
                'services' => Service::query()->count(),
                'team' => TeamMember::query()->count(),
                'candidatures' => Candidature::query()->count(),
                'contactMessages' => ContactMessage::query()->count(),
                'securityEvents' => AdminAuditLog::query()->count(),
                'failedLoginsToday' => AdminAuditLog::query()
                    ->whereIn('action', ['admin.login.failed', 'admin.login.alert.threshold', 'admin.login.locked'])
                    ->where('created_at', '>=', $today)
                    ->count(),
                'candidaturesToProcessToday' => Candidature::query()
                    ->whereIn('status', ['new', 'reviewed'])
                    ->where('created_at', '>=', $today)
                    ->count(),
                'messagesToProcessToday' => ContactMessage::query()
                    ->whereIn('status', ['new', 'in_progress'])
                    ->where('created_at', '>=', $today)
                    ->count(),
            ],
            'latestCandidatures' => Candidature::query()->latest()->take(5)->get(),
            'latestMessages' => ContactMessage::query()->latest()->take(5)->get(),
            'latestSecurityEvents' => AdminAuditLog::query()->latest()->take(8)->get(),
        ]);
    }
}