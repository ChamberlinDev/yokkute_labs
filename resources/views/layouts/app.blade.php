<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="chatbot-session-lifetime-minutes" content="{{ (int) config('session.lifetime', 120) }}">
    <title>@yield('title', 'Yokkuté Labs')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-yokkute.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/yokkute.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chatbot.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.13/dist/turbo.es2017-umd.js" data-turbo-track="reload"></script>
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    @stack('styles')
</head>
<body>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

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

            document.addEventListener('DOMContentLoaded', initializeMobileNav, { once: true });
            document.addEventListener('turbo:load', initializeMobileNav);
            document.addEventListener('DOMContentLoaded', initializePageEffects, { once: true });
            document.addEventListener('turbo:load', initializePageEffects);
        })();
    </script>
    @stack('scripts')
</body>
</html>
