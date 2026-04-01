@extends('layouts.app')
@section('title', __('site.services_page.title'))

@section('content')

<link href="{{ $versionedAsset('css/service.css') }}" rel="stylesheet">

<section class="svc-hero">
    <div class="svc-hero-bg"></div>
    <div class="svc-hero-grid"></div>
    <div class="container py-5" style="position:relative; z-index:1;">
        <div class="hero-tag">{{ __('site.services_page.hero.tag') }}</div>
        <h1>{{ __('site.services_page.hero.title') }}</h1>
        <p class="mt-2 mb-0">{{ __('site.services_page.hero.text') }}</p>
    </div>
</section>

<div class="stats-strip reveal">
    <div class="container">
        <div class="row g-2 justify-content-center">
            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon"><i class="bi bi-bullseye" aria-hidden="true"></i></div>
                    <div class="num">7<span>+</span></div>
                    <div class="lbl">{{ __('site.services_page.stats.expertise') }}</div>
                </div>
            </div>

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon"><i class="bi bi-patch-check-fill" aria-hidden="true"></i></div>
                    <div class="num">100<span>%</span></div>
                    <div class="lbl">{{ __('site.services_page.stats.custom') }}</div>
                </div>
            </div>

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon"><i class="bi bi-slash-circle-fill" aria-hidden="true"></i></div>
                    <div class="num">0</div>
                    <div class="lbl">{{ __('site.services_page.stats.jargon') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="svc-intro reveal">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="highlight-pill mb-3 d-inline-block">{{ __('site.services_page.intro.tag') }}</span>
                <h2 class="mt-2">{!! __('site.services_page.intro.title_html') !!}</h2>
            </div>
            <div class="col-lg-6">
                <p class="text-muted" style="font-size:.95rem; line-height:1.85;">{{ __('site.services_page.intro.text_1') }}</p>
                <p class="text-muted" style="font-size:.95rem; line-height:1.85; margin:0;"><strong class="text-dark">{{ __('site.services_page.intro.text_2') }}</strong></p>
            </div>
        </div>
    </div>
</section>

<section class="svc-grid">
    <div class="container">
        <div class="row g-4">
            @forelse($services as $service)
                @php
                    $iconClass = $service->badge_variant === 'blue' ? 'icon-blue' : 'icon-green';
                    $badgeClass = match($service->badge_variant) {
                        'blue' => 'badge-blue',
                        'gray' => 'badge-gray',
                        default => 'badge-green',
                    };
                    $localizedTitle = $localizedServiceField($service, 'title');
                    $localizedBadge = $localizedServiceField($service, 'badge');
                    $localizedDescription = $localizedServiceField($service, 'description');
                    $localizedAudience = $localizedServiceField($service, 'audience');
                    $localizedDeliverables = $localizedServiceDeliverables($service);
                @endphp
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="svc-card d-flex flex-column">
                        <div class="svc-num">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="svc-icon {{ $iconClass }}"><i class="bi {{ $service->icon }}" aria-hidden="true"></i></div>
                        @if($localizedBadge)
                            <span class="svc-badge {{ $badgeClass }}">{{ $localizedBadge }}</span>
                        @endif
                        <h3>{{ $localizedTitle }}</h3>
                        <p>{{ $localizedDescription }}</p>
                        @if($localizedAudience)
                            <div class="svc-for"><strong>{{ __('site.services_page.labels.audience') }}</strong> {{ $localizedAudience }}</div>
                        @endif
                        @if(!empty($localizedDeliverables))
                            <div class="deliverables-wrap mt-auto">
                                <strong>{{ __('site.services_page.labels.deliverables') }}</strong>
                                <div>
                                    @foreach($localizedDeliverables as $deliverable)
                                        <span class="dtag">{{ $deliverable }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border-0 rounded-4">{{ __('site.services_page.labels.empty') }}</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="strip-cta-custom">
    <div class="floating-orb" style="width:300px;height:300px;background:rgba(26,122,74,.06);top:-80px;left:-60px;"></div>
    <div class="floating-orb" style="width:200px;height:200px;background:rgba(59,130,246,.07);bottom:-40px;right:80px;"></div>
    <div class="container reveal">
        <h2>{{ __('site.services_page.cta.title') }}</h2>
        <p>{{ __('site.services_page.cta.text') }}</p>
        <a href="{{ route('contact') }}" class="btn-cta-primary">{{ __('site.services_page.cta.button') }}</a>
    </div>
</section>

@endsection
