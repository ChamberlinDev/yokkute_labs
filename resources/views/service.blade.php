@extends('layouts.app')
@section('title', 'Services — Yokkuté Labs')
@section('content')

{{-- HEADER --}}
<section class="page-header-sm">
    <div class="container">
        <div class="section-tag">Services</div>
        <h1>Ce que nous faisons pour vous.</h1>
        <p>Sept domaines d'expertise, un seul objectif : accélérer votre transformation numérique.</p>
    </div>
</section>

{{-- INTRO --}}
<section class="py-5">
    <div class="container">
        <div class="section-tag">Que faisons-nous ?</div>
        <h2 class="mb-3">De l'audit à l'intelligence artificielle —<br>un accompagnement complet.</h2>
        <p class="text-muted" style="max-width:680px;">La transformation numérique d'une entreprise ne se résume pas à un site web ou à un logiciel. C'est un parcours. Et chaque entreprise en est à une étape différente. C'est pourquoi nos services couvrent l'ensemble du spectre — pour intervenir là où vous en avez vraiment besoin.</p>
        <p class="text-muted"><strong class="text-dark">Nos services peuvent être activés séparément ou combinés</strong> selon votre maturité numérique et vos priorités stratégiques.</p>
    </div>
</section>

<hr class="divider mx-4">

