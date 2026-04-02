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
            'site_tagline' => 'Agence de transformation numérique',
            'site_tagline_en' => 'Digital transformation agency',
            'footer_text' => 'Nous développons des solutions web modernes pour accompagner les entreprises dans leur transformation digitale.',
            'footer_text_en' => 'We build modern digital solutions to support companies throughout their digital transformation.',
            'home_meta_title' => 'Yokkute Labs - Agence de transformation numérique',
            'home_meta_title_en' => 'Yokkute Labs - Digital transformation agency',
            'home_badge_text' => 'Yokkute Labs - Agence de transformation numérique',
            'home_badge_text_en' => 'Yokkute Labs - Digital transformation agency',
            'home_hero_title' => "Transformez votre entreprise\nà l'ère du numérique\net de l'IA",
            'home_hero_title_en' => "Transform your company\nfor the digital\nand AI era",
            'home_hero_sub' => "Nous accompagnons les entreprises africaines, de l'audit initial à l'intégration de l'intelligence artificielle, avec des solutions concrètes, adaptées à votre réalité de terrain.",
            'home_hero_sub_en' => 'We help African businesses move from initial audit to AI integration with practical solutions tailored to real operational constraints.',
            'home_primary_cta_label' => 'Démarrer avec un audit gratuit',
            'home_primary_cta_label_en' => 'Start with a free audit',
            'home_primary_cta_url' => '/contact',
            'home_primary_cta_url_en' => '/contact',
            'home_secondary_cta_label' => 'Voir notre approche',
            'home_secondary_cta_label_en' => 'See our approach',
            'home_secondary_cta_url' => '#approche',
            'home_secondary_cta_url_en' => '#approche',
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
