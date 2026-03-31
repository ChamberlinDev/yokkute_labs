<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Seed site settings without overwriting existing production values.
     */
    public function run(): void
    {
        $defaults = [
            'site_name' => 'Yokkute Labs',
            'site_tagline' => 'Agence de transformation numerique',
            'footer_text' => 'Nous developpons des solutions web modernes pour accompagner les entreprises dans leur transformation digitale.',
            'home_meta_title' => 'Yokkute Labs - Agence de transformation numerique',
            'home_badge_text' => 'Yokkute Labs - Agence de transformation numerique',
            'home_hero_title' => "Transformez votre entreprise\na l'ere du numerique\net de l'IA",
            'home_hero_sub' => "Nous accompagnons les entreprises africaines - de l'audit initial a l'integration de l'intelligence artificielle - avec des solutions concretes, adaptees a votre realite terrain.",
            'home_primary_cta_label' => 'Demarrer avec un audit gratuit',
            'home_primary_cta_url' => '/contact',
            'home_secondary_cta_label' => 'Voir notre approche',
            'home_secondary_cta_url' => '#approche',
            'contact_email' => 'solution@yokkutelabs.com',
            'rh_email' => 'solution@yokkutelabs.com',
            'mail_notifications_enabled' => '1',
            'contact_notification_email' => 'solution@yokkutelabs.com',
            'rh_notification_email' => 'solution@yokkutelabs.com',
            'contact_phone' => '+221 771488937',
            'contact_phone_href' => '+221771488937',
            'whatsapp_number' => '221771488937',
            'contact_address' => 'Dakar, Senegal',
            'linkedin_url' => '#',
            'facebook_url' => '#',
            'instagram_url' => '#',
            'twitter_url' => '#',
            'logo_path' => 'images/logo-yokkute.png',
        ];

        foreach ($defaults as $key => $value) {
            SiteSetting::query()->firstOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
