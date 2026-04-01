@extends('layouts.app')
@section('title', 'Nous rejoindre — Yokkuté Labs')

@section('content')
<link href="{{ $versionedAsset('css/rejoindre.css') }}" rel="stylesheet">

{{-- HERO --}}
<section class="rejoindre-hero">
    <div class="rejoindre-hero-bg"></div>
    <div class="rejoindre-hero-grid"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div class="hero-tag mb-2 reveal">Carrières</div>
        <h1 class="reveal" style="transition-delay:.05s;">Construisons ensemble.</h1>
        <p class="mt-2 mb-0 reveal" style="transition-delay:.1s;">Vous avez de l'ambition, de la curiosité et l'envie de transformer les organisations africaines par le numérique ? Vous êtes au bon endroit.</p>
        <div class="promise-badges reveal" style="transition-delay:.15s;">
            <span class="pbadge reveal" style="transition-delay:.2s;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                 — quipe soudée
            </span>
            <span class="pbadge reveal" style="transition-delay:.25s;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                Projets à impact
            </span>
            <span class="pbadge reveal" style="transition-delay:.3s;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                Croissance réelle
            </span>
        </div>
    </div>
</section>

{{-- WHY US --}}
<section class="why-section">
    <div class="container">
        <div class="section-label reveal">Pourquoi Yokkuté ?</div>
        <h2 class="section-title reveal">Un endroit où votre travail compte vraiment.</h2>
        <div class="row g-4 mt-2">
            <div class="col-md-4 reveal">
                <div class="why-card">
                    <div class="why-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <h3>Projets concrets</h3>
                    <p>Vous ne ferez pas semblant d'innover. Vous travaillerez sur des transformations réelles, avec de vraies organisations, au c"ur de l'économie africaine.</p>
                </div>
            </div>
            <div class="col-md-4 reveal" style="transition-delay:.1s;">
                <div class="why-card">
                    <div class="why-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <h3>Apprentissage continu</h3>
                    <p>IA, data, stratégie, conseil — vous évoluez dans un environnement où apprendre est une habitude, pas une récompense.</p>
                </div>
            </div>
            <div class="col-md-4 reveal" style="transition-delay:.2s;">
                <div class="why-card">
                    <div class="why-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <h3>Ancrage africain</h3>
                    <p>Nous pensons global, mais nous agissons local. Rejoindre Yokkuté, c'est contribuer à l'émergence d'un écosystème tech africain souverain.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROFILES --}}
<section class="profiles-section">
    <div class="container">
        <div class="section-label reveal">Profils recherchés</div>
        <h2 class="section-title reveal">On ne cherche pas la perfection. On cherche la bonne personne.</h2>
        <div class="profiles-grid mt-4">

            <div class="profile-pill reveal">
                <span class="pill-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </span>
                Développeurs & ingénieurs
            </div>
            <div class="profile-pill reveal" style="transition-delay:.05s;">
                <span class="pill-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </span>
                Data analysts & BI
            </div>
            <div class="profile-pill reveal" style="transition-delay:.1s;">
                <span class="pill-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </span>
                Consultants en transformation
            </div>
            <div class="profile-pill reveal" style="transition-delay:.15s;">
                <span class="pill-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                </span>
                Chefs de projet digital
            </div>
            <div class="profile-pill reveal" style="transition-delay:.2s;">
                <span class="pill-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </span>
                Formateurs & experts métier
            </div>
            <div class="profile-pill reveal" style="transition-delay:.25s;">
                <span class="pill-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </span>
                Commerciaux & business dev
            </div>

        </div>
    </div>
</section>

