@php
  $homeMetaTitle = $siteSettings['home_meta_title'] ?? 'Yokkute Labs — Agence de transformation numerique';
  $homeBadgeText = $siteSettings['home_badge_text'] ?? 'Yokkute Labs — Agence de transformation numerique';
  $homeHeroTitle = $siteSettings['home_hero_title'] ?? "Transformez votre entreprise\na l'ere du numerique\net de l'IA";
  $homeHeroSub = $siteSettings['home_hero_sub'] ?? "Nous accompagnons les entreprises africaines — de l'audit initial a l'integration de l'intelligence artificielle — avec des solutions concretes, adaptees a votre realite terrain.";
  $homePrimaryCtaLabel = $siteSettings['home_primary_cta_label'] ?? 'Demarrer avec un audit gratuit';
  $homePrimaryCtaUrl = $siteSettings['home_primary_cta_url'] ?? '/contact';
  $homeSecondaryCtaLabel = $siteSettings['home_secondary_cta_label'] ?? 'Voir notre approche';
  $homeSecondaryCtaUrl = $siteSettings['home_secondary_cta_url'] ?? '#approche';
@endphp

@extends('layouts.app')
@section('title', $homeMetaTitle)
@section('content')

<link href="{{ $versionedAsset('css/home.css') }}" rel="stylesheet">
<link href="{{ $versionedAsset('css/hero.css') }}" rel="stylesheet">

{{-- ... HERO ... --}}
<section class="hero">

  <video class="hero-video" autoplay muted loop playsinline preload="metadata" aria-hidden="true">
    <source src="{{ $versionedAsset('images/id1.mp4') }}" type="video/mp4">
  </video>
 
  <canvas id="bgCanvas"></canvas>
  <div class="hero-grid"></div>
  <div class="hero-dots"></div>
  <div class="hero-vignette"></div>
  <div class="hero-deco"></div>
  <div class="hero-deco2"></div>
 
  <div class="hero-inner">
 
    <div class="hero-badge">
      <span class="hero-badge-dot"></span>
      {{ $homeBadgeText }}
    </div>
 
    <h1 class="hero-title">
      {!! nl2br(e($homeHeroTitle)) !!}
    </h1>
 
    <p class="hero-sub">
      {{ $homeHeroSub }}
    </p>
 
    <div class="hero-btns">
      <a href="{{ $homePrimaryCtaUrl }}" class="btn-primary-hero">
        {{ $homePrimaryCtaLabel }}
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="{{ $homeSecondaryCtaUrl }}" class="btn-ghost-hero">
        {{ $homeSecondaryCtaLabel }}
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </a>
    </div>
 
    <div class="hero-stats">
      <div class="hero-stat">
        <span class="hero-stat-num">07<span>+</span></span>
        <span class="hero-stat-label">étapes d'accompagnement</span>
      </div>
      <div class="hero-stat">
        <span class="hero-stat-num">100<span>%</span></span>
        <span class="hero-stat-label">sur-mesure & modulable</span>
      </div>
      <div class="hero-stat">
        <span class="hero-stat-num">0</span>
        <span class="hero-stat-label">jargon inutile</span>
      </div>
    </div>
 
  </div>
 
  <div class="hero-scroll">
    <span class="hero-scroll-text">Scroll</span>
    <div class="hero-scroll-line"></div>
  </div>
 
</section>
 
 

