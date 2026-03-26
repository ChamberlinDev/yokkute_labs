@extends('layouts.app')
@section('title', 'Contact — Yokkuté Labs')
@section('content')

{{-- HEADER --}}
<section class="page-header-sm">
    <div class="container">
        <div class="section-tag">Contact</div>
        <h1>Parlons-nous.</h1>
        <p>Posez-nous votre question, décrivez votre projet ou demandez simplement un échange exploratoire.</p>
    </div>
</section>

{{-- INTRO + CARDS INFO --}}
<section class="py-5">
    <div class="container">

        <div class="row g-5 align-items-start mb-5">
            <div class="col-lg-5">
                <div class="section-tag">On est là</div>
                <h2>Chaque grande transformation commence par une conversation.</h2>
                <p class="text-muted mt-3">Pas de formulaire qui disparaît dans le vide. Pas de réponse automatique. <strong class="text-dark">On s'engage à vous répondre dans les 24h ouvrées</strong>, avec un humain qui a lu votre message.</p>
                <p class="text-muted">Si vous ne savez pas encore exactement ce que vous cherchez — c'est normal. Dites-nous juste où vous en êtes, et on vous aidera à y voir plus clair.</p>

                {{-- CARDS CONTACT --}}
                <div class="row g-3 mt-2">
                    <div class="col-12">
                        <div class="contact-card d-flex align-items-center gap-3 text-start" style="border-top:none; border-left:4px solid var(--green);">
                            <div class="contact-icon mb-0">📍</div>
                            <div>
                                <div class="contact-type">Adresse</div>
                                <div class="contact-value">[Ville, Pays] — [Quartier]</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-card d-flex align-items-center gap-3 text-start" style="border-top:none; border-left:4px solid var(--green);">
                            <div class="contact-icon mb-0">✉️</div>
                            <div>
                                <div class="contact-type">Email</div>
                                <div class="contact-value"><a href="mailto:contact@yokkute.com" style="color:inherit;">contact@yokkute.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-card d-flex align-items-center gap-3 text-start" style="border-top:none; border-left:4px solid var(--green);">
                            <div class="contact-icon mb-0">💬</div>
                            <div>
                                <div class="contact-type">WhatsApp</div>
                                <div class="contact-value">+221 XX XXX XX XX <span class="fw-normal text-muted" style="font-size:0.8rem;">— Réponse rapide</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORMULAIRE --}}
            <div class="col-lg-7">
                <div class="section-tag">Formulaire de contact</div>
                <h2 class="mb-4">Envoyez-nous un message</h2>

                @if(session('success'))
                    <div class="alert alert-success border-0 rounded-0">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-0">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-wrapper">
                    <form action="#" method="POST">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label>Prénom *</label>
                                <input type="text" name="prenom" placeholder="Jean" value="{{ old('prenom') }}">
                            </div>
                            <div class="col-sm-6">
                                <label>Nom *</label>
                                <input type="text" name="nom" placeholder="Dupont" value="{{ old('nom') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Email professionnel *</label>
                            <input type="email" name="email" placeholder="vous@entreprise.com" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label>Numéro WhatsApp</label>
                            <input type="tel" name="whatsapp" placeholder="+221 XX XXX XX XX" value="{{ old('whatsapp') }}">
                        </div>

                        <div class="mb-3">
                            <label>Votre entreprise</label>
                            <input type="text" name="entreprise" placeholder="Nom de votre structure" value="{{ old('entreprise') }}">
                        </div>

                        <div class="mb-3">
                            <label>Quel est votre besoin principal ? *</label>
                            <select name="besoin">
                                <option value="">— Choisissez —</option>
                                @foreach([
                                    'audit'          => 'Audit numérique',
                                    'conseil'        => 'Conseil stratégique',
                                    'referencement'  => 'Référencement & présence digitale',
                                    'integration'    => 'Intégration numérique (ERP, CRM…)',
                                    'ia'             => 'Intégration IA',
                                    'formation'      => 'Formation',
                                    'bigdata'        => 'Big Data & Business Intelligence',
                                    'autre'          => 'Je ne sais pas encore — j\'ai besoin d\'orientation',
                                ] as $val => $label)
                                    <option value="{{ $val }}" {{ old('besoin') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label>Décrivez votre situation *</label>
                            <textarea name="message" placeholder="Où en êtes-vous ? Quel problème cherchez-vous à résoudre ? Quel est votre horizon de temps ?">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn-green w-100 py-3">Envoyer mon message →</button>

                        <p class="form-note">En soumettant ce formulaire, vous acceptez que vos données soient utilisées pour vous recontacter dans le cadre de votre demande. Aucune utilisation commerciale sans votre accord.</p>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="strip-cta">
    <h2>Pas encore prêt à écrire ?</h2>
    <p>Découvrez d'abord nos services pour voir si notre approche vous correspond.</p>
    <a href="{{ route('services') }}" class="btn-green">Voir nos services →</a>
</section>

@endsection