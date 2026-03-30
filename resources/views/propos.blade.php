@extends('layouts.app')
@section('title', 'À propos — Yokkuté Labs')
@section('content')


<link href="{{ asset('css/propos.css') }}" rel="stylesheet">

{{-- """ HEADER """ --}}
<section style="
    background: url('{{ asset('images/img3.jpeg') }}') center/cover no-repeat;
    padding: 4rem 0;
    position: relative;">
    {{-- Overlay sombre pour lisibilité --}}
    <div style="
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.60);
        backdrop-filter: blur(1px);
    "></div>

    <div class="container" style="position: relative; z-index: 1;">
        <p class="mb-2 reveal propos-safe-text" style="font-size:.75rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#1a7a4a;">À propos</p>
        <h1 class="fw-bold mb-2 reveal propos-safe-text" style="color:white; font-family:'Sora',sans-serif; font-size:clamp(2rem,5vw,3rem);">Yokkuté Labs.</h1>
        <p class="reveal propos-safe-text" style="color:#9ca3af; font-size:.95rem; margin:0;">Qui nous sommes, ce en quoi nous croyons, et pourquoi ça compte pour vous.</p>
    </div>
</section>

{{-- """ QUI SOMMES-NOUS """ --}}
<section class="py-5 overflow-hidden">
    <div class="container">
        <div class="row g-5 align-items-center">

            {{-- Colonne texte --}}
            <div class="col-lg-6 reveal">
                <p class="section-tag-about propos-safe-text">Qui sommes-nous ?</p>
                <h2 class="fw-bold mb-3 propos-safe-text" style="font-family:'Sora',sans-serif; font-size:clamp(1.6rem,3.5vw,2.2rem); line-height:1.3;">
                    Une équipe née de la conviction que le numérique est un levier, pas un luxe.
                </h2>

                <p class="text-muted propos-safe-text" style="font-size:.95rem; line-height:1.8;">
                    Yokkuté Labs est une agence de transformation numérique fondée par des praticiens passionnés par le potentiel des entreprises africaines. Notre nom reflète notre philosophie : <strong class="text-dark">Yokkuté</strong>, qui évoque l'effort, l'élan et la progression  —  parce que la transformation réelle se construit, elle ne s'achète pas.
                </p>
                <p class="text-muted propos-safe-text" style="font-size:.95rem; line-height:1.8;">
                    Nous ne sommes pas une ESN qui vend des licences. Nous sommes des partenaires de terrain qui retroussent leurs manches à vos côtés  —  de la stratégie à l'exécution, du diagnostic à la formation de vos équipes.
                </p>

                {{-- Stat pills --}}
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <div class="stat-pill green-pill">
                        <span class="pill-num">7</span>
                        <span class="pill-label">Expertises</span>
                    </div>
                    <div class="stat-pill green-pill">
                        <span class="pill-num">100%</span>
                        <span class="pill-label">Sur-mesure</span>
                    </div>
                    <div class="stat-pill green-pill">
                        <span class="pill-num">0</span>
                        <span class="pill-label">Jargon inutile</span>
                    </div>
                </div>
            </div>

            {{-- Colonne image --}}
            <div class="col-lg-6 reveal">
                <div style="position:relative;">

                    {{-- Bloc décoratif derrière --}}
                    <div style="
                        position:absolute;
                        top: -20px;
                        right: -20px;
                        width: 100%;
                        height: 100%;
                        border-radius: 20px;
                        background: linear-gradient(135deg, #1a7a4a 0%, #1a7a4a 100%);
                        opacity: .15;
                        z-index: 0;
                    "></div>

                    {{-- Image principale --}}
                    <img
                        src="{{ asset('images/quisommesnous.jpg') }}"
                        alt="L'équipe Yokkuté Labs"
                        style="
                            position: relative;
                            z-index: 1;
                            width: 100%;
                            border-radius: 16px;
                            object-fit: cover;
                            max-height: 460px;
                            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
                        " />                    
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- """ STRIP CTA """ --}}
<section style="background:#1a7a4a; padding:3.5rem 0; text-align:center;">
    <div class="container" style="max-width:640px;">
        <h2 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif;">Vous vous reconnaissez dans ce que nous décrivons ?</h2>
        <p style="color:rgba(255,255,255,.75); margin-bottom:1.75rem;">Parlons-nous. Un échange de 30 minutes suffit souvent à clarifier ce dont vous avez besoin.</p>
        <a href="{{ route('contact') }}" class="btn-green">Prendre contact  </a>
    </div>
