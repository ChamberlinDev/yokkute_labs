@extends('layouts.app')

@section('title', 'Politique RGPD — Yokkuté Labs')

@section('content')
<section class="py-5 mt-5">
    <div class="container" style="max-width: 780px;">

        <div class="text-center mb-5">
            <button onclick="onback()" style="background: none; border: none; cursor: pointer; margin-bottom: 1rem; display: inline-block; padding: 0.5rem; border-radius: 50%; transition: all 0.3s ease;" class="back-btn" title="Retour">
                <i class="bi bi-chevron-left" style="font-size: 1.5rem; color: #1a7a4a;"></i>
            </button>
            <p class="section-label text-uppercase fw-semibold mb-2" style="color: #1a7a4a; letter-spacing: .12em;">Transparence & confiance</p>
            <h1 class="display-6 fw-bold mb-3">Politique de confidentialité (RGPD)</h1>
            <p class="text-muted">Dernière mise à jour : {{ date('d/m/Y') }}</p>
        </div>

        <div class="rgpd-content" style="line-height: 1.85; color: #333;">

            <h2 class="h5 fw-bold mt-4 mb-2">1. Responsable du traitement</h2>
            <p>
                Le site <strong>yokkutelabs.com</strong> est édité et exploité par <strong>Yokkuté Labs</strong>, agence de transformation numérique basée à Dakar, Sénégal.
                Pour toute question relative à vos données personnelles, vous pouvez nous contacter à l'adresse : <a href="mailto:{{ $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com' }}" style="color: #1a7a4a;">{{ $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com' }}</a>.
            </p>

            <h2 class="h5 fw-bold mt-4 mb-2">2. Données collectées</h2>
            <p>Nous collectons les données personnelles suivantes dans le cadre de nos formulaires :</p>
            <ul>
                <li><strong>Formulaire de contact :</strong> prénom, nom, email, numéro WhatsApp, nom de l'entreprise, nature du besoin, message.</li>
                <li><strong>Formulaire de candidature :</strong> prénom, nom, email, téléphone, domaine d'expertise, niveau d'expérience, portfolio, lettre de motivation, CV (fichier PDF).</li>
            </ul>

            <h2 class="h5 fw-bold mt-4 mb-2">3. Finalités du traitement</h2>
            <p>Ces données sont collectées dans le but exclusif de :</p>
            <ul>
                <li>Traiter et répondre à vos demandes de contact ou de renseignement.</li>
                <li> — tudier et traiter les candidatures spontanées ou les offres d'emploi.</li>
                <li>Améliorer la qualité de nos services.</li>
            </ul>
            <p>Vos données ne sont jamais vendues, louées ou cédées à des tiers à des fins commerciales.</p>

            <h2 class="h5 fw-bold mt-4 mb-2">4. Base légale</h2>
            <p>
                Le traitement de vos données repose sur votre <strong>consentement explicite</strong> lors de la soumission d'un formulaire, ainsi que sur l'<strong>intérêt légitime</strong> de Yokkuté Labs à répondre aux demandes entrantes et à recruter.
            </p>

            <h2 class="h5 fw-bold mt-4 mb-2">5. Durée de conservation</h2>
            <ul>
                <li><strong>Messages de contact :</strong> conservés pour une durée maximale de 12 mois après traitement de la demande.</li>
                <li><strong>Candidatures :</strong> conservées pour une durée maximale de 24 mois à compter de la réception, sauf accord de votre part pour une durée plus longue.</li>
            </ul>

            <h2 class="h5 fw-bold mt-4 mb-2">6. Sécurité des données</h2>
            <p>
                Nous mettons en "uvre des mesures techniques et organisationnelles appropriées pour protéger vos données contre tout accès non autorisé, perte, altération ou divulgation. Les fichiers CV sont stockés de manière sécurisée et accessibles uniquement par l'équipe interne habilitée.
            </p>

            <h2 class="h5 fw-bold mt-4 mb-2">7. Vos droits</h2>
            <p>Conformément à la réglementation applicable, vous disposez des droits suivants concernant vos données personnelles :</p>
            <ul>
                <li><strong>Droit d'accès :</strong> obtenir une copie de vos données.</li>
                <li><strong>Droit de rectification :</strong> corriger des données inexactes.</li>
                <li><strong>Droit à l'effacement :</strong> demander la suppression de vos données.</li>
                <li><strong>Droit d'opposition :</strong> vous opposer au traitement.</li>
                <li><strong>Droit à la portabilité :</strong> recevoir vos données dans un format structuré.</li>
            </ul>
            <p>Pour exercer ces droits, contactez-nous à : <a href="mailto:{{ $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com' }}" style="color: #1a7a4a;">{{ $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com' }}</a>. Nous nous engageons à répondre dans un délai maximum de <strong>30 jours</strong>.</p>

            <h2 class="h5 fw-bold mt-4 mb-2">8. Cookies</h2>
            <p>
                Ce site n'utilise pas de cookies publicitaires ni de traceurs tiers. Des cookies techniques strictement nécessaires au bon fonctionnement du site (session, sécurité CSRF) peuvent être utilisés.
            </p>

            <h2 class="h5 fw-bold mt-4 mb-2">9. Modifications</h2>
            <p>
                Yokkuté Labs se réserve le droit de modifier la présente politique à tout moment. Toute modification sera publiée sur cette page avec une date de mise à jour actualisée.
            </p>

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-outline-success px-4 py-2" style="border-color: #1a7a4a; color: #1a7a4a;">Une question sur vos données ? Contactez-nous</a>
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
