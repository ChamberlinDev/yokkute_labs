@extends('layouts.app')
@section('title', 'Services — Yokkuté Labs')

@section('content')

<link href="{{ asset('css/service.css') }}" rel="stylesheet">

{{-- HERO --}}
<section class="svc-hero">
    <div class="svc-hero-bg"></div>
    <div class="svc-hero-grid"></div>
    <div class="container py-5" style="position:relative; z-index:1;">
        <div class="hero-tag">Services</div>
        <h1>Ce que nous faisons pour vous.</h1>
        <p class="mt-2 mb-0">Sept domaines d'expertise, un seul objectif : accélérer votre transformation numérique.</p>
    </div>
</section>

{{-- STATS STRIP --}}
<div class="stats-strip reveal">
    <div class="container">
        <div class="row g-2 justify-content-center">

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon"><i class="bi bi-bullseye" aria-hidden="true"></i></div>
                    <div class="num">7<span>+</span></div>
                    <div class="lbl">Expertises métier</div>
                </div>
            </div>

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon"><i class="bi bi-patch-check-fill" aria-hidden="true"></i></div>
                    <div class="num">100<span>%</span></div>
                    <div class="lbl">Sur-mesure</div>
                </div>
            </div>

            <div class="col-6 col-md-4 stat-box">
                <div class="stat-inner">
                    <div class="stat-icon"><i class="bi bi-slash-circle-fill" aria-hidden="true"></i></div>
                    <div class="num">0</div>
                    <div class="lbl">Jargon inutile</div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- INTRO --}}
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

{{-- SERVICES GRID --}}
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
                @endphp
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="svc-card d-flex flex-column">
                        <div class="svc-num">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="svc-icon {{ $iconClass }}"><i class="bi {{ $service->icon }}" aria-hidden="true"></i></div>
                        @if($service->badge)
                            <span class="svc-badge {{ $badgeClass }}">{{ $service->badge }}</span>
                        @endif
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                        @if($service->audience)
                            <div class="svc-for"><strong>Pour qui :</strong> {{ $service->audience }}</div>
                        @endif
                        @if(!empty($service->deliverables))
                            <div class="deliverables-wrap mt-auto">
                                <strong>Ce que vous recevez :</strong>
                                <div>
                                    @foreach($service->deliverables as $deliverable)
                                        <span class="dtag">{{ $deliverable }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border-0 rounded-4">Les services seront visibles ici des qu'ils seront publies depuis l'administration.</div>
                </div>
            @endforelse

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="strip-cta-custom">
    <div class="floating-orb" style="width:300px;height:300px;background:rgba(26,122,74,.06);top:-80px;left:-60px;"></div>
    <div class="floating-orb" style="width:200px;height:200px;background:rgba(59,130,246,.07);bottom:-40px;right:80px;"></div>
    <div class="container reveal">
        <h2>Vous ne savez pas par où commencer ?</h2>
        <p>C'est exactement pour ça qu'on propose un audit gratuit. En un échange, on identifie ensemble les leviers les plus impactants pour votre entreprise.</p>
        <a href="{{ route('contact') }}" class="btn-cta-primary">Demander mon audit gratuit  — '</a>
    </div>
</section>

@endsection