</section>

{{-- """ VISION & MISSION """ --}}
<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-6 reveal">
                <div class="vm-card propos-safe-text">
                    <div class="vm-icon" style="background:rgba(26,122,74,.12); color:#1a7a4a;">
                        <i class="bi bi-eye"></i>
                    </div>
                    <p class="section-tag-about">Notre vision</p>
                    <h3 class="fw-bold mb-3" style="font-family:'Sora',sans-serif;">Un continent où chaque entreprise maîtrise ses outils numériques.</h3>
                    <p class="text-muted">Nous croyons que la transformation numérique ne devrait pas être le privilège des grandes entreprises. Elle doit être accessible et utile pour tout entrepreneur qui veut bâtir quelque chose de durable.</p>
                    <p class="text-muted mb-0"><strong class="text-dark">Notre vision :</strong> devenir la référence de l'accompagnement numérique pour les entreprises africaines  —  en plaçant la pédagogie, l'éthique et l'impact local au coeur de tout.</p>
                </div>
            </div>

            <div class="col-md-6 reveal" style="transition-delay:.1s;">
                <div class="vm-card propos-safe-text">
                    <div class="vm-icon" style="background:rgba(26,122,74,.12); color:#1a7a4a;">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <p class="section-tag-about">Notre mission</p>
                    <h3 class="fw-bold mb-3" style="font-family:'Sora',sans-serif;">Traduire la technologie en avantage concret pour votre entreprise.</h3>
                    <p class="text-muted">Rendre le numérique vraiment utile. Pas impressionnant sur le papier. <strong class="text-dark">Utile  —  dans vos processus, dans votre équipe, dans vos résultats.</strong></p>
                    <p class="text-muted mb-0">Du premier diagnostic jusqu'à l'intégration de l'IA, en passant par la formation de vos équipes et la mise en place de tableaux de bord décisionnels.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- """ POURQUOI NOUS """ --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-about" style="justify-content:center;">Pourquoi travailler avec nous ?</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">Parce que vous méritez un partenaire<br>qui comprend votre contexte.</h2>
        </div>

        <div class="row g-3">

            <div class="col-md-6 reveal">
                <div class="perk-card propos-safe-text">
                    <div class="perk-ic green-ic"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <h6>Expertise locale, standards internationaux</h6>
                        <p>On connaît les réalités du marché africain  —  contraintes de connectivité, enjeux budgétaires, dynamiques d'équipe  —  avec des méthodes éprouvées mondialement.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 reveal" style="transition-delay:.05s;">
                <div class="perk-card propos-safe-text">
                    <div class="perk-ic green-ic"><i class="bi bi-sliders"></i></div>
                    <div>
                        <h6>Approche sur-mesure, pas de template</h6>
                        <p>Chaque entreprise est différente. Nous construisons la réponse adaptée à votre situation, vos ressources et vos objectifs  —  pas une formule toute faite.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 reveal" style="transition-delay:.1s;">
                <div class="perk-card propos-safe-text">
                    <div class="perk-ic green-ic"><i class="bi bi-person-check-fill"></i></div>
                    <div>
                        <h6>Un interlocuteur unique tout au long du projet</h6>
                        <p>Pas de ping-pong entre les équipes. Un référent dédié qui connaît votre dossier, répond vite et reste là du début à la fin.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 reveal" style="transition-delay:.15s;">
                <div class="perk-card propos-safe-text">
                    <div class="perk-ic green-ic"><i class="bi bi-eye-fill"></i></div>
                    <div>
                        <h6>Transparence et pédagogie à chaque étape</h6>
                        <p>On vous explique ce qu'on fait et pourquoi. L'objectif n'est pas de vous rendre dépendant, mais de vous rendre autonome.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 reveal" style="transition-delay:.2s;">
                <div class="perk-card propos-safe-text">
                    <div class="perk-ic green-ic"><i class="bi bi-graph-up-arrow"></i></div>
                    <div>
                        <h6>Engagement sur les résultats, pas les livrables</h6>
                        <p>Un beau rapport ne fait pas progresser une entreprise. On mesure l'impact réel avec vous et on s'adapte si besoin.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 reveal" style="transition-delay:.25s;">
                <div class="perk-card propos-safe-text">
                    <div class="perk-ic green-ic"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <h6>Réactivité garantie sous 24h</h6>
                        <p>Toujours un humain qui lit votre message et revient vers vous rapidement  —  pas de réponse automatique qui ne dit rien.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- """ 0QUIPE """ --}}