{{-- ... QUALIT — S ... --}}
<section class="nd-section">
  <div class="nd-container">
 
    <div class="nd-header">
      <div>
        <p class="nd-eyebrow">Notre différence</p>
        <h2 class="nd-title">Pas un prestataire de plus.<br><em>Un vrai partenaire</em><br>de croissance.</h2>
      </div>
      <div>
        <p class="nd-desc">Ce qui nous différencie, ce n'est pas ce qu'on fait — c'est comment on le fait. Chaque détail compte, du premier appel jusqu'aux résultats.</p>
      </div>
    </div>
 
    <!-- Groupe 1 : Approche -->
    <div class="nd-group" data-reveal>
      <div class="nd-group-label">
        <span class="nd-group-label-pill">Approche</span>
      </div>
      <div class="nd-roadmap">
 
        <div class="nd-step">
          <div class="nd-step-dot">01</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">Audit</span>
            <h3 class="nd-step-title">On comprend avant d'agir</h3>
            <p class="nd-step-text">Chaque mission débute par un audit. Pas de solution vendue avant d'avoir compris votre problème.</p>
          </div>
        </div>
 
        <div class="nd-step">
          <div class="nd-step-dot">02</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">Clarté</span>
            <h3 class="nd-step-title">On parle votre langue</h3>
            <p class="nd-step-text">Pas de jargon. Des livrables clairs, des actions concrètes et des résultats mesurables.</p>
          </div>
        </div>
 
        <div class="nd-step">
          <div class="nd-step-dot">03</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">Terrain</span>
            <h3 class="nd-step-title">Expertise locale</h3>
            <p class="nd-step-text">On connaît les réalités du marché africain et s'appuie sur des méthodes éprouvées mondialement.</p>
          </div>
        </div>
 
        <div class="nd-step">
          <div class="nd-step-dot">04</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">Sur-mesure</span>
            <h3 class="nd-step-title">100% sur-mesure</h3>
            <p class="nd-step-text">Pas de solution pré-packagée. On construit la réponse adaptée à votre situation et vos ressources.</p>
          </div>
        </div>
 
      </div>
    </div>
 
    <!-- Pont visuel -->
    <div class="nd-bridge">
      <div class="nd-bridge-line"></div>
      <span class="nd-bridge-label">puis, tout au long de la mission</span>
      <div class="nd-bridge-line"></div>
    </div>
 
    <!-- Groupe 2 : Engagement -->
    <div class="nd-group" data-reveal style="transition-delay:.18s">
      <div class="nd-group-label">
        <span class="nd-group-label-pill">Engagement</span>
      </div>
      <div class="nd-roadmap">
 
        <div class="nd-step">
          <div class="nd-step-dot">05</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">Dédié</span>
            <h3 class="nd-step-title">Un interlocuteur unique</h3>
            <p class="nd-step-text">Un référent dédié qui connaît votre dossier, répond vite et reste présent du début à la fin.</p>
          </div>
        </div>
 
        <div class="nd-step">
          <div class="nd-step-dot">06</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">Impact</span>
            <h3 class="nd-step-title">Engagement sur les résultats</h3>
            <p class="nd-step-text">On ne disparaît pas après la livraison. On mesure l'impact réel avec vous et on s'adapte.</p>
          </div>
        </div>
 
        <div class="nd-step">
          <div class="nd-step-dot">07</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">Confiance</span>
            <h3 class="nd-step-title">Transparence totale</h3>
            <p class="nd-step-text">On vous explique ce qu'on fait et pourquoi. L'objectif : vous rendre autonome, pas dépendant.</p>
          </div>
        </div>
 
        <div class="nd-step">
          <div class="nd-step-dot">08</div>
          <div class="nd-step-card">
            <span class="nd-step-tag">24h</span>
            <h3 class="nd-step-title">Réactivité garantie</h3>
            <p class="nd-step-text">Réponse sous 24h ouvrées. Toujours un humain qui lit votre message et revient vers vous.</p>
          </div>
        </div>
 
      </div>
    </div>
 
    <!-- CTA -->
    <div class="nd-cta">
      <a href="#contact" class="nd-cta-btn">
        Démarrer votre audit gratuit
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
          <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
 
  </div>