{{-- SERVICES --}}
<section class="py-4">
    <div class="container">
        <div class="section-tag">Nos offres</div>

        {{-- 01 --}}
        <div class="service-item">
            <span class="tag">Point de départ recommandé</span>
            <h3>01 — Audit numérique</h3>
            <p>Avant toute action, il faut savoir où on en est. Notre audit numérique passe au crible vos outils, vos processus, votre présence en ligne et votre maturité data. À l'issue, vous repartez avec un diagnostic clair et une feuille de route priorisée — sans langue de bois.</p>
            <p><strong>Pour qui :</strong> Tout chef d'entreprise qui veut comprendre son niveau de maturité numérique avant d'investir.</p>
            <div class="service-deliverables">
                <strong>Ce que vous recevez :</strong>
                <div class="deliverable-tags">
                    <span>Rapport de diagnostic</span><span>Feuille de route priorisée</span><span>Session de restitution</span><span>Plan d'action 90 jours</span>
                </div>
            </div>
        </div>

        {{-- 02 --}}
        <div class="service-item">
            <span class="tag">Vous avez un projet, pas encore de cap</span>
            <h3>02 — Conseil stratégique</h3>
            <p>Vous avez une idée, une intuition ou un problème à résoudre — mais vous ne savez pas par où commencer. Nos consultants vous aident à définir une stratégie numérique réaliste, adaptée à votre secteur, votre taille et vos ambitions. On cadre le projet avant de le lancer.</p>
            <p><strong>Pour qui :</strong> Dirigeants qui veulent aller vite, mais dans la bonne direction.</p>
            <div class="service-deliverables">
                <strong>Ce que vous recevez :</strong>
                <div class="deliverable-tags">
                    <span>Analyse de marché ciblée</span><span>Recommandations stratégiques</span><span>Roadmap numérique</span><span>Accompagnement à la décision</span>
                </div>
            </div>
        </div>

        {{-- 03 --}}
        <div class="service-item">
            <span class="tag">Vous n'êtes pas assez visible en ligne</span>
            <h3>03 — Référencement & présence digitale</h3>
            <p>Vos clients vous cherchent en ligne — mais ils ne vous trouvent pas. Nous construisons ou renforçons votre présence sur le web : site vitrine ou e-commerce, référencement naturel (SEO), réseaux sociaux professionnels, Google My Business, gestion de réputation.</p>
            <p><strong>Pour qui :</strong> PME et commerçants qui veulent attirer des clients en ligne sans dépenser leur budget en publicité payante.</p>
            <div class="service-deliverables">
                <strong>Ce que vous recevez :</strong>
                <div class="deliverable-tags">
                    <span>Audit de visibilité</span><span>Création / refonte de site</span><span>Stratégie SEO</span><span>Gestion réseaux sociaux</span><span>Rapport mensuel</span>
                </div>
            </div>
        </div>

        {{-- 04 --}}
        <div class="service-item">
            <span class="tag">Vos opérations sont encore manuelles</span>
            <h3>04 — Intégration numérique</h3>
            <p>Excel partout, papier encore là, outils qui ne se parlent pas... Nous intégrons des solutions numériques adaptées à votre métier — ERP, CRM, plateformes de gestion, outils collaboratifs — pour que vos équipes travaillent mieux, plus vite et avec moins d'erreurs.</p>
            <p><strong>Pour qui :</strong> Entreprises en croissance qui buttent sur leurs outils et perdent du temps en tâches répétitives.</p>
            <div class="service-deliverables">
                <strong>Ce que vous recevez :</strong>
                <div class="deliverable-tags">
                    <span>Cartographie des processus</span><span>Sélection & déploiement d'outils</span><span>Migration des données</span><span>Formation des équipes</span><span>Support post-déploiement</span>
                </div>
            </div>
        </div>

        {{-- 05 --}}
        <div class="service-item">
            <span class="tag">Vous voulez automatiser et aller plus loin</span>
            <h3>05 — Intégration IA</h3>
            <p>Vous êtes prêt à passer à la vitesse supérieure. Nous intégrons des solutions d'intelligence artificielle concrètes dans vos flux de travail : automatisation des tâches répétitives, chatbots métier, analyse prédictive, traitement automatisé de documents. Pas de l'IA pour faire beau — de l'IA qui fait gagner du temps et de l'argent.</p>
            <p><strong>Pour qui :</strong> Structures qui ont déjà digitalisé leurs bases et veulent franchir le cap de l'automatisation intelligente.</p>
            <div class="service-deliverables">
                <strong>Ce que vous recevez :</strong>
                <div class="deliverable-tags">
                    <span>Audit IA</span><span>Cadrage des cas d'usage</span><span>Développement & intégration</span><span>Pilote & mesure d'impact</span><span>Montée en charge</span>
                </div>
            </div>
        </div>

        {{-- 06 --}}
        <div class="service-item">
            <span class="tag">Vos équipes ont besoin de monter en compétences</span>
            <h3>06 — Formation</h3>
            <p>Les meilleurs outils ne servent à rien si personne ne sait les utiliser. Nous proposons des formations pratiques, sur-mesure et ancrées dans votre réalité professionnelle — du numérique de base à l'usage avancé de l'intelligence artificielle. L'objectif : rendre vos collaborateurs autonomes, pas dépendants.</p>
            <p><strong>Pour qui :</strong> Managers et équipes opérationnelles qui ont besoin de montée en compétences rapide et applicable.</p>
            <div class="service-deliverables">
                <strong>Ce que vous recevez :</strong>
                <div class="deliverable-tags">
                    <span>Bilan des compétences</span><span>Programme sur-mesure</span><span>Sessions présentiel / distanciel</span><span>Supports pédagogiques</span><span>Évaluation & certification</span>
                </div>
            </div>
        </div>

        {{-- 07 --}}
        <div class="service-item">
            <span class="tag">Vous avez des données, mais vous ne les exploitez pas</span>
            <h3>07 — Big Data & Business Intelligence</h3>
            <p>Votre entreprise génère des données chaque jour — ventes, clients, opérations, finances — mais elles dorment dans des tableurs ou des systèmes disparates. Nous mettons en place des pipelines de données et des tableaux de bord décisionnels pour transformer vos données brutes en décisions éclairées, prises en temps réel.</p>
            <p><strong>Pour qui :</strong> Décideurs qui veulent piloter leur activité avec des données fiables plutôt qu'à l'instinct.</p>
            <div class="service-deliverables">
                <strong>Ce que vous recevez :</strong>
                <div class="deliverable-tags">
                    <span>Audit de vos données</span><span>Architecture data</span><span>Tableaux de bord sur-mesure</span><span>Formation aux KPIs</span><span>Maintenance & évolution</span>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="strip-cta">
    <h2>Vous ne savez pas par où commencer ?</h2>
    <p>C'est exactement pour ça qu'on propose un audit gratuit. En un échange, on identifie ensemble les leviers les plus impactants pour votre entreprise.</p>
    <a href="{{ route('contact') }}" class="btn-green">Demander mon audit gratuit →</a>
</section>

@endsection