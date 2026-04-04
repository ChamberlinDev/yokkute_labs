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

@if($partners->isNotEmpty())
<section class="partners-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <p class="partners-tag">{{ __('site.partners.tag') }}</p>
            <h2 class="partners-title">{{ __('site.partners.title') }}</h2>
            <p class="partners-sub">{{ __('site.partners.text') }}</p>
        </div>
        <div class="partners-grid">
            @foreach($partners as $i => $partner)
                <div class="partner-card reveal" style="transition-delay:{{ $i * 0.06 }}s;">
                    @if($partner->website_url)
                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="partner-card-inner" title="{{ $partner->name }}">
                    @else
                        <div class="partner-card-inner">
                    @endif
                        @if($partner->logo_path)
                            <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}" class="partner-logo">
                        @else
                            <span class="partner-initials">{{ strtoupper(substr($partner->name, 0, 2)) }}</span>
                        @endif
                    @if($partner->website_url)
                        </a>
                    @else
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.partners-section {
    background: #f5f7fa;
    background: #fff;
    padding: 4.5rem 0;
    border-top: 1px solid #e8edf2;
}
.partners-tag {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #1a7a4a;
    background: rgba(26,122,74,.08);
    border-radius: 999px;
    padding: .3rem .85rem;
    margin-bottom: .75rem;
}
.partners-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(1.6rem, 3vw, 2.1rem);
    font-weight: 700;
    color: #0f172a;
    margin-bottom: .5rem;
}
.partners-sub {
    color: #6b7280;
    font-size: .95rem;
    max-width: 500px;
    margin: 0 auto;
}
.partners-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.25rem;
    margin-top: .5rem;
}
.partner-card {
    flex: 0 0 auto;
    width: 230px;
}
.partner-card-inner {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 126px;
    background: #fff;
    border: 1.5px solid #e8edf2;
    border-radius: 12px;
    padding: 1.25rem 1.5rem;
    transition: border-color .22s, box-shadow .22s, transform .22s;
    text-decoration: none;
    cursor: default;
}
a.partner-card-inner {
    cursor: pointer;
}
.partner-card-inner:hover {
    border-color: #c5d9cc;
    box-shadow: 0 6px 22px rgba(26,122,74,.09);
    transform: translateY(-3px);
}
.partner-logo {
    max-width: 100%;
    max-height: 78px;
    object-fit: contain;
    filter: grayscale(20%);
    transition: filter .22s;
}
.partner-card-inner:hover .partner-logo {
    filter: grayscale(0%);
}
.partner-initials {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a7a4a;
    font-family: 'Sora', sans-serif;
}
@media (max-width: 576px) {
    .partner-card { width: calc(50% - .65rem); }
}
</style>

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
