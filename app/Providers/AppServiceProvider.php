<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        URL::defaults(['locale' => app()->getLocale()]);

        view()->share('versionedAsset', static function (string $path): string {
            $fullPath = public_path($path);
            $version = is_file($fullPath) ? filemtime($fullPath) : null;

            return asset($path).($version ? '?v='.$version : '');
        });

        view()->share('supportedLocales', [
            'fr' => 'FR',
            'en' => 'EN',
        ]);

        view()->share('switchLocaleUrl', static function (string $targetLocale): string {
            $targetLocale = in_array($targetLocale, ['fr', 'en'], true) ? $targetLocale : 'fr';
            $route = request()->route();
            $routeName = $route?->getName();

            if ($routeName === null || str_starts_with($routeName, 'admin.')) {
                return route('home', ['locale' => $targetLocale]);
            }

            $parameters = $route->parameters();
            $parameters['locale'] = $targetLocale;

            return route($routeName, $parameters + request()->query());
        });

        view()->share('localizedSetting', static function (array $settings, string $key, ?string $translationKey = null): string {
            $locale = app()->getLocale();
            $baseValue = trim((string) ($settings[$key] ?? ''));
            $localizedValue = trim((string) ($settings[$key.'_'.$locale] ?? ''));

            if ($locale !== 'fr' && $localizedValue !== '') {
                return $localizedValue;
            }

            if ($locale !== 'fr' && $translationKey !== null && Lang::hasForLocale($translationKey, $locale)) {
                return (string) trans($translationKey, [], $locale);
            }

            if ($baseValue !== '') {
                return $baseValue;
            }

            if ($translationKey !== null && Lang::hasForLocale($translationKey, $locale)) {
                return (string) trans($translationKey, [], $locale);
            }

            return '';
        });

        view()->share('localizedUrl', static function (string $url): string {
            $url = trim($url);

            if ($url === '' || str_starts_with($url, '#')) {
                return $url;
            }

            if (preg_match('~^(?:https?:|mailto:|tel:)~i', $url) === 1) {
                return $url;
            }

            if (!str_starts_with($url, '/')) {
                return $url;
            }

            if (preg_match('~^/(fr|en)(?:/|$)~', $url) === 1 || str_starts_with($url, '/admin')) {
                return $url;
            }

            return '/'.app()->getLocale().$url;
        });

        view()->share('localizedServiceField', static function (Service $service, string $field) {
            $locale = app()->getLocale();
            $translationKey = 'site.services.items.'.$service->slug.'.'.$field;

            if ($locale !== 'fr') {
                $localizedField = $field.'_'.$locale;
                $localizedValue = $service->{$localizedField} ?? null;

                if (is_string($localizedValue) && trim($localizedValue) !== '') {
                    return $localizedValue;
                }

                if ($localizedValue !== null && $localizedValue !== '') {
                    return $localizedValue;
                }

                if (Lang::hasForLocale($translationKey, $locale)) {
                    return trans($translationKey, [], $locale);
                }
            }

            return $service->{$field};
        });

        view()->share('localizedServiceDeliverables', static function (Service $service): array {
            $locale = app()->getLocale();
            $translationKey = 'site.services.items.'.$service->slug.'.deliverables';

            if ($locale !== 'fr') {
                $localizedField = 'deliverables_'.$locale;
                $localizedDeliverables = $service->{$localizedField} ?? null;

                if (is_array($localizedDeliverables) && !empty($localizedDeliverables)) {
                    return $localizedDeliverables;
                }

                $translated = trans($translationKey, [], $locale);

                if (is_array($translated)) {
                    return $translated;
                }
            }

            return is_array($service->deliverables) ? $service->deliverables : [];
        });

        view()->share('localizedTeamField', static function (TeamMember $member, string $field) {
            $locale = app()->getLocale();

            if ($locale !== 'fr') {
                $localizedField = $field.'_'.$locale;
                $localizedValue = $member->{$localizedField} ?? null;

                if (is_string($localizedValue) && trim($localizedValue) !== '') {
                    return $localizedValue;
                }

                if ($localizedValue !== null && $localizedValue !== '') {
                    return $localizedValue;
                }
            }

            return $member->{$field};
        });

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
