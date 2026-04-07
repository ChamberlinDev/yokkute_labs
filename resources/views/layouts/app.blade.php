<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="chatbot-session-lifetime-minutes" content="{{ (int) config('session.lifetime', 120) }}">
    @php
        $currentLocale = app()->getLocale();
        $siteUrl = rtrim((string) config('app.url', url('/')), '/');
        $rawPath = request()->getPathInfo();
        $pathWithoutLocale = preg_replace('#^/(fr|en)(?=/|$)#', '', $rawPath) ?: '/';
        $frPath = $pathWithoutLocale === '/' ? '/fr' : '/fr'.$pathWithoutLocale;
        $enPath = $pathWithoutLocale === '/' ? '/en' : '/en'.$pathWithoutLocale;
        $defaultMetaDescription = $currentLocale === 'fr'
            ? 'Agence de transformation numerique a Dakar, Senegal - audit, SEO, IA, ERP pour PME africaines. Solutions concretes, sans jargon.'
            : 'Digital transformation agency in Dakar, Senegal - audit, SEO, AI, ERP for African SMEs. Concrete solutions, no jargon.';
        $defaultOgTitle = $currentLocale === 'fr'
            ? 'Yokkute Labs - Agence numerique a Dakar, Senegal'
            : 'Yokkute Labs - Digital Agency in Dakar, Senegal';
        $defaultOgDescription = $currentLocale === 'fr'
            ? 'Transformation digitale pour les entreprises africaines. De l audit a l IA.'
            : 'Digital transformation for African businesses, from audit to AI.';
        $defaultOgImage = asset('images/logo-yokkute.png');
        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'Yokkute Labs',
            'alternateName' => 'Yokkute Labs',
            'description' => $currentLocale === 'fr'
                ? 'Agence de transformation numerique a Dakar, Senegal. Audit, SEO, ERP, IA et Big Data pour PME africaines.'
                : 'Digital transformation agency in Dakar, Senegal. Audit, SEO, ERP, AI and Big Data for African SMEs.',
            'url' => $siteUrl,
            'logo' => asset('images/logo-yokkute.png'),
            'telephone' => $siteSettings['contact_phone_href'] ?? '+221771488937',
            'email' => $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Dakar',
                'addressRegion' => 'Dakar',
                'addressCountry' => 'SN',
            ],
            'areaServed' => [
                ['@type' => 'Country', 'name' => 'Senegal'],
                ['@type' => 'Place', 'name' => 'West Africa'],
            ],
            'serviceType' => [
                'Audit numerique',
                'SEO et referencement',
                'Integration ERP',
                'Intelligence artificielle',
                'Big Data et Business Intelligence',
                'Formation numerique',
            ],
            'inLanguage' => ['fr', 'en'],
        ];
    @endphp

    {{-- SEO --}}
    <title>@yield('title', $localizedSetting($siteSettings ?? [], 'home_meta_title', 'site.settings.home_meta_title'))</title>
    <meta name="description" content="@yield('meta_description', $defaultMetaDescription)">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- hreflang --}}
    <link rel="alternate" hreflang="fr" href="{{ url($frPath) }}" />
    <link rel="alternate" hreflang="en" href="{{ url($enPath) }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $siteUrl }}" />

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og_title', $defaultOgTitle)">
    <meta property="og:description" content="@yield('og_description', $defaultOgDescription)">
    <meta property="og:image" content="@yield('og_image', $defaultOgImage)">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ $currentLocale === 'fr' ? 'fr_SN' : 'en_US' }}">
    <meta property="og:site_name" content="Yokkute Labs">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $defaultOgTitle)">
    <meta name="twitter:description" content="@yield('og_description', $defaultOgDescription)">
    <meta name="twitter:image" content="@yield('og_image', $defaultOgImage)">

    {{-- Structured data --}}
    <script type="application/ld+json">
    @json($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
    </script>

    @if (app()->isProduction())
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-6503ZFYF8E"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-6503ZFYF8E');
        </script>
    @endif

    <link rel="icon" type="image/png" href="{{ $versionedAsset('images/logo-yokkute.png') }}">
    <link rel="preload" href="{{ $versionedAsset('css/yokkute.css') }}" as="style">
    <link rel="preload" href="{{ $versionedAsset('images/logo-yokkute.png') }}" as="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ $versionedAsset('css/yokkute.css') }}" rel="stylesheet">
    <link href="{{ $versionedAsset('css/chatbot.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.13/dist/turbo.es2017-umd.js" data-turbo-track="reload"></script>
    <script src="{{ $versionedAsset('js/chatbot.js') }}" defer></script>
    @stack('styles')
</head>
<body>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    <button type="button" class="scroll-top-btn" id="scrollTopBtn" aria-label="Retour en haut">
        <i class="bi bi-arrow-up"></i>
    </button>

    <style>
        .scroll-top-btn {
            position: fixed;
            right: 5.25rem;
            bottom: 1rem;
            width: 44px;
            height: 44px;
            border: 0;
            border-radius: 999px;
            background: linear-gradient(135deg, #1a7a4a, #23a065);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(26, 122, 74, 0.28);
            z-index: 1040;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(12px);
            transition: opacity .22s ease, visibility .22s ease, transform .22s ease, filter .2s ease;
        }

        .scroll-top-btn.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .scroll-top-btn:hover {
            filter: brightness(1.04);
        }

        .scroll-top-btn:focus-visible {
            outline: 2px solid #ffffff;
            outline-offset: 2px;
        }

        @media (max-width: 768px) {
            .scroll-top-btn {
                right: .85rem;
                bottom: 5.4rem;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            const initializeMobileNav = () => {
                const burger = document.getElementById('navBurger');
                const links = document.getElementById('navLinks');
                const overlay = document.getElementById('navOverlay');

                if (!burger || !links || !overlay || burger.dataset.bound === '1') {
                    return;
                }

                const setOpenState = (isOpen) => {
                    burger.classList.toggle('open', isOpen);
                    links.classList.toggle('open', isOpen);
                    overlay.classList.toggle('visible', isOpen);
                    burger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    document.body.classList.toggle('nav-open', isOpen);
                };

                const toggleMenu = () => setOpenState(!links.classList.contains('open'));
                const closeMenu = () => setOpenState(false);

                burger.addEventListener('click', toggleMenu);
                overlay.addEventListener('click', closeMenu);

                links.querySelectorAll('a').forEach((anchor) => {
                    anchor.addEventListener('click', closeMenu);
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeMenu();
                    }
                });

                window.addEventListener('resize', () => {
                    if (window.innerWidth > 820) {
                        closeMenu();
                    }
                });

                burger.dataset.bound = '1';
                setOpenState(false);
            };

            const initializePageEffects = () => {
                const excludedScope = '.navbar-yokkute, .footer-yokkute, script, style, form, .form-card';
                const cinematicSlowSelector = 'h1, h2, h3, .section-title, .nd-title, .hero-title, .approche-title, .info-heading, .hero-tag, .section-label';
                const autoCandidates = document.querySelectorAll(
                    'section .text-center, section .row > [class*="col-"], section .roadmap-step, section .approche-header, section .approche-cta, section .nd-header, section .nd-bridge'
                );

                autoCandidates.forEach((el, index) => {
                    if (el.closest(excludedScope)) {
                        return;
                    }

                    if (!el.classList.contains('reveal') && !el.classList.contains('auto-reveal') && !el.hasAttribute('data-reveal')) {
                        el.classList.add('auto-reveal');
                    }

                    const isSlow = el.matches(cinematicSlowSelector) || !!el.querySelector(cinematicSlowSelector) || el.classList.contains('text-center');

                    if (!el.classList.contains('reveal-slow') && !el.classList.contains('reveal-fast')) {
                        el.classList.add(isSlow ? 'reveal-slow' : 'reveal-fast');
                    }

                    if (!el.style.transitionDelay) {
                        const step = isSlow ? 0.1 : 0.06;
                        const max = isSlow ? 0.6 : 0.36;
                        el.style.transitionDelay = `${Math.min((index % 8) * step, max)}s`;
                    }
                });

                const revealTargets = document.querySelectorAll('.reveal, .auto-reveal, [data-reveal]');
                if (!revealTargets.length) {
                    return;
                }

                revealTargets.forEach((el, index) => {
                    const isSlow = el.matches(cinematicSlowSelector) || el.classList.contains('text-center');

                    if (!el.classList.contains('reveal-slow') && !el.classList.contains('reveal-fast')) {
                        el.classList.add(isSlow ? 'reveal-slow' : 'reveal-fast');
                    }

                    if (!el.style.transitionDelay) {
                        const step = isSlow ? 0.1 : 0.06;
                        const max = isSlow ? 0.6 : 0.36;
                        el.style.transitionDelay = `${Math.min((index % 8) * step, max)}s`;
                    }
                });

                if ('IntersectionObserver' in window) {
                    const globalRevealObserver = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('visible');
                                globalRevealObserver.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.2, rootMargin: '0px 0px -12% 0px' });

                    revealTargets.forEach((el) => globalRevealObserver.observe(el));
                } else {
                    revealTargets.forEach((el) => el.classList.add('visible'));
                }
            };

            const initializeScrollTopButton = () => {
                const btn = document.getElementById('scrollTopBtn');

                if (!btn || btn.dataset.bound === '1') {
                    return;
                }

                const toggleVisibility = () => {
                    const shouldShow = window.scrollY > 320;
                    btn.classList.toggle('visible', shouldShow);
                };

                btn.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });

                window.addEventListener('scroll', toggleVisibility, { passive: true });
                toggleVisibility();
                btn.dataset.bound = '1';
            };

            document.addEventListener('DOMContentLoaded', initializeMobileNav, { once: true });
            document.addEventListener('turbo:load', initializeMobileNav);
            document.addEventListener('DOMContentLoaded', initializePageEffects, { once: true });
            document.addEventListener('turbo:load', initializePageEffects);
            document.addEventListener('DOMContentLoaded', initializeScrollTopButton, { once: true });
            document.addEventListener('turbo:load', initializeScrollTopButton);
        })();
    </script>
    @stack('scripts')
</body>
</html>
