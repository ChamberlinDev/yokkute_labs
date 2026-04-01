@php
    $aboutParagraphs = trans('site.about.identity.paragraphs');
    $aboutStats = trans('site.about.identity.stats');
    $aboutWhyItems = trans('site.about.why.items');
@endphp

@extends('layouts.app')
@section('title', __('site.about.title'))
@section('content')

<link href="{{ $versionedAsset('css/propos.css') }}" rel="stylesheet">

<section style="
    background: url('{{ $versionedAsset('images/img3.jpeg') }}') center/cover no-repeat;
    padding: 4rem 0;
    position: relative;">
    <div style="
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.60);
        backdrop-filter: blur(1px);
    "></div>

    <div class="container" style="position: relative; z-index: 1;">
        <p class="mb-2 reveal propos-safe-text" style="font-size:.75rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#1a7a4a;">{{ __('site.about.header.tag') }}</p>
        <h1 class="fw-bold mb-2 reveal propos-safe-text" style="color:white; font-family:'Sora',sans-serif; font-size:clamp(2rem,5vw,3rem);">{{ __('site.about.header.title') }}</h1>
        <p class="reveal propos-safe-text" style="color:#9ca3af; font-size:.95rem; margin:0;">{{ __('site.about.header.text') }}</p>
    </div>
</section>

