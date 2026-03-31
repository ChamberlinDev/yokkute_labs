@extends('layouts.app')
@section('title', 'Contact — Yokkuté Labs')

@section('content')
<link href="{{ asset('css/contact.css') }}" rel="stylesheet">

{{-- HERO --}}
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

{{-- MAIN --}}
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
                    <span><strong>Engagement :</strong> nous nous engageons à vous répondre sous <strong>24 heures ouvrées</strong>, avec un humain qui lit votre message.</span>
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
                            <div class="info-card-value">{{ $siteSettings['contact_address'] ?? 'Dakar, Senegal' }}</div>
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
                                <a href="mailto:{{ $siteSettings['contact_email'] ?? 'contact@yokkute.com' }}">{{ $siteSettings['contact_email'] ?? 'contact@yokkute.com' }}</a>
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
                                {{ $siteSettings['contact_phone'] ?? '+221 77 000 00 00' }}
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

                    <form action="{{ route('contact.store') }}" method="POST" data-turbo="false">
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
                                    'integration'   => 'Intégration numérique (ERP, CRM — )',
                                    'ia'            => 'Intégration IA',
                                    'formation'     => 'Formation',
                                    'bigdata'       => 'Big Data & Business Intelligence',
                                    'orientation'   => 'J\'ai besoin d\'être orienté par un conseiller',
                                ] as $val => $label)
                                    <option value="{{ $val }}" {{ old('besoin') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="orientation-helper mt-2">
                                Si vous hésitez, un conseiller peut vous aider a identifier l'option la plus adaptee.
                            </div>
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

<div class="modal fade orientation-modal" id="orientationModal" tabindex="-1" aria-labelledby="orientationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body p-4 p-md-5">
                <button type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Fermer"></button>

                <div class="orientation-modal-badge mb-3">Besoin d'orientation</div>
                <h3 id="orientationModalLabel" class="orientation-modal-title mb-3">Parlons avec un conseiller avant de choisir.</h3>
                <p class="orientation-modal-text mb-4">
                    Si votre besoin n'est pas encore clair, inutile de deviner. Un court echange avec un professionnel Yokkute Labs peut vous aider a identifier la meilleure option selon votre situation.
                </p>

                <div class="orientation-modal-actions d-flex flex-column gap-3">
                    <a href="https://wa.me/{{ $siteSettings['whatsapp_number'] ?? '221770000000' }}?text=Bonjour%20Yokkute%20Labs%2C%20j%27aimerais%20etre%20oriente%20sur%20le%20service%20le%20plus%20adapte%20a%20mon%20besoin." target="_blank" rel="noopener noreferrer" class="orientation-action-primary">
                        Discuter sur WhatsApp avec un conseiller
                    </a>
                    <a href="mailto:{{ $siteSettings['contact_email'] ?? 'contact@yokkute.com' }}?subject=Demande%20d%27orientation&body=Bonjour%2C%20j%27aimerais%20etre%20oriente%20vers%20le%20service%20le%20plus%20adapte%20a%20mon%20besoin." class="orientation-action-secondary">
                        Demander une orientation par email
                    </a>
                    <button type="button" class="orientation-action-link" data-bs-dismiss="modal">
                        Continuer avec le formulaire
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
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
    (() => {
        const initContactPage = () => {
            const besoinSelect = document.querySelector('select[name="besoin"]');
            const orientationModalEl = document.getElementById('orientationModal');
            const orientationModal = orientationModalEl && window.bootstrap?.Modal
                ? window.bootstrap.Modal.getOrCreateInstance(orientationModalEl)
                : null;

            if (!besoinSelect || !orientationModal || besoinSelect.dataset.orientationBound === '1') {
                return;
            }

            const maybeShowOrientationModal = () => {
                if (besoinSelect.value === 'orientation') {
                    orientationModal.show();
                }
            };

            besoinSelect.addEventListener('change', maybeShowOrientationModal);
            besoinSelect.dataset.orientationBound = '1';
            maybeShowOrientationModal();
        };

        document.addEventListener('DOMContentLoaded', initContactPage, { once: true });
        document.addEventListener('turbo:load', initContactPage);

        if (document.readyState !== 'loading') {
            initContactPage();
        }
    })();
</script>
@endpush

@endsection
