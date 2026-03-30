<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\PublicUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => SiteSetting::asArray(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->merge([
            'linkedin_url' => $this->normalizeOptionalUrl($request->input('linkedin_url')),
            'facebook_url' => $this->normalizeOptionalUrl($request->input('facebook_url')),
            'instagram_url' => $this->normalizeOptionalUrl($request->input('instagram_url')),
            'twitter_url' => $this->normalizeOptionalUrl($request->input('twitter_url')),
            'contact_notification_email' => $this->normalizeOptionalEmail($request->input('contact_notification_email')),
            'rh_notification_email' => $this->normalizeOptionalEmail($request->input('rh_notification_email')),
            'mail_notifications_enabled' => $request->boolean('mail_notifications_enabled') ? '1' : '0',
        ]);

        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'footer_text' => ['nullable', 'string'],
            'home_meta_title' => ['required', 'string', 'max:255'],
            'home_badge_text' => ['required', 'string', 'max:255'],
            'home_hero_title' => ['required', 'string'],
            'home_hero_sub' => ['required', 'string'],
            'home_primary_cta_label' => ['required', 'string', 'max:255'],
            'home_primary_cta_url' => ['required', 'string', 'max:255'],
            'home_secondary_cta_label' => ['required', 'string', 'max:255'],
            'home_secondary_cta_url' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'max:255'],
            'rh_email' => ['required', 'email', 'max:255'],
            'mail_notifications_enabled' => ['required', 'in:0,1'],
            'contact_notification_email' => ['nullable', 'email', 'max:255'],
            'rh_notification_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'contact_phone_href' => ['required', 'string', 'max:50'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'contact_address' => ['required', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        $settings = SiteSetting::asArray();

        if ($request->hasFile('logo')) {
            PublicUploads::delete($settings['logo_path'] ?? null);
            $validated['logo_path'] = PublicUploads::store($request->file('logo'), 'branding');
        }

        foreach ($validated as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Reglages mis a jour avec succes.');
    }

    private function normalizeOptionalUrl(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (!preg_match('~^https?://~i', $value)) {
            $value = 'https://' . ltrim($value, '/');
        }

        return $value;
    }

    private function normalizeOptionalEmail(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        return $value;
    }
}