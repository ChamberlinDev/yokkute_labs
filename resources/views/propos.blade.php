@extends('layouts.app')
@section('title', 'À propos — Yokkuté Labs')
@section('content')


<link href="{{ asset('css/propos.css') }}" rel="stylesheet">

{{-- ═══ HEADER ═══ --}}
<section style="
    background: url('{{ asset('images/apropos.jpg') }}') center/cover no-repeat;
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
        <p class="mb-2" style="font-size:.75rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#3ecf72;">À propos</p>
        <h1 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif; font-size:clamp(2rem,5vw,3rem);">Yokkuté Labs.</h1>
        <p style="color:#9ca3af; font-size:.95rem; margin:0;">Qui nous sommes, ce en quoi nous croyons, et pourquoi ça compte pour vous.</p>
    </div>
</section>

{{-- ═══ QUI SOMMES-NOUS ═══ --}}
<section class="py-5 overflow-hidden">
    <div class="container">
        <div class="row g-5 align-items-center">

            {{-- Colonne texte --}}
            <div class="col-lg-6">
                <p class="section-tag-about">Qui sommes-nous ?</p>
                <h2 class="fw-bold mb-3" style="font-family:'Sora',sans-serif; font-size:clamp(1.6rem,3.5vw,2.2rem); line-height:1.3;">
                    Une équipe née de la conviction que le numérique est un levier, pas un luxe.
                </h2>

                <p class="text-muted" style="font-size:.95rem; line-height:1.8;">
                    Yokkuté Labs est une agence de transformation numérique fondée par des praticiens passionnés par le potentiel des entreprises africaines. Notre nom reflète notre philosophie : <strong class="text-dark">Yokkuté</strong>, qui évoque l'effort, l'élan et la progression — parce que la transformation réelle se construit, elle ne s'achète pas.
                </p>
                <p class="text-muted" style="font-size:.95rem; line-height:1.8;">
                    Nous ne sommes pas une ESN qui vend des licences. Nous sommes des partenaires de terrain qui retroussent leurs manches à vos côtés — de la stratégie à l'exécution, du diagnostic à la formation de vos équipes.
                </p>

                {{-- Stat pills --}}
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <div class="stat-pill blue-pill">
                        <span class="pill-num">7</span>
                        <span class="pill-label">Expertises</span>
                    </div>
                    <div class="stat-pill blue-pill">
                        <span class="pill-num">100%</span>
                        <span class="pill-label">Sur-mesure</span>
                    </div>
                    <div class="stat-pill blue-pill">
                        <span class="pill-num">0</span>
                        <span class="pill-label">Jargon inutile</span>
                    </div>
                </div>
            </div>

            {{-- Colonne image --}}
            <div class="col-lg-6">
                <div style="position:relative;">

                    {{-- Bloc décoratif derrière --}}
                    <div style="
                        position:absolute;
                        top: -20px;
                        right: -20px;
                        width: 100%;
                        height: 100%;
                        border-radius: 20px;
                        background: linear-gradient(135deg, #3ecf72 0%, #3b82f6 100%);
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

{{-- ═══ STRIP CTA ═══ --}}
<section style="background:#1a9bdc; padding:3.5rem 0; text-align:center;">
    <div class="container" style="max-width:640px;">
        <h2 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif;">Vous vous reconnaissez dans ce que nous décrivons ?</h2>
        <p style="color:rgba(255,255,255,.75); margin-bottom:1.75rem;">Parlons-nous. Un échange de 30 minutes suffit souvent à clarifier ce dont vous avez besoin.</p>
        <a href="{{ route('contact') }}" class="btn-green">Prendre contact →</a>
    </div>
</section>

{{-- ═══ VISION & MISSION ═══ --}}
<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="vm-card">
                    <div class="vm-icon" style="background:rgba(62,207,114,.12); color:#3ecf72;">
                        <i class="bi bi-eye"></i>
                    </div>
                    <p class="section-tag-about">Notre vision</p>
                    <h3 class="fw-bold mb-3" style="font-family:'Sora',sans-serif;">Un continent où chaque entreprise maîtrise ses outils numériques.</h3>
                    <p class="text-muted">Nous croyons que la transformation numérique ne devrait pas être le privilège des grandes entreprises. Elle doit être accessible et utile pour tout entrepreneur qui veut bâtir quelque chose de durable.</p>
                    <p class="text-muted mb-0"><strong class="text-dark">Notre vision :</strong> devenir la référence de l'accompagnement numérique pour les entreprises africaines — en plaçant la pédagogie, l'éthique et l'impact local au cœur de tout.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="vm-card">
                    <div class="vm-icon" style="background:rgba(62,207,114,.12); color:#3ecf72;">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <p class="section-tag-about">Notre mission</p>
                    <h3 class="fw-bold mb-3" style="font-family:'Sora',sans-serif;">Traduire la technologie en avantage concret pour votre entreprise.</h3>
                    <p class="text-muted">Rendre le numérique vraiment utile. Pas impressionnant sur le papier. <strong class="text-dark">Utile — dans vos processus, dans votre équipe, dans vos résultats.</strong></p>
                    <p class="text-muted mb-0">Du premier diagnostic jusqu'à l'intégration de l'IA, en passant par la formation de vos équipes et la mise en place de tableaux de bord décisionnels.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══ POURQUOI NOUS ═══ --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-about" style="justify-content:center;">Pourquoi travailler avec nous ?</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">Parce que vous méritez un partenaire<br>qui comprend votre contexte.</h2>
        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <div class="perk-card">
                    <div class="perk-ic green-ic"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <h6>Expertise locale, standards internationaux</h6>
                        <p>On connaît les réalités du marché africain — contraintes de connectivité, enjeux budgétaires, dynamiques d'équipe — avec des méthodes éprouvées mondialement.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perk-card">
                    <div class="perk-ic green-ic"><i class="bi bi-sliders"></i></div>
                    <div>
                        <h6>Approche sur-mesure, pas de template</h6>
                        <p>Chaque entreprise est différente. Nous construisons la réponse adaptée à votre situation, vos ressources et vos objectifs — pas une formule toute faite.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perk-card">
                    <div class="perk-ic green-ic"><i class="bi bi-person-check-fill"></i></div>
                    <div>
                        <h6>Un interlocuteur unique tout au long du projet</h6>
                        <p>Pas de ping-pong entre les équipes. Un référent dédié qui connaît votre dossier, répond vite et reste là du début à la fin.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perk-card">
                    <div class="perk-ic green-ic"><i class="bi bi-eye-fill"></i></div>
                    <div>
                        <h6>Transparence et pédagogie à chaque étape</h6>
                        <p>On vous explique ce qu'on fait et pourquoi. L'objectif n'est pas de vous rendre dépendant, mais de vous rendre autonome.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perk-card">
                    <div class="perk-ic green-ic"><i class="bi bi-graph-up-arrow"></i></div>
                    <div>
                        <h6>Engagement sur les résultats, pas les livrables</h6>
                        <p>Un beau rapport ne fait pas progresser une entreprise. On mesure l'impact réel avec vous et on s'adapte si besoin.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perk-card">
                    <div class="perk-ic green-ic"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <h6>Réactivité garantie sous 24h</h6>
                        <p>Toujours un humain qui lit votre message et revient vers vous rapidement — pas de réponse automatique qui ne dit rien.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══ ÉQUIPE ═══ --}}
