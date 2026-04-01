<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $replacements = [
            'site_tagline' => [
                'Agence de transformation numerique',
                'Agence de transformation numérique',
            ],
            'footer_text' => [
                'Nous developpons des solutions web modernes pour accompagner les entreprises dans leur transformation digitale.',
                'Nous développons des solutions web modernes pour accompagner les entreprises dans leur transformation digitale.',
            ],
            'home_meta_title' => [
                'Yokkute Labs - Agence de transformation numerique',
                'Yokkute Labs - Agence de transformation numérique',
            ],
            'home_badge_text' => [
                'Yokkute Labs - Agence de transformation numerique',
                'Yokkute Labs - Agence de transformation numérique',
            ],
            'home_hero_title' => [
                "Transformez votre entreprise\na l'ere du numerique\net de l'IA",
                "Transformez votre entreprise\nà l'ère du numérique\net de l'IA",
            ],
            'home_hero_sub' => [
                "Nous accompagnons les entreprises africaines - de l'audit initial a l'integration de l'intelligence artificielle - avec des solutions concretes, adaptees a votre realite terrain.",
                "Nous accompagnons les entreprises africaines, de l'audit initial à l'intégration de l'intelligence artificielle, avec des solutions concrètes, adaptées à votre réalité de terrain.",
            ],
            'home_primary_cta_label' => [
                'Demarrer avec un audit gratuit',
                'Démarrer avec un audit gratuit',
            ],
        ];

        foreach ($replacements as $key => [$from, $to]) {
            DB::table('site_settings')
                ->where('key', $key)
                ->where('value', $from)
                ->update(['value' => $to]);
        }
    }

    public function down(): void
    {
        $replacements = [
            'site_tagline' => [
                'Agence de transformation numérique',
                'Agence de transformation numerique',
            ],
            'footer_text' => [
                'Nous développons des solutions web modernes pour accompagner les entreprises dans leur transformation digitale.',
                'Nous developpons des solutions web modernes pour accompagner les entreprises dans leur transformation digitale.',
            ],
            'home_meta_title' => [
                'Yokkute Labs - Agence de transformation numérique',
                'Yokkute Labs - Agence de transformation numerique',
            ],
            'home_badge_text' => [
                'Yokkute Labs - Agence de transformation numérique',
                'Yokkute Labs - Agence de transformation numerique',
            ],
            'home_hero_title' => [
                "Transformez votre entreprise\nà l'ère du numérique\net de l'IA",
                "Transformez votre entreprise\na l'ere du numerique\net de l'IA",
            ],
            'home_hero_sub' => [
                "Nous accompagnons les entreprises africaines, de l'audit initial à l'intégration de l'intelligence artificielle, avec des solutions concrètes, adaptées à votre réalité de terrain.",
                "Nous accompagnons les entreprises africaines - de l'audit initial a l'integration de l'intelligence artificielle - avec des solutions concretes, adaptees a votre realite terrain.",
            ],
            'home_primary_cta_label' => [
                'Démarrer avec un audit gratuit',
                'Demarrer avec un audit gratuit',
            ],
        ];

        foreach ($replacements as $key => [$from, $to]) {
            DB::table('site_settings')
                ->where('key', $key)
                ->where('value', $from)
                ->update(['value' => $to]);
        }
    }
};
