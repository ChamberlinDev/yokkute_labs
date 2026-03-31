<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        view()->composer('*', function ($view): void {
            static $settings = null;

            if ($settings === null) {
                try {
                    $settings = Schema::hasTable('site_settings') ? SiteSetting::asArray() : [];
                } catch (\Throwable $exception) {
                    $settings = [];
                }
            }

            $view->with('siteSettings', $settings);
        });
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('admin-login', function (Request $request): array {
            $email = Str::lower(trim((string) $request->input('email', 'guest')));

            return [
                Limit::perMinute(5)->by($email.'|'.$request->ip()),
                Limit::perHour(25)->by($request->ip()),
            ];
        });

        RateLimiter::for('admin-actions', fn (Request $request): Limit => Limit::perMinute(120)
            ->by(($request->user()?->id ?? 'guest').'|'.$request->ip()));

        RateLimiter::for('contact-form', fn (Request $request): array => [
            Limit::perMinute(5)->by($request->ip()),
            Limit::perHour(20)->by($request->ip()),
        ]);

        RateLimiter::for('candidature-form', fn (Request $request): array => [
            Limit::perMinute(4)->by($request->ip()),
            Limit::perHour(12)->by($request->ip()),
        ]);

        RateLimiter::for('chatbot', fn (Request $request): array => [
            Limit::perMinute(40)->by($request->ip()),
            Limit::perHour(600)->by($request->ip()),
        ]);
    }
}
