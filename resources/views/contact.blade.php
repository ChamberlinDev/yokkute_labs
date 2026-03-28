@extends('layouts.app')
@section('title', 'Contact — Yokkuté Labs')

@section('content')
<link href="{{ asset('css/contact.css') }}" rel="stylesheet">

{{-- ── HERO ── --}}
<section class="contact-hero">
    <div class="contact-hero-bg"></div>
    <div class="contact-hero-grid"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div class="hero-tag mb-2">Contact</div>
        <h1>Parlons-nous.</h1>
        <p class="mt-2 mb-0">Posez-nous votre question, décrivez votre projet ou demandez simplement un échange exploratoire.</p>
        <div class="promise-badges">
            <span class="pbadge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Réponse en 24h ouvrées
            </span>
            <span class="pbadge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Zéro spam
            </span>
            <span class="pbadge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Un humain vous lit
            </span>
        </div>
    </div>
</section>

{{-- ── MAIN ── --}}
<section class="contact-main">
    <div class="container">
        <div class="row g-5 align-items-start">

            {{-- INFO SIDE --}}
            <div class="col-lg-4 reveal">
                <h2 class="info-heading mb-2">Chaque grande transformation commence par une conversation.</h2>
                <p class="text-muted mt-3 mb-4" style="font-size:.9rem;line-height:1.8;">
                    Si vous ne savez pas encore exactement ce que vous cherchez — c'est normal.
                    Dites-nous juste où vous en êtes, et on vous aidera à y voir plus clair.
                </p>

                {{-- Response time --}}
                <div class="response-banner mb-4">
                    <span class="icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </span>
                    <span><strong>Engagement :</strong> on s'engage à vous répondre dans les <strong>24h ouvrées</strong>, avec un humain qui a lu votre message.</span>
                </div>

                {{-- Info cards --}}
                <div class="d-flex flex-column gap-3">

                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <div class="info-card-type">Adresse</div>
                            <div class="info-card-value">Dakar, Sénégal</div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div>
                            <div class="info-card-type">Email</div>
                            <div class="info-card-value">
                                <a href="mailto:contact@yokkute.com">contact@yokkute.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="info-card-type">WhatsApp</div>
                            <div class="info-card-value">
                                +221 XX XXX XX XX
                                <span style="display:block;font-size:.75rem;color:#9ca3af;font-weight:400;">Réponse rapide</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- FORM SIDE --}}
            <div class="col-lg-8 reveal" style="transition-delay:.15s;">
                <div class="form-card">

                    <div class="form-card-header">
                        <span class="form-card-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <h2>Envoyez-nous un message</h2>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="#" method="POST">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Prénom *
                                </label>
                                <input type="text" name="prenom" placeholder="Jean" value="{{ old('prenom') }}">
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Nom *
                                </label>
                                <input type="text" name="nom" placeholder="Dupont" value="{{ old('nom') }}">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                    Email professionnel *
                                </label>
                                <input type="email" name="email" placeholder="vous@entreprise.com" value="{{ old('email') }}">
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    WhatsApp
                                </label>
                                <input type="tel" name="whatsapp" placeholder="+221 XX XXX XX XX" value="{{ old('whatsapp') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                Votre entreprise
                            </label>
                            <input type="text" name="entreprise" placeholder="Nom de votre structure" value="{{ old('entreprise') }}">
                        </div>

                        <div class="mb-3">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                Quel est votre besoin principal ? *
                            </label>
                            <select name="besoin">
                                <option value="">— Choisissez —</option>
                                @foreach([
                                    'audit'         => 'Audit numérique',
                                    'conseil'       => 'Conseil stratégique',
                                    'referencement' => 'Référencement & présence digitale',
                                    'integration'   => 'Intégration numérique (ERP, CRM…)',
                                    'ia'            => 'Intégration IA',
                                    'formation'     => 'Formation',
                                    'bigdata'       => 'Big Data & Business Intelligence',
                                    'autre'         => 'Je ne sais pas encore — j\'ai besoin d\'orientation',
                                ] as $val => $label)
                                    <option value="{{ $val }}" {{ old('besoin') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Décrivez votre situation *
                            </label>
                            <textarea name="message" placeholder="Où en êtes-vous ? Quel problème cherchez-vous à résoudre ? Quel est votre horizon de temps ?">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            Envoyer mon message
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>

                        <p class="form-note">En soumettant ce formulaire, vous acceptez que vos données soient utilisées pour vous recontacter dans le cadre de votre demande. Aucune utilisation commerciale sans votre accord.</p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── CTA ── --}}
<section class="cta-contact">
    <div class="container reveal">
        <h2>Pas encore prêt à écrire ?</h2>
        <p>Découvrez d'abord nos services pour voir si notre approche vous correspond.</p>
        <a href="{{ route('services') }}" class="btn-cta-outline">
            Voir nos services
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>

@push('scripts')
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
@endpush

@endsection