</section>
<style>
  .nd-section,
  .nd-section * { color: revert; }
  .nd-section { background: #eef7f2 !important; }
</style>

<script>
    (() => {
        const els = document.querySelectorAll('[data-reveal]');
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    io.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        els.forEach((el) => io.observe(el));
        setTimeout(() => els.forEach((el) => el.classList.add('visible')), 500);
    })();
</script>

<!-- ... APPROCHE ... -->
<section id="approche" class="approche sec-ink">
  <div class="approche-inner">
 
    <div class="approche-header">
      <div>
        <p class="approche-eyebrow">Notre approche</p>
        <h2 class="approche-title">
          <span class="light">Pensée pour</span><br>
          <em>votre réalité.</em><br>
          Pas pour la moyenne.
        </h2>
      </div>
      <div class="approche-right">
        <p class="approche-desc">
          Chaque étape de notre accompagnement est conçue pour répondre précisément
          à <strong>votre niveau de maturité numérique</strong> — de zéro à l'intelligence
          artificielle. On avance à votre rythme, avec des résultats mesurables à chaque phase.
        </p>
        
      </div>
    </div>
 
   
 
    <div class="approche-cta">
      <p class="approche-cta-note">
        Vous ne savez pas où vous en êtes ? <strong>Notre diagnostic est gratuit.</strong>
      </p>
      <a href="/contact" class="btn-dark">
        Démarrer le diagnostic
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
          <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
 
  </div>
</section>

{{-- ... ROADMAP ... --}}
<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-home" style="justify-content:center; margin:0 auto .75rem;">Les 7 étapes</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">Les 7 étapes de votre transformation</h2>
            <p class="text-muted mx-auto" style="max-width:520px;">De l'audit initial à l'intelligence artificielle — chaque étape s'active selon votre maturité numérique.</p>
        </div>

        <div class="roadmap">

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#1a7a4a; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #1a7a4a;">
                    <i class="bi bi-clipboard2-check"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#1a7a4a;">01</div>
                    <h5>Audit numérique</h5>
                    <p>Diagnostic complet de vos outils, processus et données pour identifier ce qui freine votre croissance.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a7a4a;">Demander mon audit  — '</a>
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
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a9bdc;">Prendre rendez-vous  — '</a>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#1a7a4a; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #1a7a4a;">
                    <i class="bi bi-globe2"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#1a7a4a;">03</div>
                    <h5>Référencement & présence digitale</h5>
                    <p>Site, SEO, réseaux sociaux, Google My Business — soyez visible là où vos clients vous cherchent.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a7a4a;">Booster ma visibilité  — '</a>
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
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a9bdc;">Digitaliser mes opérations  — '</a>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#1a7a4a; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #1a7a4a;">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#1a7a4a;">05</div>
                    <h5>Intégration IA</h5>
                    <p>Chatbots, automatisation, analyse prédictive, traitement de documents — de l'IA concrète qui fait gagner du temps.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a7a4a;">Explorer les solutions IA  — '</a>
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
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a9bdc;">Voir les formations  — '</a>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="rm-icon-wrap" style="background:#1a7a4a; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px #1a7a4a;">
                    <i class="bi bi-bar-chart-line"></i>
                </div>
                <div class="rm-card">
                    <div class="rm-num" style="color:#1a7a4a;">07</div>
                    <h5>Big Data & Business Intelligence</h5>
                    <p>Tableaux de bord décisionnels pour transformer vos données brutes en décisions éclairées, en temps réel.</p>
                    <a href="{{ route('contact') }}" class="rm-link" style="color:#1a7a4a;">Transformer mes données  — '</a>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('services') }}" class="btn-green me-3">Voir tous nos services  — '</a>
            <a href="{{ route('contact') }}" class="btn-outline-green">Démarrer mon audit gratuit</a>
        </div>
    </div>
</section>

{{-- ... CTA FINAL ... --}}
<section style="background:#1a1a2e; padding:5rem 0; text-align:center;">
    <div class="container" style="max-width:600px;">
        <p class="section-tag-home" style="justify-content:center; margin:0 auto 1rem;">Prêt à démarrer ?</p>
        <h2 class="fw-bold mb-3" style="color:white; font-family:'Sora',sans-serif;">Faisons le point sur votre situation.</h2>
        <p style="color:#9ca3af; margin-bottom:2rem;">L'audit est gratuit. La conversation ne vous engage à rien. Ce que vous en tirerez, par contre, peut changer beaucoup.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="{{ route('contact') }}" class="btn-green">Prendre rendez-vous gratuitement  — '</a>
            <a href="{{ route('services') }}" class="btn-outline-white">Découvrir nos services</a>
        </div>
    </div>
</section>
 

@endsection

@push('scripts')
<script src="{{ $versionedAsset('js/hero.js') }}"></script>
@endpush
