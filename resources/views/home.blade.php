@extends('layouts.app')
@section('title', 'Yokkuté Labs — Agence de transformation numérique')
@section('content')

{{-- ═══ HERO ═══ --}}
<section style="background:#f5f7fa; padding:5rem 0; border-bottom:1px solid #e5e7eb;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <p class="hero-eyebrow">Yokkuté Labs — Agence de transformation numérique</p>
                <h1 class="hero-title">
                    Transformez votre entreprise à l'ère du <em>numérique</em> et de l'<em>IA</em>
                </h1>
                <p class="hero-sub">
                    Nous accompagnons les entreprises africaines — de l'<strong>audit initial</strong>
                    à l'<strong>intégration de l'intelligence artificielle</strong> — avec des solutions
                    concrètes, adaptées à votre réalité terrain.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('contact') }}" class="btn-green">Démarrer avec un audit gratuit →</a>
                    <a href="#approche" class="btn-outline-green">Voir notre approche</a>
                </div>
                <div class="d-flex gap-4 mt-5 flex-wrap">
                    <div class="hero-stat">
                        <span class="hero-stat-num">07</span>
                        <span class="hero-stat-label">étapes d'accompagnement</span>
                    </div>
                    <div class="hero-stat-sep"></div>
                    <div class="hero-stat">
                        <span class="hero-stat-num">100%</span>
                        <span class="hero-stat-label">sur-mesure & modulable</span>
                    </div>
                    <div class="hero-stat-sep"></div>
                    <div class="hero-stat">
                        <span class="hero-stat-num">0</span>
                        <span class="hero-stat-label">jargon inutile</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                <div class="hero-visual">
                    <div class="hero-visual-ring"></div>
                    <div class="hero-icons-grid">
                        <div class="hv-icon green-bg"><i class="bi bi-clipboard2-check"></i></div>
                        <div class="hv-icon blue-bg"><i class="bi bi-lightbulb"></i></div>
                        <div class="hv-icon green-bg"><i class="bi bi-globe2"></i></div>
                        <div class="hv-icon blue-bg"><i class="bi bi-diagram-3"></i></div>
                        <div class="hv-icon-center"><i class="bi bi-graph-up-arrow"></i></div>
                        <div class="hv-icon green-bg"><i class="bi bi-robot"></i></div>
                        <div class="hv-icon blue-bg"><i class="bi bi-mortarboard"></i></div>
                        <div class="hv-icon green-bg"><i class="bi bi-bar-chart-line"></i></div>
                        <div class="hv-icon blue-bg"><i class="bi bi-shield-check"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ APPROCHE ═══ --}}
<section id="approche" class="py-5 text-center" style="background:#f5f7fa;">
    <div class="container">
        <p class="section-tag-home" style="justify-content:center; margin:0 auto .75rem;">Notre approche</p>
        <h2 class="fw-bold mb-2" style="font-family:'Sora',sans-serif;">Notre approche est pensée pour vous !</h2>
        <p class="text-muted mx-auto" style="max-width:560px;">
            Chaque étape de notre accompagnement est conçue pour répondre précisément
            à votre niveau de maturité numérique, de zéro à l'intelligence artificielle.
        </p>
    </div>
</section>

