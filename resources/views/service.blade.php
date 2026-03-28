@extends('layouts.app')
@section('title', 'Services — Yokkuté Labs')

@section('content')

<link href="{{ asset('css/service.css') }}" rel="stylesheet">

{{-- ── HERO ── --}}
<section class="svc-hero">
    <div class="svc-hero-bg"></div>
    <div class="svc-hero-grid"></div>
    <img src="{{ asset('images/services-hero.jpg') }}" alt="" class="svc-hero-img" aria-hidden="true">
    <div class="container py-5" style="position:relative; z-index:1;">
        <div class="hero-tag">Services</div>
        <h1>Ce que nous faisons pour vous.</h1>
        <p class="mt-2 mb-0">Sept domaines d'expertise, un seul objectif : accélérer votre transformation numérique.</p>
    </div>
</section>

{{-- ── STATS STRIP ── --}}
<div class="stats-strip reveal">
    <div class="container">
        <div class="row g-0 justify-content-center">

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon">🎯</div>
                    <div class="num">7<span>+</span></div>
                    <div class="lbl">Expertises métier</div>
                </div>
            </div>

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon">✦</div>
                    <div class="num">100<span>%</span></div>
                    <div class="lbl">Sur-mesure</div>
                </div>
            </div>

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon">🚫</div>
                    <div class="num">0</div>
                    <div class="lbl">Jargon inutile</div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ── INTRO ── --}}
<section class="svc-intro reveal">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="highlight-pill mb-3 d-inline-block">Que faisons-nous ?</span>
                <h2 class="mt-2">De l'audit à l'intelligence artificielle —<br>un accompagnement complet.</h2>
            </div>
            <div class="col-lg-6">
                <p class="text-muted" style="font-size:.95rem; line-height:1.85;">La transformation numérique d'une entreprise ne se résume pas à un site web ou à un logiciel. C'est un parcours. Et chaque entreprise en est à une étape différente. C'est pourquoi nos services couvrent l'ensemble du spectre — pour intervenir là où vous en avez vraiment besoin.</p>
                <p class="text-muted" style="font-size:.95rem; line-height:1.85; margin:0;"><strong class="text-dark">Nos services peuvent être activés séparément ou combinés</strong> selon votre maturité numérique et vos priorités stratégiques.</p>
            </div>
        </div>
    </div>
</section>