<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="text-center mb-5 reveal propos-safe-text">
            <p class="section-tag-about" style="justify-content:center;">Notre équipe</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">Des profils complémentaires,<br>une même obsession : votre impact.</h2>
            <p class="text-muted mt-2 mx-auto" style="max-width:560px;">Stratèges, développeurs, data analysts, formateurs, experts marketing  —  unis par la conviction que la technologie doit servir les gens, pas l'inverse.</p>
        </div>

        @if($teamMembers->isNotEmpty())
            <div class="team-showcase-wrap">
                <button class="team-nav-btn" type="button" data-dir="prev" aria-label="Profil precedent">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="team-showcase" id="teamShowcase">
                    @foreach($teamMembers as $member)
                        <article class="team-photo-card reveal">
                            <img src="{{ asset($member->image_path) }}" alt="{{ $member->name }}" class="team-photo">
                            <div class="team-photo-meta">
                                <div class="team-photo-text">
                                    <h5>{{ $member->name }}</h5>
                                    <p>{{ $member->role }}</p>
                                </div>
                                <a href="{{ $member->linkedin_url ?: '#' }}" target="_blank" rel="noopener noreferrer" class="team-li-btn" aria-label="Profil LinkedIn de {{ $member->name }}">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <button class="team-nav-btn" type="button" data-dir="next" aria-label="Profil suivant">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        @else
            <div class="alert alert-light border text-center">
                Les profils de l'equipe seront bientot disponibles.
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    const showcase = document.getElementById('teamShowcase');
    const nextBtn = document.querySelector('[data-dir="next"]');
    const prevBtn = document.querySelector('[data-dir="prev"]');

    if (showcase && nextBtn && prevBtn) {
        const getScrollStep = () => {
            const card = showcase.querySelector('.team-photo-card');
            const gap = parseInt(window.getComputedStyle(showcase).gap);
            return card.offsetWidth + gap;
        };

        nextBtn.addEventListener('click', () => {
            const step = getScrollStep();
            if (showcase.scrollLeft + showcase.clientWidth >= showcase.scrollWidth - 10) {
                showcase.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                showcase.scrollBy({ left: step, behavior: 'smooth' });
            }
        });

        prevBtn.addEventListener('click', () => {
            const step = getScrollStep();
            if (showcase.scrollLeft <= 10) {
                showcase.scrollTo({ left: showcase.scrollWidth, behavior: 'smooth' });
            } else {
                showcase.scrollBy({ left: -step, behavior: 'smooth' });
            }
        });
    }
</script>
@endpush

{{-- """ CTA FINAL """ --}}
<section style="background:#0d1a12; padding:4rem 0; text-align:center;">
    <div class="container" style="max-width:600px;">
        <h2 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif;">Envie de travailler avec nous ?</h2>
        <p style="color:#9ca3af; margin-bottom:1.75rem;">On commence toujours par un audit gratuit pour bien comprendre votre situation avant de vous proposer quoi que ce soit.</p>
        <a href="{{ route('contact') }}" class="btn-green">Demander mon audit gratuit  </a>
    </div>
</section>

@endsection

