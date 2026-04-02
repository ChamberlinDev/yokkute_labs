<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CandidatureController as AdminCandidatureController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$preferredLocale = static function (Request $request): string {
    $sessionLocale = $request->session()->get('locale');

    if (is_string($sessionLocale) && in_array($sessionLocale, ['fr', 'en'], true)) {
        return $sessionLocale;
    }

    return $request->getPreferredLanguage(['fr', 'en']) ?: 'fr';
};

$redirectToLocalizedRoute = static function (string $routeName) use ($preferredLocale) {
    return static function (Request $request) use ($preferredLocale, $routeName) {
        return redirect()->route($routeName, ['locale' => $preferredLocale($request)]);
    };
};

Route::get('/', $redirectToLocalizedRoute('home'))->name('landing');
Route::get('/contact', $redirectToLocalizedRoute('contact'));
Route::get('/a-propos', $redirectToLocalizedRoute('about'));
Route::get('/services', $redirectToLocalizedRoute('services'));
Route::get('/rejoindre', $redirectToLocalizedRoute('rejoindre'));
Route::get('/faq', $redirectToLocalizedRoute('faq'));
Route::get('/rgpd', $redirectToLocalizedRoute('rgpd'));

Route::prefix('{locale}')
    ->whereIn('locale', ['fr', 'en'])
    ->middleware('set.locale')
    ->group(function (): void {
        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::post('/contact', [ContactMessageController::class, 'store'])
            ->middleware('throttle:contact-form')
            ->name('contact.store');
        Route::get('/a-propos', [PageController::class, 'about'])->name('about');
        Route::get('/services', [PageController::class, 'services'])->name('services');
        Route::get('/rejoindre', [PageController::class, 'rejoindre'])->name('rejoindre');

        Route::post('/rejoindre', [CandidatureController::class, 'store'])
            ->middleware('throttle:candidature-form')
            ->name('rejoindre.store');
        Route::get('/faq', [PageController::class, 'faq'])->name('faq');
        Route::get('/rgpd', [PageController::class, 'rgpd'])->name('rgpd');

        Route::post('/chatbot/message', [ChatbotController::class, 'message'])
            ->middleware('throttle:chatbot')
            ->name('chatbot.message');
    });

Route::prefix('admin')->group(function (): void {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'store'])
        ->middleware('throttle:admin-login')
        ->name('admin.login.store');

    Route::middleware(['admin', 'admin.session.security', 'admin.audit', 'throttle:admin-actions'])->group(function (): void {
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
        Route::get('/', DashboardController::class)->name('admin.dashboard');
        Route::get('/security/logs', [SecurityController::class, 'logs'])->name('admin.security.logs');
        Route::get('/security/alerts', [SecurityController::class, 'alerts'])->name('admin.security.alerts');
        Route::get('/security/password', [SecurityController::class, 'editPassword'])->name('admin.password.edit');
        Route::put('/security/password', [SecurityController::class, 'updatePassword'])->name('admin.password.update');

        Route::resource('services', AdminServiceController::class)->names('admin.services')->except(['show']);
        Route::resource('team', TeamMemberController::class)->names('admin.team')->parameters(['team' => 'team'])->except(['show']);

        Route::get('/candidatures', [AdminCandidatureController::class, 'index'])->name('admin.candidatures.index');
        Route::get('/candidatures/export/csv', [AdminCandidatureController::class, 'exportCsv'])->name('admin.candidatures.export.csv');
        Route::get('/candidatures/{candidature}', [AdminCandidatureController::class, 'show'])->name('admin.candidatures.show');
        Route::get('/candidatures/{candidature}/cv', [AdminCandidatureController::class, 'downloadCv'])->name('admin.candidatures.cv.download');
        Route::patch('/candidatures/{candidature}', [AdminCandidatureController::class, 'update'])->name('admin.candidatures.update');
        Route::delete('/candidatures/{candidature}', [AdminCandidatureController::class, 'destroy'])->name('admin.candidatures.destroy');

        Route::get('/contact-messages', [AdminContactMessageController::class, 'index'])->name('admin.contact-messages.index');
        Route::get('/contact-messages/export/csv', [AdminContactMessageController::class, 'exportCsv'])->name('admin.contact-messages.export.csv');
        Route::get('/contact-messages/{message}', [AdminContactMessageController::class, 'show'])->name('admin.contact-messages.show');
        Route::patch('/contact-messages/{message}', [AdminContactMessageController::class, 'update'])->name('admin.contact-messages.update');
        Route::delete('/contact-messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');

        Route::get('/settings', [SiteSettingController::class, 'edit'])->name('admin.settings.edit');
        Route::put('/settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');
    });
});
