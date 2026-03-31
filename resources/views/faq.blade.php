@extends('layouts.app')

@section('title', 'FAQ — Yokkuté Labs')

@section('content')
<section class="py-5 mt-5">
    <div class="container" style="max-width: 780px;">

        <div class="text-center mb-5">
            <button onclick="onback()" style="background: none; border: none; cursor: pointer; margin-bottom: 1rem; display: inline-block; padding: 0.5rem; border-radius: 50%; transition: all 0.3s ease;" class="back-btn" title="Retour">
                <i class="bi bi-chevron-left" style="font-size: 1.5rem; color: #1a7a4a;"></i>
            </button>
            <p class="section-label text-uppercase fw-semibold mb-2" style="color: #1a7a4a; letter-spacing: .12em;">Questions fréquentes</p>
            <h1 class="display-6 fw-bold mb-3">FAQ</h1>
            <p class="text-muted">Vous avez une question ? Retrouvez ci-dessous les réponses aux interrogations les plus courantes sur nos services et notre fonctionnement.</p>
        </div>

        <div class="accordion accordion-flush" id="faqAccordion">

            <div class="accordion-item border rounded mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Quels types de projets prenez-vous en charge ?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Nous accompagnons les entreprises et porteurs de projets sur la création de sites web, le développement d'applications sur mesure, le design UX/UI, et la transformation digitale globale.
                    </div>
                </div>
            </div>

            <div class="accordion-item border rounded mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Quel est le délai moyen pour réaliser un projet ?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Le délai varie selon la complexité du projet. Un site vitrine peut être livré en 2 à 4 semaines, tandis qu'une application métier sur mesure peut nécessiter plusieurs mois. Nous établissons un planning détaillé dès la phase de cadrage.
                    </div>
                </div>
            </div>

            <div class="accordion-item border rounded mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Comment se déroule une première prise de contact ?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Il vous suffit de remplir notre <a href="{{ route('contact') }}" style="color: #1a7a4a;">formulaire de contact</a>. Nous vous recontactons sous 24 à 48 heures pour un premier échange afin de comprendre vos besoins et définir ensemble les grandes lignes du projet.
                    </div>
                </div>
            </div>

            <div class="accordion-item border rounded mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        Proposez-vous un suivi après la livraison du projet ?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Oui. Nous proposons des contrats de maintenance et d'évolution pour assurer la pérennité de vos solutions. Nous restons disponibles pour toute correction, mise à jour ou ajout de fonctionnalité après la livraison.
                    </div>
                </div>
            </div>

            <div class="accordion-item border rounded mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        Comment protégez-vous mes données personnelles ?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        La protection de vos données est une priorité. Consultez notre <a href="{{ route('rgpd') }}" style="color: #1a7a4a;">Politique RGPD</a> pour en savoir plus sur la collecte, l'utilisation et la durée de conservation de vos informations.
                    </div>
                </div>
            </div>

            <div class="accordion-item border rounded mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                        Puis-je rejoindre l'équipe Yokkuté Labs ?
                    </button>
                </h2>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Oui ! Nous sommes toujours à la recherche de talents passionnés. Consultez notre page <a href="{{ route('rejoindre') }}" style="color: #1a7a4a;">Nous rejoindre</a> pour soumettre votre candidature.
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <p class="text-muted mb-3">Vous n'avez pas trouvé la réponse à votre question ?</p>
            <a href="{{ route('contact') }}" class="btn btn-success px-4 py-2" style="background-color: #1a7a4a; border-color: #1a7a4a;">Contactez-nous</a>
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
