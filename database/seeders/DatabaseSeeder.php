<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@yokkute.com'],
            [
                'name' => 'Admin Yokkute',
                'password' => Hash::make('Admin12345!'),
                'is_admin' => true,
            ]
        );

        $services = [
            [
                'title' => 'Audit numérique',
                'badge' => 'Point de départ recommandé',
                'badge_variant' => 'green',
                'icon' => 'bi-search',
                'accent_color' => '#3ecf72',
                'description' => 'Avant toute action, il faut savoir où on en est. Notre audit passe au crible vos outils, processus, présence en ligne et maturité data. Vous repartez avec un diagnostic clair et une feuille de route priorisée — sans langue de bois.',
                'audience' => 'Tout chef d\'entreprise qui veut comprendre son niveau de maturité numérique avant d\'investir.',
                'deliverables' => ['Rapport de diagnostic', 'Feuille de route', 'Session de restitution', 'Plan 90 jours'],
            ],
            [
                'title' => 'Conseil stratégique',
                'badge' => 'Vous avez un projet, pas encore de cap',
                'badge_variant' => 'blue',
                'icon' => 'bi-compass',
                'accent_color' => '#1a9bdc',
                'description' => 'Vous avez une idée, une intuition ou un problème — mais vous ne savez pas par où commencer. Nos consultants vous aident à définir une stratégie numérique réaliste, adaptée à votre secteur et vos ambitions.',
                'audience' => 'Dirigeants qui veulent aller vite, mais dans la bonne direction.',
                'deliverables' => ['Analyse de marché', 'Recommandations', 'Roadmap numérique', 'Aide à la décision'],
            ],
            [
                'title' => 'Référencement & présence digitale',
                'badge' => 'Vous n\'êtes pas assez visible en ligne',
                'badge_variant' => 'gray',
                'icon' => 'bi-broadcast-pin',
                'accent_color' => '#3ecf72',
                'description' => 'Vos clients vous cherchent en ligne — mais ils ne vous trouvent pas. Nous construisons ou renforçons votre présence : site vitrine, SEO, réseaux sociaux, Google My Business, réputation.',
                'audience' => 'PME et commerçants qui veulent attirer des clients en ligne sans tout miser sur la pub payante.',
                'deliverables' => ['Audit visibilité', 'Création / refonte', 'Stratégie SEO', 'Rapport mensuel'],
            ],
            [
                'title' => 'Intégration numérique',
                'badge' => 'Vos opérations sont encore manuelles',
                'badge_variant' => 'gray',
                'icon' => 'bi-gear-wide-connected',
                'accent_color' => '#1a9bdc',
                'description' => 'Excel partout, papier encore là, outils qui ne se parlent pas... Nous intégrons des solutions adaptées à votre métier — ERP, CRM, outils collaboratifs — pour que vos équipes travaillent mieux et plus vite.',
                'audience' => 'Entreprises en croissance qui perdent du temps en tâches répétitives.',
                'deliverables' => ['Cartographie processus', 'Déploiement outils', 'Migration données', 'Support post-déploiement'],
            ],
            [
                'title' => 'Intégration IA',
                'badge' => 'Vous voulez automatiser et aller plus loin',
                'badge_variant' => 'green',
                'icon' => 'bi-cpu-fill',
                'accent_color' => '#3ecf72',
                'description' => 'Nous intégrons des solutions d\'intelligence artificielle concrètes dans vos flux : automatisation, chatbots métier, analyse prédictive, traitement de documents. Pas de l\'IA pour faire beau — de l\'IA qui fait gagner temps et argent.',
                'audience' => 'Structures qui ont digitalisé leurs bases et veulent franchir le cap de l\'automatisation intelligente.',
                'deliverables' => ['Audit IA', 'Cadrage cas d\'usage', 'Développement', 'Pilote & mesure'],
            ],
            [
                'title' => 'Formation',
                'badge' => 'Vos équipes ont besoin de monter en compétences',
                'badge_variant' => 'blue',
                'icon' => 'bi-mortarboard-fill',
                'accent_color' => '#1a9bdc',
                'description' => 'Les meilleurs outils ne servent à rien si personne ne sait les utiliser. Formations pratiques, sur-mesure, ancrées dans votre réalité — du numérique de base à l\'IA avancée. L\'objectif : rendre vos collaborateurs autonomes.',
                'audience' => 'Managers et équipes opérationnelles qui ont besoin d\'une montée en compétences rapide.',
                'deliverables' => ['Bilan compétences', 'Programme sur-mesure', 'Présentiel / distanciel', 'Certification'],
            ],
            [
                'title' => 'Big Data & Business Intelligence',
                'badge' => 'Vous avez des données, mais vous ne les exploitez pas',
                'badge_variant' => 'green',
                'icon' => 'bi-bar-chart-line-fill',
                'accent_color' => '#3ecf72',
                'description' => 'Votre entreprise génère des données chaque jour — ventes, clients, opérations, finances — mais elles dorment dans des tableurs ou des systèmes disparates. Nous mettons en place des pipelines et tableaux de bord pour transformer vos données brutes en décisions éclairées, prises en temps réel.',
                'audience' => 'Décideurs qui veulent piloter leur activité avec des données fiables plutôt qu\'à l\'instinct.',
                'deliverables' => ['Audit données', 'Architecture data', 'Tableaux de bord', 'Formation KPIs', 'Maintenance'],
            ],
        ];

        foreach ($services as $index => $service) {
            Service::query()->updateOrCreate(
                ['slug' => Str::slug($service['title'])],
                array_merge($service, [
                    'order_column' => $index + 1,
                    'is_published' => true,
                    'cta_label' => 'En savoir plus',
                    'cta_url' => route('contact'),
                ])
            );
        }

        foreach (range(1, 9) as $index) {
            TeamMember::query()->updateOrCreate(
                ['order_column' => $index],
                [
                    'name' => 'Jean MIKEMY',
                    'role' => 'Développeur Fullstack',
                    'image_path' => 'images/img2.jpeg',
                    'linkedin_url' => 'https://linkedin.com',
                    'is_active' => true,
                ]
            );
        }

        $settings = [
            'site_name' => 'Yokkuté Labs',
            'site_tagline' => 'Agence de transformation numerique',
            'footer_text' => 'Nous développons des solutions web modernes pour accompagner les entreprises dans leur transformation digitale.',
            'home_meta_title' => 'Yokkute Labs — Agence de transformation numerique',
            'home_badge_text' => 'Yokkute Labs — Agence de transformation numerique',
            'home_hero_title' => "Transformez votre entreprise\na l'ere du numerique\net de l'IA",
            'home_hero_sub' => "Nous accompagnons les entreprises africaines — de l'audit initial a l'integration de l'intelligence artificielle — avec des solutions concretes, adaptees a votre realite terrain.",
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
            'contact_address' => 'Dakar, Sénégal',
            'linkedin_url' => '#',
            'facebook_url' => '#',
            'instagram_url' => '#',
            'twitter_url' => '#',
            'logo_path' => 'images/logo-yokkute.png',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
