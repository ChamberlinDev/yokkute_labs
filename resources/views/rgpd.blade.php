@php
    $privacySections = trans('site.privacy.sections');
    $contactEmail = $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com';
    $emailLink = '<a href="mailto:'.$contactEmail.'" style="color: #1a7a4a;">'.$contactEmail.'</a>';
@endphp

@extends('layouts.app')

@section('title', __('site.privacy.title'))
@section('meta_description', app()->getLocale() === 'fr'
    ? 'Consultez la politique de confidentialite de Yokkute Labs : donnees collectees, finalites, conservation et droits des utilisateurs.'
    : 'Read the Yokkute Labs privacy policy: collected data, processing purposes, retention and user rights.')
@section('og_title', app()->getLocale() === 'fr'
    ? 'Politique de confidentialite - Yokkute Labs'
    : 'Privacy Policy - Yokkute Labs')
@section('og_description', app()->getLocale() === 'fr'
    ? 'Transparence et confiance sur l utilisation de vos donnees personnelles chez Yokkute Labs.'
    : 'Transparency and trust about how Yokkute Labs handles your personal data.')

@section('content')
<section class="py-5 mt-5">
    <div class="container" style="max-width: 780px;">
        <div class="text-center mb-5">
            <button onclick="onback()" style="background: none; border: none; cursor: pointer; margin-bottom: 1rem; display: inline-block; padding: 0.5rem; border-radius: 50%; transition: all 0.3s ease;" class="back-btn" title="{{ __('site.common.back') }}">
                <i class="bi bi-chevron-left" style="font-size: 1.5rem; color: #1a7a4a;"></i>
            </button>
            <p class="section-label text-uppercase fw-semibold mb-2" style="color: #1a7a4a; letter-spacing: .12em;">{{ __('site.privacy.tag') }}</p>
            <h1 class="display-6 fw-bold mb-3">{{ __('site.privacy.heading') }}</h1>
            <p class="text-muted">{{ __('site.common.last_updated') }} : {{ date('d/m/Y') }}</p>
        </div>

        <div class="rgpd-content" style="line-height: 1.85; color: #333;">
            @foreach($privacySections as $section)
                <h2 class="h5 fw-bold mt-4 mb-2">{{ $section['title'] }}</h2>

                @if(!empty($section['intro']))
                    <p>{{ $section['intro'] }}</p>
                @endif

                @if(!empty($section['paragraphs']))
                    @foreach($section['paragraphs'] as $paragraph)
                        <p>{!! str_replace(':email', $emailLink, $paragraph) !!}</p>
                    @endforeach
                @endif

                @if(!empty($section['items']))
                    <ul>
                        @foreach($section['items'] as $item)
                            <li>{!! str_replace(':email', $emailLink, $item) !!}</li>
                        @endforeach
                    </ul>
                @endif

                @if(!empty($section['closing']))
                    <p>{!! str_replace(':email', $emailLink, $section['closing']) !!}</p>
                @endif
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-outline-success px-4 py-2" style="border-color: #1a7a4a; color: #1a7a4a;">{{ __('site.privacy.cta') }}</a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    (() => {
        window.onback = function () {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = "{{ route('home') }}";
            }
        };

        const backBtn = document.querySelector('.back-btn');
        if (!backBtn || backBtn.dataset.bound === '1') {
            return;
        }

        backBtn.addEventListener('mouseenter', function () {
            this.style.backgroundColor = 'rgba(26, 122, 74, 0.1)';
        });

        backBtn.addEventListener('mouseleave', function () {
            this.style.backgroundColor = 'transparent';
        });

        backBtn.dataset.bound = '1';
    })();
</script>
@endpush

@endsection
