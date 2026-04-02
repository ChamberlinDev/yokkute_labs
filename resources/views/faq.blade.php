@php
    $faqItems = trans('site.faq.items');
@endphp

@extends('layouts.app')

@section('title', __('site.faq.title'))

@section('content')
<section class="py-5 mt-5">
    <div class="container" style="max-width: 780px;">
        <div class="text-center mb-5">
            <button onclick="onback()" style="background: none; border: none; cursor: pointer; margin-bottom: 1rem; display: inline-block; padding: 0.5rem; border-radius: 50%; transition: all 0.3s ease;" class="back-btn" title="{{ __('site.common.back') }}">
                <i class="bi bi-chevron-left" style="font-size: 1.5rem; color: #1a7a4a;"></i>
            </button>
            <p class="section-label text-uppercase fw-semibold mb-2" style="color: #1a7a4a; letter-spacing: .12em;">{{ __('site.faq.tag') }}</p>
            <h1 class="display-6 fw-bold mb-3">{{ __('site.faq.heading') }}</h1>
            <p class="text-muted">{{ __('site.faq.text') }}</p>
        </div>

        <div class="accordion accordion-flush" id="faqAccordion">
            @foreach($faqItems as $index => $item)
                @php
                    $collapseId = 'faq'.($index + 1);
                @endphp
                <div class="accordion-item border rounded mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}">
                            {{ $item['question'] }}
                        </button>
                    </h2>
                    <div id="{{ $collapseId }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">{{ $item['answer'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <p class="text-muted mb-3">{{ __('site.faq.closing') }}</p>
            <a href="{{ route('contact') }}" class="btn btn-success px-4 py-2" style="background-color: #1a7a4a; border-color: #1a7a4a;">{{ __('site.faq.button') }}</a>
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