<section class="py-5" style="background:#f5f7fa;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag-about" style="justify-content:center;">Notre équipe</p>
            <h2 class="fw-bold" style="font-family:'Sora',sans-serif;">Des profils complémentaires,<br>une même obsession : votre impact.</h2>
            <p class="text-muted mt-2 mx-auto" style="max-width:560px;">Stratèges, développeurs, data analysts, formateurs, experts marketing — unis par la conviction que la technologie doit servir les gens, pas l'inverse.</p>
        </div>

        <div class="row g-4 justify-content-center">

            <!-- Card 1 -->
            <div class="col-sm-6 col-lg-3">
                <div style="background:#fff; border-radius:16px; padding:2rem 1.5rem; box-shadow:0 4px 24px rgba(0,0,0,0.07); display:flex; flex-direction:column; align-items:center; text-align:center; height:100%; transition:transform .2s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="team-av green-av" style="width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem; margin-bottom:1rem;">YL</div>
                    <span style="font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#3ecf72; margin-bottom:.3rem; display:block;">Fondateur & CEO</span>
                    <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif; font-size:1rem;">[Prénom Nom]</h5><br><br><br><br><br>
                    <a href="https://linkedin.com/in/votre-profil" target="_blank" style="display:inline-flex; align-items:center; gap:.4rem; text-decoration:none; background:#0077b5; color:#fff; font-size:.8rem; font-weight:600; padding:.45rem 1rem; border-radius:8px; transition:opacity .2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.268c-.966 0-1.75-.784-1.75-1.75s.784-1.75 1.75-1.75 1.75.784 1.75 1.75-.784 1.75-1.75 1.75zm13.5 11.268h-3v-5.604c0-1.337-.025-3.061-1.865-3.061-1.866 0-2.152 1.459-2.152 2.967v5.698h-3v-10h2.881v1.367h.041c.401-.761 1.381-1.563 2.844-1.563 3.042 0 3.604 2.003 3.604 4.608v5.588z" />
                        </svg>
                        Voir le profil
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-sm-6 col-lg-3">
                <div style="background:#fff; border-radius:16px; padding:2rem 1.5rem; box-shadow:0 4px 24px rgba(0,0,0,0.07); display:flex; flex-direction:column; align-items:center; text-align:center; height:100%; transition:transform .2s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="team-av blue-av" style="width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem; margin-bottom:1rem;">DA</div>
                    <span style="font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#3b82f6; margin-bottom:.3rem; display:block;">Directeur Technique</span>
                    <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif; font-size:1rem;">[Prénom Nom]</h5><br><br><br><br><br>
                    <a href="https://linkedin.com/in/votre-profil" target="_blank" style="display:inline-flex; align-items:center; gap:.4rem; text-decoration:none; background:#0077b5; color:#fff; font-size:.8rem; font-weight:600; padding:.45rem 1rem; border-radius:8px; transition:opacity .2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.268c-.966 0-1.75-.784-1.75-1.75s.784-1.75 1.75-1.75 1.75.784 1.75 1.75-.784 1.75-1.75 1.75zm13.5 11.268h-3v-5.604c0-1.337-.025-3.061-1.865-3.061-1.866 0-2.152 1.459-2.152 2.967v5.698h-3v-10h2.881v1.367h.041c.401-.761 1.381-1.563 2.844-1.563 3.042 0 3.604 2.003 3.604 4.608v5.588z" />
                        </svg>
                        Voir le profil
                    </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-sm-6 col-lg-3">
                <div style="background:#fff; border-radius:16px; padding:2rem 1.5rem; box-shadow:0 4px 24px rgba(0,0,0,0.07); display:flex; flex-direction:column; align-items:center; text-align:center; height:100%; transition:transform .2s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="team-av green-av" style="width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem; margin-bottom:1rem;">KN</div>
                    <span style="font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#3ecf72; margin-bottom:.3rem; display:block;">Experte Data & BI</span>
                    <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif; font-size:1rem;">[Prénom Nom]</h5><br><br><br><br><br>
                    <a href="https://linkedin.com/in/votre-profil" target="_blank" style="display:inline-flex; align-items:center; gap:.4rem; text-decoration:none; background:#0077b5; color:#fff; font-size:.8rem; font-weight:600; padding:.45rem 1rem; border-radius:8px; transition:opacity .2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.268c-.966 0-1.75-.784-1.75-1.75s.784-1.75 1.75-1.75 1.75.784 1.75 1.75-.784 1.75-1.75 1.75zm13.5 11.268h-3v-5.604c0-1.337-.025-3.061-1.865-3.061-1.866 0-2.152 1.459-2.152 2.967v5.698h-3v-10h2.881v1.367h.041c.401-.761 1.381-1.563 2.844-1.563 3.042 0 3.604 2.003 3.604 4.608v5.588z" />
                        </svg>
                        Voir le profil
                    </a>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-sm-6 col-lg-3">
                <div style="background:#fff; border-radius:16px; padding:2rem 1.5rem; box-shadow:0 4px 24px rgba(0,0,0,0.07); display:flex; flex-direction:column; align-items:center; text-align:center; height:100%; transition:transform .2s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="team-av blue-av" style="width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem; margin-bottom:1rem;">AB</div>
                    <span style="font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#3b82f6; margin-bottom:.3rem; display:block;">Responsable Formation</span>
                    <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif; font-size:1rem;">[Prénom Nom]</h5><br><br><br><br><br>
                    <a href="https://linkedin.com/in/votre-profil" target="_blank" style="display:inline-flex; align-items:center; gap:.4rem; text-decoration:none; background:#0077b5; color:#fff; font-size:.8rem; font-weight:600; padding:.45rem 1rem; border-radius:8px; transition:opacity .2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.268c-.966 0-1.75-.784-1.75-1.75s.784-1.75 1.75-1.75 1.75.784 1.75 1.75-.784 1.75-1.75 1.75zm13.5 11.268h-3v-5.604c0-1.337-.025-3.061-1.865-3.061-1.866 0-2.152 1.459-2.152 2.967v5.698h-3v-10h2.881v1.367h.041c.401-.761 1.381-1.563 2.844-1.563 3.042 0 3.604 2.003 3.604 4.608v5.588z" />
                        </svg>
                        Voir le profil
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══ CTA FINAL ═══ --}}
<section style="background:#6b7280; padding:4rem 0; text-align:center;">
    <div class="container" style="max-width:600px;">
        <h2 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif;">Envie de travailler avec nous ?</h2>
        <p style="color:#9ca3af; margin-bottom:1.75rem;">On commence toujours par un audit gratuit pour bien comprendre votre situation avant de vous proposer quoi que ce soit.</p>
        <a href="{{ route('contact') }}" class="btn-green">Demander mon audit gratuit →</a>
    </div>
</section>

@endsection