<section class="py-5 overflow-hidden">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 reveal">
                <p class="section-tag-about propos-safe-text">{{ __('site.about.identity.tag') }}</p>
                <h2 class="fw-bold mb-3 propos-safe-text" style="font-family:'Sora',sans-serif; font-size:clamp(1.6rem,3.5vw,2.2rem); line-height:1.3;">
                    {{ __('site.about.identity.title') }}
                </h2>

                @foreach($aboutParagraphs as $paragraph)
                    <p class="text-muted propos-safe-text" style="font-size:.95rem; line-height:1.8;">{!! $paragraph !!}</p>
                @endforeach

                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <div class="stat-pill green-pill">
                        <span class="pill-num">7</span>
                        <span class="pill-label">{{ $aboutStats[0] }}</span>
                    </div>
                    <div class="stat-pill green-pill">
                        <span class="pill-num">100%</span>
                        <span class="pill-label">{{ $aboutStats[1] }}</span>
                    </div>
                    <div class="stat-pill green-pill">
                        <span class="pill-num">0</span>
                        <span class="pill-label">{{ $aboutStats[2] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal">
                <div style="position:relative;">
                    <div style="
                        position:absolute;
                        top: -20px;
                        right: -20px;
                        width: 100%;
                        height: 100%;
                        border-radius: 20px;
                        background: linear-gradient(135deg, #1a7a4a 0%, #1a7a4a 100%);
                        opacity: .15;
                        z-index: 0;
                    "></div>

                    <img
                        src="{{ $versionedAsset('images/quisommesnous.jpg') }}"
                        alt="{{ __('site.about.identity.image_alt') }}"
                        style="
                            position: relative;
                            z-index: 1;
                            width: 100%;
                            border-radius: 16px;
                            object-fit: cover;
                            max-height: 460px;
                            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
                        " />
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background:#1a7a4a; padding:3.5rem 0; text-align:center;">
    <div class="container" style="max-width:640px;">
        <h2 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif;">{{ __('site.about.strip_cta.title') }}</h2>
        <p style="color:rgba(255,255,255,.75); margin-bottom:1.75rem;">{{ __('site.about.strip_cta.text') }}</p>
        <a href="{{ route('contact') }}" class="btn-green">{{ __('site.about.strip_cta.button') }}</a>
    </div>
</section>

<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 reveal">
                <div class="vm-card propos-safe-text">
                    <div class="vm-icon" style="background:rgba(26,122,74,.12); color:#1a7a4a;">
                        <i class="bi bi-eye"></i>
                    </div>
                    <p class="section-tag-about">{{ __('site.about.vision.tag') }}</p>
                    <h3 class="fw-bold mb-3" style="font-family:'Sora',sans-serif;">{{ __('site.about.vision.title') }}</h3>
                    <p class="text-muted">{{ __('site.about.vision.text') }}</p>
                    <p class="text-muted mb-0"><strong class="text-dark">{{ __('site.about.vision.closing') }}</strong></p>
                </div>
            </div>

            <div class="col-md-6 reveal" style="transition-delay:.1s;">
                <div class="vm-card propos-safe-text">
                    <div class="vm-icon" style="background:rgba(26,122,74,.12); color:#1a7a4a;">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <p class="section-tag-about">{{ __('site.about.mission.tag') }}</p>
                    <h3 class="fw-bold mb-3" style="font-family:'Sora',sans-serif;">{{ __('site.about.mission.title') }}</h3>
                    <p class="text-muted">{!! __('site.about.mission.text') !!}</p>
                    <p class="text-muted mb-0">{{ __('site.about.mission.closing') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-about" style="justify-content:center;">{{ __('site.about.why.tag') }}</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">{!! __('site.about.why.title_html') !!}</h2>
        </div>

        <div class="row g-3">
            @foreach($aboutWhyItems as $index => $item)
                <div class="col-md-6 reveal" @if($index > 0) style="transition-delay:{{ $index * 0.05 }}s;" @endif>
                    <div class="perk-card propos-safe-text">
                        <div class="perk-ic green-ic">
                            @switch($index)
                                @case(0)
                                    <i class="bi bi-geo-alt-fill"></i>
                                    @break
                                @case(1)
                                    <i class="bi bi-sliders"></i>
                                    @break
                                @case(2)
                                    <i class="bi bi-person-check-fill"></i>
                                    @break
                                @case(3)
                                    <i class="bi bi-eye-fill"></i>
                                    @break
                                @case(4)
                                    <i class="bi bi-graph-up-arrow"></i>
                                    @break
                                @default
                                    <i class="bi bi-clock-history"></i>
                            @endswitch
                        </div>
                        <div>
                            <h6>{{ $item['title'] }}</h6>
                            <p>{{ $item['text'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="text-center mb-5 reveal propos-safe-text">
            <p class="section-tag-about" style="justify-content:center;">{{ __('site.about.team.tag') }}</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">{!! __('site.about.team.title_html') !!}</h2>
            <p class="text-muted mt-2 mx-auto" style="max-width:560px;">{{ __('site.about.team.text') }}</p>
        </div>

        @if($teamMembers->isNotEmpty())
            <div class="team-showcase-wrap">
                <button class="team-nav-btn" type="button" data-dir="prev" aria-label="{{ __('site.about.team.prev') }}">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="team-showcase" id="teamShowcase">
                    @foreach($teamMembers as $member)
                        <article class="team-photo-card reveal">
                            <img src="{{ asset($member->image_path) }}" alt="{{ $member->name }}" class="team-photo">
                            <div class="team-photo-meta">
                                <div class="team-photo-text">
                                    <h5>{{ $member->name }}</h5>
                                    <p>{{ $member->role }}</p>
                                </div>
                                <a href="{{ $member->linkedin_url ?: '#' }}" target="_blank" rel="noopener noreferrer" class="team-li-btn" aria-label="{{ __('site.about.team.linkedin', ['name' => $member->name]) }}">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <button class="team-nav-btn" type="button" data-dir="next" aria-label="{{ __('site.about.team.next') }}">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        @else
            <div class="alert alert-light border text-center">
                {{ __('site.about.team.empty') }}
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    (() => {
        const showcase = document.getElementById('teamShowcase');
        const nextBtn = document.querySelector('[data-dir="next"]');
        const prevBtn = document.querySelector('[data-dir="prev"]');

        if (!showcase || !nextBtn || !prevBtn || showcase.dataset.bound === '1') {
            return;
        }

        const getScrollStep = () => {
            const card = showcase.querySelector('.team-photo-card');
            const gap = parseInt(window.getComputedStyle(showcase).gap, 10) || 0;
            return card ? card.offsetWidth + gap : showcase.clientWidth;
        };

        nextBtn.addEventListener('click', () => {
            const step = getScrollStep();
            if (showcase.scrollLeft + showcase.clientWidth >= showcase.scrollWidth - 10) {
                showcase.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                showcase.scrollBy({ left: step, behavior: 'smooth' });
            }
        });

        prevBtn.addEventListener('click', () => {
            const step = getScrollStep();
            if (showcase.scrollLeft <= 10) {
                showcase.scrollTo({ left: showcase.scrollWidth, behavior: 'smooth' });
            } else {
                showcase.scrollBy({ left: -step, behavior: 'smooth' });
            }
        });

        showcase.dataset.bound = '1';
    })();
</script>
@endpush

<section style="background:#0d1a12; padding:4rem 0; text-align:center;">
    <div class="container" style="max-width:600px;">
        <h2 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif;">{{ __('site.about.final_cta.title') }}</h2>
        <p style="color:#9ca3af; margin-bottom:1.75rem;">{{ __('site.about.final_cta.text') }}</p>
        <a href="{{ route('contact') }}" class="btn-green">{{ __('site.about.final_cta.button') }}</a>
    </div>
</section>

@endsection