{{-- ═══ QUALITÉS ═══ --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-home" style="justify-content:center; margin:0 auto .75rem;">Notre différence</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">Pas un prestataire de plus.<br>Un vrai partenaire de croissance.</h2>
            <p class="text-muted mx-auto mt-2" style="max-width:520px;">Ce qui nous différencie, ce n'est pas ce qu'on fait — c'est comment on le fait.</p>
        </div>
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card green-top">
                    <div class="qualite-icon green-icon"><i class="bi bi-search-heart"></i></div>
                    <h6>On comprend avant d'agir</h6>
                    <p>Chaque mission débute par un audit. Pas de solution vendue avant qu'on ait compris votre problème.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card blue-top">
                    <div class="qualite-icon blue-icon"><i class="bi bi-chat-text"></i></div>
                    <h6>On parle votre langue</h6>
                    <p>Pas de jargon. Des livrables clairs, des actions concrètes et des résultats mesurables.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card green-top">
                    <div class="qualite-icon green-icon"><i class="bi bi-person-check"></i></div>
                    <h6>Un interlocuteur unique</h6>
                    <p>Un référent dédié qui connaît votre dossier, répond vite et reste présent du début à la fin.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card blue-top">
                    <div class="qualite-icon blue-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h6>Engagement sur les résultats</h6>
                    <p>On ne disparaît pas après la livraison. On mesure l'impact réel avec vous et on s'adapte.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card green-top">
                    <div class="qualite-icon green-icon"><i class="bi bi-geo-alt"></i></div>
                    <h6>Expertise locale</h6>
                    <p>On connaît les réalités du marché africain et on s'appuie sur des méthodes éprouvées mondialement.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card blue-top">
                    <div class="qualite-icon blue-icon"><i class="bi bi-sliders"></i></div>
                    <h6>100% sur-mesure</h6>
                    <p>Pas de solution pré-packagée. On construit la réponse adaptée à votre situation et vos ressources.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card green-top">
                    <div class="qualite-icon green-icon"><i class="bi bi-shield-check"></i></div>
                    <h6>Transparence totale</h6>
                    <p>On vous explique ce qu'on fait et pourquoi. L'objectif : vous rendre autonome, pas dépendant.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="qualite-card blue-top">
                    <div class="qualite-icon blue-icon"><i class="bi bi-clock-history"></i></div>
                    <h6>Réactivité garantie</h6>
                    <p>Réponse sous 24h ouvrées. Toujours un humain qui lit votre message et revient vers vous.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ ROADMAP ═══ --}}
<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-home" style="justify-content:center; margin:0 auto .75rem;">Les 7 étapes</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">Les 7 étapes de votre transformation</h2>
            <p class="text-muted mx-auto" style="max-width:520px;">De l'audit initial à l'intelligence artificielle — chaque étape s'active selon votre maturité numérique.</p>
        </div>

        <div class="roadmap">

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#3ecf72; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #3ecf72;">
                    <i class="bi bi-clipboard2-check"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#3ecf72;">01</div>
                    <h5>Audit numérique</h5>
                    <p>Diagnostic complet de vos outils, processus et données pour identifier ce qui freine votre croissance.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#3ecf72;">Demander mon audit →</a>
                </div>
            </div>

            <div class="roadmap-step right">
                <div class="rm-icon-wrap" style="background:#1a9bdc; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #1a9bdc;">
                    <i class="bi bi-lightbulb"></i>
                </div>
                <div class="rm-card rm-card-right">
                    <div class="rm-num" style="color:#1a9bdc;">02</div>
                    <h5>Conseil stratégique</h5>
                    <p>Nos experts définissent avec vous la meilleure stratégie numérique adaptée à votre secteur et vos ambitions.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a9bdc;">Prendre rendez-vous →</a>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#3ecf72; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #3ecf72;">
                    <i class="bi bi-globe2"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#3ecf72;">03</div>
                    <h5>Référencement & présence digitale</h5>
                    <p>Site, SEO, réseaux sociaux, Google My Business — soyez visible là où vos clients vous cherchent.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#3ecf72;">Booster ma visibilité →</a>
                </div>
            </div>

            <div class="roadmap-step right">
                <div class="rm-icon-wrap" style="background:#1a9bdc; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #1a9bdc;">
                    <i class="bi bi-diagram-3"></i>
                </div>
                <div class="rm-card rm-card-right">
                    <div class="rm-num" style="color:#1a9bdc;">04</div>
                    <h5>Intégration numérique</h5>
                    <p>ERP, CRM, outils collaboratifs — vos équipes travaillent mieux, plus vite et avec moins d'erreurs.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a9bdc;">Digitaliser mes opérations →</a>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#3ecf72; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #3ecf72;">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#3ecf72;">05</div>
                    <h5>Intégration IA</h5>
                    <p>Chatbots, automatisation, analyse prédictive, traitement de documents — de l'IA concrète qui fait gagner du temps.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#3ecf72;">Explorer les solutions IA →</a>
                </div>
            </div>

            <div class="roadmap-step right">
                <div class="rm-icon-wrap" style="background:#1a9bdc; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #1a9bdc;">
                    <i class="bi bi-mortarboard"></i>
                </div>
                <div class="rm-card rm-card-right">
                    <div class="rm-num" style="color:#1a9bdc;">06</div>
                    <h5>Formation</h5>
                    <p>Formations pratiques sur-mesure — du numérique de base à l'usage avancé de l'IA — pour des équipes autonomes.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a9bdc;">Voir les formations →</a>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#3ecf72; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #3ecf72;">
                    <i class="bi bi-bar-chart-line"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#3ecf72;">07</div>
                    <h5>Big Data & Business Intelligence</h5>
                    <p>Tableaux de bord décisionnels pour transformer vos données brutes en décisions éclairées, en temps réel.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#3ecf72;">Transformer mes données →</a>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('services') }}" class="btn-green me-3">Voir tous nos services →</a>
            <a href="{{ route('contact') }}" class="btn-outline-green">Démarrer mon audit gratuit</a>
        </div>
    </div>
