@php
    $homeMetaTitle = $localizedSetting($siteSettings, 'home_meta_title', 'site.settings.home_meta_title');
    $homeBadgeText = $localizedSetting($siteSettings, 'home_badge_text', 'site.settings.home_badge_text');
    $homeHeroTitle = $localizedSetting($siteSettings, 'home_hero_title', 'site.settings.home_hero_title');
    $homeHeroSub = $localizedSetting($siteSettings, 'home_hero_sub', 'site.settings.home_hero_sub');
    $homePrimaryCtaLabel = $localizedSetting($siteSettings, 'home_primary_cta_label', 'site.settings.home_primary_cta_label');
    $homePrimaryCtaUrl = $localizedUrl($localizedSetting($siteSettings, 'home_primary_cta_url', 'site.settings.home_primary_cta_url'));
    $homeSecondaryCtaLabel = $localizedSetting($siteSettings, 'home_secondary_cta_label', 'site.settings.home_secondary_cta_label');
    $homeSecondaryCtaUrl = $localizedUrl($localizedSetting($siteSettings, 'home_secondary_cta_url', 'site.settings.home_secondary_cta_url'));
    $differenceApproachSteps = trans('site.home.difference.approach_steps');
    $differenceEngagementSteps = trans('site.home.difference.engagement_steps');
    $roadmapSteps = trans('site.home.roadmap.steps');
@endphp

@extends('layouts.app')
@section('title', $homeMetaTitle)
@section('content')

<link href="{{ $versionedAsset('css/home.css') }}" rel="stylesheet">
<link href="{{ $versionedAsset('css/hero.css') }}" rel="stylesheet">

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

        <h1 class="hero-title">{!! nl2br(e($homeHeroTitle)) !!}</h1>

        <p class="hero-sub">{{ $homeHeroSub }}</p>

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
                <span class="hero-stat-label">{{ __('site.home.hero.stats.steps') }}</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">100<span>%</span></span>
                <span class="hero-stat-label">{{ __('site.home.hero.stats.custom') }}</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">0</span>
                <span class="hero-stat-label">{{ __('site.home.hero.stats.jargon') }}</span>
            </div>
        </div>
    </div>

    <div class="hero-scroll">
        <span class="hero-scroll-text">{{ __('site.home.hero.scroll') }}</span>
        <div class="hero-scroll-line"></div>
    </div>
</section>

<section class="nd-section">
    <div class="nd-container">
        <div class="nd-header">
            <div>
                <p class="nd-eyebrow">{{ __('site.home.difference.eyebrow') }}</p>
                <h2 class="nd-title">{!! __('site.home.difference.title_html') !!}</h2>
            </div>
            <div>
                <p class="nd-desc">{{ __('site.home.difference.description') }}</p>
            </div>
        </div>

        <div class="nd-group" data-reveal>
            <div class="nd-group-label">
                <span class="nd-group-label-pill">{{ __('site.home.difference.approach_label') }}</span>
            </div>
            <div class="nd-roadmap">
                @foreach($differenceApproachSteps as $index => $step)
                    <div class="nd-step">
                        <div class="nd-step-dot">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="nd-step-card">
                            <span class="nd-step-tag">{{ $step['tag'] }}</span>
                            <h3 class="nd-step-title">{{ $step['title'] }}</h3>
                            <p class="nd-step-text">{{ $step['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="nd-bridge">
            <div class="nd-bridge-line"></div>
            <span class="nd-bridge-label">{{ __('site.home.difference.bridge') }}</span>
            <div class="nd-bridge-line"></div>
        </div>

        <div class="nd-group" data-reveal style="transition-delay:.18s">
            <div class="nd-group-label">
                <span class="nd-group-label-pill">{{ __('site.home.difference.engagement_label') }}</span>
            </div>
            <div class="nd-roadmap">
                @foreach($differenceEngagementSteps as $index => $step)
                    <div class="nd-step">
                        <div class="nd-step-dot">{{ str_pad((string) ($index + 5), 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="nd-step-card">
                            <span class="nd-step-tag">{{ $step['tag'] }}</span>
                            <h3 class="nd-step-title">{{ $step['title'] }}</h3>
                            <p class="nd-step-text">{{ $step['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="nd-cta">
            <a href="{{ route('contact') }}" class="nd-cta-btn">
                {{ __('site.home.difference.cta') }}
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

<section id="approche" class="approche sec-ink">
    <div class="approche-inner">
        <div class="approche-header">
            <div>
                <p class="approche-eyebrow">{{ __('site.home.approach.eyebrow') }}</p>
                <h2 class="approche-title">{!! __('site.home.approach.title_html') !!}</h2>
            </div>
            <div class="approche-right">
                <p class="approche-desc">{!! __('site.home.approach.description') !!}</p>
            </div>
        </div>

        <div class="approche-cta">
            <p class="approche-cta-note">{!! __('site.home.approach.note') !!}</p>
            <a href="{{ route('contact') }}" class="btn-dark">
                {{ __('site.home.approach.button') }}
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-home" style="justify-content:center; margin:0 auto .75rem;">{{ __('site.home.roadmap.tag') }}</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">{{ __('site.home.roadmap.title') }}</h2>
            <p class="text-muted mx-auto" style="max-width:520px;">{{ __('site.home.roadmap.description') }}</p>
        </div>

        <div class="roadmap">
            @foreach($roadmapSteps as $index => $step)
                @php
                    $isRight = $index % 2 === 1;
                @endphp
                <div class="roadmap-step{{ $isRight ? ' right' : '' }}">
                    <div class="rm-icon-wrap" style="background:{{ $step['color'] }}; box-shadow:0 0 0 5px #f5f7fa,0 0 0 7px {{ $step['color'] }};">
                        <i class="bi {{ $step['icon'] }}"></i>
                    </div>
                    <div class="rm-card{{ $isRight ? ' rm-card-right' : '' }}">
                        <div class="rm-num" style="color:{{ $step['color'] }};">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                        <h5>{{ $step['title'] }}</h5>
                        <p>{{ $step['text'] }}</p>
                        <a href="{{ route('contact') }}" class="rm-link" style="color:{{ $step['color'] }};">{{ $step['cta'] }}</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('services') }}" class="btn-green me-3">{{ __('site.home.roadmap.services_button') }}</a>
            <a href="{{ route('contact') }}" class="btn-outline-green">{{ __('site.home.roadmap.audit_button') }}</a>
        </div>
    </div>
</section>

<section style="background:#1a1a2e; padding:5rem 0; text-align:center;">
    <div class="container" style="max-width:600px;">
        <p class="section-tag-home" style="justify-content:center; margin:0 auto 1rem;">{{ __('site.home.final_cta.tag') }}</p>
        <h2 class="fw-bold mb-3" style="color:white; font-family:'Sora',sans-serif;">{{ __('site.home.final_cta.title') }}</h2>
        <p style="color:#9ca3af; margin-bottom:2rem;">{{ __('site.home.final_cta.text') }}</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="{{ route('contact') }}" class="btn-green">{{ __('site.home.final_cta.primary') }}</a>
            <a href="{{ route('services') }}" class="btn-outline-white">{{ __('site.home.final_cta.secondary') }}</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ $versionedAsset('js/hero.js') }}"></script>
@endpush