{{-- ── SERVICES GRID ── --}}
<section class="svc-grid">
    <div class="container">

        <div class="row g-4">

            {{-- 01 --}}
            <div class="col-md-6 col-lg-4 reveal">
                <div class="svc-card d-flex flex-column">
                    <div class="svc-num">01</div>
                    <div class="svc-icon icon-green">🔍</div>
                    <span class="svc-badge badge-green">Point de départ recommandé</span>
                    <h3>Audit numérique</h3>
                    <p>Avant toute action, il faut savoir où on en est. Notre audit passe au crible vos outils, processus, présence en ligne et maturité data. Vous repartez avec un diagnostic clair et une feuille de route priorisée — sans langue de bois.</p>
                    <div class="svc-for"><strong>Pour qui :</strong> Tout chef d'entreprise qui veut comprendre son niveau de maturité numérique avant d'investir.</div>
                    <div class="deliverables-wrap mt-auto">
                        <strong>Ce que vous recevez :</strong>
                        <div>
                            <span class="dtag">Rapport de diagnostic</span>
                            <span class="dtag">Feuille de route</span>
                            <span class="dtag">Session de restitution</span>
                            <span class="dtag">Plan 90 jours</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 02 --}}
            <div class="col-md-6 col-lg-4 reveal">
                <div class="svc-card d-flex flex-column">
                    <div class="svc-num">02</div>
                    <div class="svc-icon icon-blue">🧭</div>
                    <span class="svc-badge badge-blue">Vous avez un projet, pas encore de cap</span>
                    <h3>Conseil stratégique</h3>
                    <p>Vous avez une idée, une intuition ou un problème — mais vous ne savez pas par où commencer. Nos consultants vous aident à définir une stratégie numérique réaliste, adaptée à votre secteur et vos ambitions.</p>
                    <div class="svc-for"><strong>Pour qui :</strong> Dirigeants qui veulent aller vite, mais dans la bonne direction.</div>
                    <div class="deliverables-wrap mt-auto">
                        <strong>Ce que vous recevez :</strong>
                        <div>
                            <span class="dtag">Analyse de marché</span>
                            <span class="dtag">Recommandations</span>
                            <span class="dtag">Roadmap numérique</span>
                            <span class="dtag">Aide à la décision</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 03 --}}
            <div class="col-md-6 col-lg-4 reveal">
                <div class="svc-card d-flex flex-column">
                    <div class="svc-num">03</div>
                    <div class="svc-icon icon-green">📡</div>
                    <span class="svc-badge badge-gray">Vous n'êtes pas assez visible en ligne</span>
                    <h3>Référencement & présence digitale</h3>
                    <p>Vos clients vous cherchent en ligne — mais ils ne vous trouvent pas. Nous construisons ou renforçons votre présence : site vitrine, SEO, réseaux sociaux, Google My Business, réputation.</p>
                    <div class="svc-for"><strong>Pour qui :</strong> PME et commerçants qui veulent attirer des clients en ligne sans tout miser sur la pub payante.</div>
                    <div class="deliverables-wrap mt-auto">
                        <strong>Ce que vous recevez :</strong>
                        <div>
                            <span class="dtag">Audit visibilité</span>
                            <span class="dtag">Création / refonte</span>
                            <span class="dtag">Stratégie SEO</span>
                            <span class="dtag">Rapport mensuel</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 04 --}}
            <div class="col-md-6 col-lg-4 reveal">
                <div class="svc-card d-flex flex-column">
                    <div class="svc-num">04</div>
                    <div class="svc-icon icon-blue">⚙️</div>
                    <span class="svc-badge badge-gray">Vos opérations sont encore manuelles</span>
                    <h3>Intégration numérique</h3>
                    <p>Excel partout, papier encore là, outils qui ne se parlent pas... Nous intégrons des solutions adaptées à votre métier — ERP, CRM, outils collaboratifs — pour que vos équipes travaillent mieux et plus vite.</p>
                    <div class="svc-for"><strong>Pour qui :</strong> Entreprises en croissance qui perdent du temps en tâches répétitives.</div>
                    <div class="deliverables-wrap mt-auto">
                        <strong>Ce que vous recevez :</strong>
                        <div>
                            <span class="dtag">Cartographie processus</span>
                            <span class="dtag">Déploiement outils</span>
                            <span class="dtag">Migration données</span>
                            <span class="dtag">Support post-déploiement</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 05 --}}
            <div class="col-md-6 col-lg-4 reveal">
                <div class="svc-card d-flex flex-column">
                    <div class="svc-num">05</div>
                    <div class="svc-icon icon-green">🤖</div>
                    <span class="svc-badge badge-green">Vous voulez automatiser et aller plus loin</span>
                    <h3>Intégration IA</h3>
                    <p>Nous intégrons des solutions d'intelligence artificielle concrètes dans vos flux : automatisation, chatbots métier, analyse prédictive, traitement de documents. Pas de l'IA pour faire beau — de l'IA qui fait gagner temps et argent.</p>
                    <div class="svc-for"><strong>Pour qui :</strong> Structures qui ont digitalisé leurs bases et veulent franchir le cap de l'automatisation intelligente.</div>
                    <div class="deliverables-wrap mt-auto">
                        <strong>Ce que vous recevez :</strong>
                        <div>
                            <span class="dtag">Audit IA</span>
                            <span class="dtag">Cadrage cas d'usage</span>
                            <span class="dtag">Développement</span>
                            <span class="dtag">Pilote & mesure</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 06 --}}
            <div class="col-md-6 col-lg-4 reveal">
                <div class="svc-card d-flex flex-column">
                    <div class="svc-num">06</div>
                    <div class="svc-icon icon-blue">🎓</div>
                    <span class="svc-badge badge-blue">Vos équipes ont besoin de monter en compétences</span>
                    <h3>Formation</h3>
                    <p>Les meilleurs outils ne servent à rien si personne ne sait les utiliser. Formations pratiques, sur-mesure, ancrées dans votre réalité — du numérique de base à l'IA avancée. L'objectif : rendre vos collaborateurs autonomes.</p>
                    <div class="svc-for"><strong>Pour qui :</strong> Managers et équipes opérationnelles qui ont besoin d'une montée en compétences rapide.</div>
                    <div class="deliverables-wrap mt-auto">
                        <strong>Ce que vous recevez :</strong>
                        <div>
                            <span class="dtag">Bilan compétences</span>
                            <span class="dtag">Programme sur-mesure</span>
                            <span class="dtag">Présentiel / distanciel</span>
                            <span class="dtag">Certification</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 07 --}}
            <div class="col-md-6 col-lg-4  reveal">
                <div class="svc-card d-flex flex-column">
                    <div class="svc-num">07</div>
                    <div class="svc-icon icon-green">📊</div>
                    <span class="svc-badge badge-green">Vous avez des données, mais vous ne les exploitez pas</span>
                    <h3>Big Data & Business Intelligence</h3>
                    <p>Votre entreprise génère des données chaque jour — ventes, clients, opérations, finances — mais elles dorment dans des tableurs ou des systèmes disparates. Nous mettons en place des pipelines et tableaux de bord pour transformer vos données brutes en décisions éclairées, prises en temps réel.</p>
                    <div class="svc-for"><strong>Pour qui :</strong> Décideurs qui veulent piloter leur activité avec des données fiables plutôt qu'à l'instinct.</div>
                    <div class="deliverables-wrap mt-auto">
                        <strong>Ce que vous recevez :</strong>
                        <div>
                            <span class="dtag">Audit données</span>
                            <span class="dtag">Architecture data</span>
                            <span class="dtag">Tableaux de bord</span>
                            <span class="dtag">Formation KPIs</span>
                            <span class="dtag">Maintenance</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── CTA ── --}}
<section class="strip-cta-custom">
    <div class="floating-orb" style="width:300px;height:300px;background:rgba(62,207,114,.06);top:-80px;left:-60px;"></div>
    <div class="floating-orb" style="width:200px;height:200px;background:rgba(59,130,246,.07);bottom:-40px;right:80px;"></div>
    <div class="container reveal">
        <h2>Vous ne savez pas par où commencer ?</h2>
        <p>C'est exactement pour ça qu'on propose un audit gratuit. En un échange, on identifie ensemble les leviers les plus impactants pour votre entreprise.</p>
        <a href="{{ route('contact') }}" class="btn-cta-primary">Demander mon audit gratuit →</a>
    </div>
</section>

@push('scripts')
<script>
    // Intersection Observer pour les animations au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, entry.target.dataset.delay || 0);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12
    });

    document.querySelectorAll('.reveal').forEach((el, i) => {
        el.dataset.delay = (i % 3) * 120; // stagger par colonne
        observer.observe(el);
    });
</script>
@endpush

@endsection