</section>

{{-- ═══ CTA FINAL ═══ --}}
<section style="background:#1a1a2e; padding:5rem 0; text-align:center;">
    <div class="container" style="max-width:600px;">
        <p class="section-tag-home" style="justify-content:center; margin:0 auto 1rem;">Prêt à démarrer ?</p>
        <h2 class="fw-bold mb-3" style="color:white; font-family:'Sora',sans-serif;">Faisons le point sur votre situation.</h2>
        <p style="color:#9ca3af; margin-bottom:2rem;">L'audit est gratuit. La conversation ne vous engage à rien. Ce que vous en tirerez, par contre, peut changer beaucoup.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="{{ route('contact') }}" class="btn-green">Prendre rendez-vous gratuitement →</a>
            <a href="{{ route('services') }}" class="btn-outline-white">Découvrir nos services</a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ── Section tag ── */
    .section-tag-home {
        display: inline-flex; align-items: center; gap: .5rem;
        font-size: .72rem; font-weight: 700; letter-spacing: .12em;
        text-transform: uppercase; color: #3ecf72;
    }
    .section-tag-home::before { content:''; display:inline-block; width:18px; height:2px; background:#3ecf72; }

    /* ── Boutons ── */
    .btn-green         { background:#3ecf72; color:#fff; border:none; font-weight:600; font-size:.875rem; padding:.75rem 1.5rem; display:inline-block; transition:background .2s; border-radius:4px; }
    .btn-green:hover   { background:#2db85e; color:#fff; }
    .btn-outline-green { border:2px solid #3ecf72; color:#3ecf72; background:transparent; font-weight:600; font-size:.875rem; padding:.75rem 1.5rem; display:inline-block; transition:all .2s; border-radius:4px; }
    .btn-outline-green:hover { background:#3ecf72; color:#fff; }
    .btn-outline-white { border:2px solid rgba(255,255,255,.25); color:white; background:transparent; font-weight:600; font-size:.875rem; padding:.75rem 1.5rem; display:inline-block; transition:all .2s; border-radius:4px; }
    .btn-outline-white:hover { border-color:white; }

    /* ── HERO ── */
    .hero-eyebrow { font-size:.72rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#3ecf72; display:flex; align-items:center; gap:.5rem; margin-bottom:1.25rem; }
    .hero-eyebrow::before { content:''; display:inline-block; width:24px; height:2px; background:#3ecf72; }
    .hero-title { font-family:'Sora',sans-serif; font-size:clamp(2rem,4.5vw,3.2rem); font-weight:800; line-height:1.15; color:#1a1a2e; margin-bottom:1.25rem; }
    .hero-title em { color:#3ecf72; font-style:normal; }
    .hero-sub { color:#6b7280; font-size:1rem; max-width:500px; line-height:1.7; }
    .hero-sub strong { color:#1a1a2e; }
    .hero-stat { display:flex; flex-direction:column; }
    .hero-stat-num { font-family:'Sora',sans-serif; font-size:1.75rem; font-weight:800; color:#1a9bdc; line-height:1; }
    .hero-stat-label { font-size:.72rem; color:#9ca3af; margin-top:.2rem; }
    .hero-stat-sep { width:1px; background:#e5e7eb; margin:0 .5rem; align-self:stretch; }

    /* ── Hero visual ── */
    .hero-visual { position:relative; width:280px; height:280px; display:flex; align-items:center; justify-content:center; }
    .hero-visual-ring { position:absolute; inset:0; border-radius:50%; border:1px dashed rgba(62,207,114,.4); }
    .hero-icons-grid { display:grid; grid-template-columns:repeat(3,72px); grid-template-rows:repeat(3,72px); gap:12px; position:relative; z-index:1; }
    .hv-icon { width:72px; height:72px; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; transition:transform .2s; }
    .hv-icon:hover { transform:scale(1.08); }
    .hv-icon-center { width:72px; height:72px; border-radius:50%; background:#3ecf72; display:flex; align-items:center; justify-content:center; font-size:1.5rem; color:#fff; box-shadow:0 0 0 8px rgba(62,207,114,.15); grid-column:2; grid-row:2; }
    .green-bg { background:rgba(62,207,114,.1); color:#3ecf72; border:1px solid rgba(62,207,114,.2); }
    .blue-bg  { background:rgba(26,155,220,.1);  color:#1a9bdc; border:1px solid rgba(26,155,220,.2); }

    /* ── Qualités ── */
    .qualite-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:1.75rem 1.5rem; height:100%; transition:box-shadow .2s, transform .2s; border-top:3px solid transparent; }
    .qualite-card:hover { box-shadow:0 8px 24px rgba(0,0,0,.08); transform:translateY(-3px); }
    .green-top { border-top-color:#3ecf72; }
    .blue-top  { border-top-color:#1a9bdc; }
    .qualite-icon { width:52px; height:52px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; margin-bottom:1rem; }
    .green-icon { background:rgba(62,207,114,.12); color:#3ecf72; }
    .blue-icon  { background:rgba(26,155,220,.12);  color:#1a9bdc; }
    .qualite-card h6 { font-family:'Sora',sans-serif; font-size:.95rem; font-weight:700; margin-bottom:.4rem; color:#1a1a2e; }
    .qualite-card p  { font-size:.82rem; color:#6b7280; margin:0; line-height:1.6; }

    /* ── ROADMAP ── */
    .roadmap { position:relative; max-width:860px; margin:0 auto; }
    .roadmap::before { content:''; position:absolute; left:50%; top:0; bottom:0; width:2px; background:linear-gradient(to bottom,#3ecf72,#1a9bdc,#3ecf72,#1a9bdc,#3ecf72,#1a9bdc,#3ecf72); transform:translateX(-50%); z-index:0; }
    .roadmap-step { display:grid; grid-template-columns:1fr 80px 1fr; align-items:center; margin-bottom:2.5rem; position:relative; }
    .roadmap-step .rm-icon-wrap { grid-column:2; grid-row:1; }
    .rm-icon-wrap { width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.6rem; color:#fff; position:relative; z-index:2; margin:0 auto; }
    .rm-card { background:#fff; border:1px solid #e5e7eb; border-left:3px solid #3ecf72; border-radius:6px; padding:1.25rem 1.5rem; position:relative; z-index:1; grid-column:1; grid-row:1; }
    .rm-card::after  { content:''; position:absolute; right:-10px; top:50%; transform:translateY(-50%); border:10px solid transparent; border-left-color:#fff; }
    .rm-card::before { content:''; position:absolute; right:-12px; top:50%; transform:translateY(-50%); border:11px solid transparent; border-left-color:#e5e7eb; }
    .rm-card-right { grid-column:3; grid-row:1; border-left:none; border-right:3px solid #1a9bdc; }
    .rm-card-right::after  { right:auto; left:-10px; border-left-color:transparent; border-right-color:#fff; }
    .rm-card-right::before { right:auto; left:-12px; border-left-color:transparent; border-right-color:#e5e7eb; }
    .rm-num { font-family:'Sora',sans-serif; font-size:.7rem; font-weight:800; letter-spacing:.1em; margin-bottom:.35rem; }
    .rm-card h5 { font-family:'Sora',sans-serif; font-size:1rem; font-weight:700; margin-bottom:.4rem; color:#1a1a2e; }
    .rm-card p  { font-size:.85rem; color:#6b7280; margin-bottom:.75rem; }
    .rm-link    { font-size:.8rem; font-weight:600; text-decoration:none; }
    .rm-link:hover { opacity:.75; }

    @media (max-width:640px) {
        .roadmap::before { left:32px; }
        .roadmap-step, .roadmap-step.right { display:flex; flex-direction:row; gap:1rem; align-items:flex-start; }
        .rm-icon-wrap { width:48px; height:48px; font-size:1.2rem; flex-shrink:0; }
        .rm-card, .rm-card-right { flex:1; border-left:3px solid #3ecf72 !important; border-right:none !important; }
        .rm-card::after,.rm-card::before,.rm-card-right::after,.rm-card-right::before { display:none; }
    }
</style>
@endpush