{{-- FORM --}}
<section class="rejoindre-main">
    <div class="container">
        <div class="row g-5 align-items-start">

            {{-- INFO SIDE --}}
            <div class="col-lg-4 reveal">
                <h2 class="info-heading mb-2">Vous ne trouvez pas de poste listé ? Envoyez quand même.</h2>
                <p class="text-muted mt-3 mb-4" style="font-size:.9rem;line-height:1.8;">
                    Nous construisons notre équipe au fil des rencontres, pas seulement des annonces.
                    Si votre profil nous intéresse, nous vous contacterons — même sans besoin immédiat.
                </p>

                <div class="response-banner mb-4">
                    <span class="icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </span>
                    <span><strong>Engagement :</strong> chaque candidature est lue par un membre de l'équipe. Vous recevrez une réponse sous <strong>5 jours ouvrés</strong>.</span>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <div class="info-card-type">Siège</div>
                            <div class="info-card-value">{{ $siteSettings['contact_address'] ?? 'Dakar, Senegal' }}</div>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <div class="info-card-type">Candidatures</div>
                            <div class="info-card-value">
                                <a href="mailto:{{ $siteSettings['rh_email'] ?? 'rh@yokkute.com' }}">{{ $siteSettings['rh_email'] ?? 'rh@yokkute.com' }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        </div>
                        <div>
                            <div class="info-card-type">Modes</div>
                            <div class="info-card-value">Présentiel · Hybride · Remote</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM SIDE --}}
            <div class="col-lg-8 reveal" style="transition-delay:.15s;">
                <div class="form-card">

                    <div class="form-card-header">
                        <span class="form-card-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <h2>Candidature spontanée</h2>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('rejoindre.store') }}" method="POST" enctype="multipart/form-data" data-turbo="false">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Prénom *
                                </label>
                                <input type="text" name="prenom" placeholder="Jean" value="{{ old('prenom') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Nom *
                                </label>
                                <input type="text" name="nom" placeholder="Dupont" value="{{ old('nom') }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                    Email *
                                </label>
                                <input type="email" name="email" placeholder="vous@email.com" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.42 2 2 0 0 1 3.59 1.25h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6.13 6.13l1.27-.93a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7a2 2 0 0 1 1.77 2.01z"/></svg>
                                    Téléphone / WhatsApp
                                </label>
                                <input type="tel" name="telephone" placeholder="+221 XX XXX XX XX" value="{{ old('telephone') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                Domaine de compétence principal *
                            </label>
                            <select name="domaine" required>
                                <option value="">— Choisissez —</option>
                                @foreach([
                                    'dev'         => 'Développement & ingénierie',
                                    'data'        => 'Data, BI & analytics',
                                    'conseil'     => 'Conseil & transformation digitale',
                                    'projet'      => 'Gestion de projet',
                                    'formation'   => 'Formation & pédagogie',
                                    'commercial'  => 'Commercial & développement business',
                                    'marketing'   => 'Marketing & communication digitale',
                                    'autre'       => 'Autre / transversal',
                                ] as $val => $label)
                                    <option value="{{ $val }}" {{ old('domaine') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                Années d'expérience *
                            </label>
                            <select name="experience" required>
                                <option value="">— Choisissez —</option>
                                @foreach([
                                    'junior'    => 'Moins de 2 ans (Junior)',
                                    'confirme'  => '2 à 5 ans (Confirmé)',
                                    'senior'    => '5 à 10 ans (Senior)',
                                    'expert'    => 'Plus de 10 ans (Expert)',
                                ] as $val => $label)
                                    <option value="{{ $val }}" {{ old('experience') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                Lien LinkedIn ou portfolio
                            </label>
                            <input type="url" name="portfolio" placeholder="https://linkedin.com/in/vous" value="{{ old('portfolio') }}">
                        </div>

                        <div class="mb-3">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                CV (PDF, max 30 Mo)
                            </label>
                            <div class="file-upload-wrapper">
                                <input type="file" name="cv" id="cv-upload" accept="application/pdf,.pdf">
                                <label for="cv-upload" class="file-upload-label">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                    <span id="cv-label-text">Choisir un fichier</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Parlez-nous de vous *
                            </label>
                            <textarea name="message" placeholder="Pourquoi Yokkuté ? Qu'est-ce qui vous anime ? Quelles sont vos compétences clés ? Quelle contribution espérez-vous apporter ?" required minlength="20" maxlength="5000">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            Envoyer ma candidature
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>

                        <p class="form-note">Vos données sont utilisées uniquement dans le cadre du traitement de votre candidature. Elles ne seront jamais transmises à des tiers sans votre accord.</p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-rejoindre">
    <div class="container reveal">
        <h2>Vous avez une question avant de postuler ?</h2>
        <p>N'hésitez pas à nous contacter directement — nous serons ravis d'échanger.</p>
        <a href="{{ route('contact') }}" class="btn-cta-outline">
            Nous contacter
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>

@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:1090;">
    <div id="candidatureSuccessToast" class="toast align-items-center text-bg-success border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5500">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Candidature envoyee.</strong><br>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    (() => {
        const initRejoindrePage = () => {
            const rejoindreRevealEls = document.querySelectorAll('.reveal');

            if ('IntersectionObserver' in window) {
                const rejoindreRevealObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            rejoindreRevealObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

                rejoindreRevealEls.forEach((el) => rejoindreRevealObserver.observe(el));
            } else {
                rejoindreRevealEls.forEach((el) => el.classList.add('visible'));
            }

            const cvInput = document.getElementById('cv-upload');
            const cvLabelText = document.getElementById('cv-label-text');

            if (cvInput && cvLabelText && cvInput.dataset.bound !== '1') {
                cvInput.addEventListener('change', () => {
                    cvLabelText.textContent = cvInput.files[0]
                        ? cvInput.files[0].name
                        : 'Choisir un fichier';
                });

                cvInput.dataset.bound = '1';
            }

            const successToastEl = document.getElementById('candidatureSuccessToast');
            if (successToastEl && window.bootstrap?.Toast && successToastEl.dataset.shown !== '1') {
                const successToast = window.bootstrap.Toast.getOrCreateInstance(successToastEl);
                successToast.show();
                successToastEl.dataset.shown = '1';
            }
        };

        document.addEventListener('DOMContentLoaded', initRejoindrePage, { once: true });
        document.addEventListener('turbo:load', initRejoindrePage);

        if (document.readyState !== 'loading') {
            initRejoindrePage();
        }
    })();
</script>
@endpush

@endsection
