@extends('layouts.app')
@section('title', 'À propos — Yokkuté Labs')
@section('content')

{{-- ═══ HEADER ═══ --}}
<section style="background:#1a1a2e; padding:4rem 0;">
    <div class="container">
        <p class="mb-2" style="font-size:.75rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#3ecf72;">À propos</p>
        <h1 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif; font-size:clamp(2rem,5vw,3rem);">Yokkuté Labs.</h1>
        <p style="color:#9ca3af; font-size:.95rem; margin:0;">Qui nous sommes, ce en quoi nous croyons, et pourquoi ça compte pour vous.</p>
    </div>
</section>

{{-- ═══ QUI SOMMES-NOUS ═══ --}}
<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <p class="section-tag-about">Qui sommes-nous ?</p>
                <h2 class="fw-bold mb-3" style="font-family:'Sora',sans-serif;">Une équipe née de la conviction que le numérique est un levier, pas un luxe.</h2>
                {{-- Stat pills --}}
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <div class="stat-pill green-pill">
                        <span class="pill-num">7</span>
                        <span class="pill-label">Expertises</span>
                    </div>
                    <div class="stat-pill blue-pill">
                        <span class="pill-num">100%</span>
                        <span class="pill-label">Sur-mesure</span>
                    </div>
                    <div class="stat-pill green-pill">
                        <span class="pill-num">0</span>
                        <span class="pill-label">Jargon inutile</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <p class="text-muted">Yokkuté Labs est une agence de transformation numérique fondée par des praticiens passionnés par le potentiel des entreprises africaines. Notre nom reflète notre philosophie : <strong class="text-dark">Yokkuté</strong>, qui évoque l'effort, l'élan et la progression — parce que la transformation réelle se construit, elle ne s'achète pas.</p>
                <p class="text-muted">Nous ne sommes pas une SSII qui vend des licences logicielles. Nous sommes des partenaires de terrain qui retroussent leurs manches à vos côtés — de la stratégie à l'exécution, du diagnostic à la formation de vos équipes.</p>
                <p class="text-muted mb-0">Notre terrain de jeu : les PME, startups et structures qui veulent grandir intelligemment, sans se perdre dans des projets tech hors-sol.</p>
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
                    <div class="vm-icon" style="background:rgba(26,155,220,.12); color:#1a9bdc;">
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
                    <div class="perk-ic blue-ic"><i class="bi bi-sliders"></i></div>
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
                    <div class="perk-ic blue-ic"><i class="bi bi-eye-fill"></i></div>
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
                    <div class="perk-ic blue-ic"><i class="bi bi-clock-history"></i></div>
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

            <div class="col-sm-6 col-lg-3">
                <div class="team-card-about">
                    <div class="team-av green-av">YL</div>
                    <div class="team-role-ab">Fondateur & CEO</div>
                    <div class="team-name-ab">[Prénom Nom]</div>
                    <p>Stratège numérique avec plus de X ans d'expérience dans l'accompagnement de startups et PME en Afrique de l'Ouest.</p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="team-card-about">
                    <div class="team-av blue-av">DA</div>
                    <div class="team-role-ab">Directeur Technique</div>
                    <div class="team-name-ab">[Prénom Nom]</div>
                    <p>Architecte de systèmes et spécialiste des intégrations numériques. Transforme les besoins métier en solutions robustes.</p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="team-card-about">
                    <div class="team-av green-av">KN</div>
                    <div class="team-role-ab">Experte Data & BI</div>
                    <div class="team-name-ab">[Prénom Nom]</div>
                    <p>Spécialiste en analyse de données et tableaux de bord décisionnels pour de meilleures décisions.</p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="team-card-about">
                    <div class="team-av blue-av">AB</div>
                    <div class="team-role-ab">Responsable Formation</div>
                    <div class="team-name-ab">[Prénom Nom]</div>
                    <p>Pédagogue et formateur certifié. Il rend le numérique accessible à tous les profils.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══ CTA FINAL ═══ --}}
<section style="background:#1a1a2e; padding:4rem 0; text-align:center;">
    <div class="container" style="max-width:600px;">
        <h2 class="fw-bold mb-2" style="color:white; font-family:'Sora',sans-serif;">Envie de travailler avec nous ?</h2>
        <p style="color:#9ca3af; margin-bottom:1.75rem;">On commence toujours par un audit gratuit pour bien comprendre votre situation avant de vous proposer quoi que ce soit.</p>
        <a href="{{ route('contact') }}" class="btn-green">Demander mon audit gratuit →</a>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ── Boutons ── */
    .btn-green         { background:#3ecf72; color:#fff; border:none; font-weight:600; font-size:.875rem; padding:.7rem 1.5rem; display:inline-block; transition:background .2s; border-radius:4px; }
    .btn-green:hover   { background:#2db85e; color:#fff; }

    /* ── Section tag ── */
    .section-tag-about {
        display: inline-flex; align-items: center; gap: .5rem;
        font-size: .72rem; font-weight: 700; letter-spacing: .12em;
        text-transform: uppercase; color: #3ecf72; margin-bottom: .75rem;
    }
    .section-tag-about::before {
        content: ''; display: inline-block;
        width: 18px; height: 2px; background: #3ecf72;
    }

    /* ── Stat pills ── */
    .stat-pill {
        display: flex; flex-direction: column; align-items: center;
        padding: .75rem 1.25rem; border-radius: 8px;
    }
    .green-pill { background: rgba(62,207,114,.1); }
    .blue-pill  { background: rgba(26,155,220,.1); }
    .pill-num   { font-family:'Sora',sans-serif; font-size: 1.5rem; font-weight: 800; }
    .green-pill .pill-num { color: #3ecf72; }
    .blue-pill  .pill-num { color: #1a9bdc; }
    .pill-label { font-size: .72rem; color: #6b7280; }

    /* ── Vision / Mission cards ── */
    .vm-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 2rem; height: 100%; }
    .vm-icon { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.25rem; }

    /* ── Perk cards ── */
    .perk-card {
        display: flex; gap: 1rem; align-items: flex-start;
        background: #fff; border: 1px solid #e5e7eb;
        border-radius: 8px; padding: 1.25rem 1.5rem; height: 100%;
    }
    .perk-ic {
        width: 42px; height: 42px; min-width: 42px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .green-ic { background: rgba(62,207,114,.12); color: #3ecf72; }
    .blue-ic  { background: rgba(26,155,220,.12);  color: #1a9bdc; }
    .perk-card h6 { font-family:'Sora',sans-serif; font-size:.9rem; font-weight:700; margin-bottom:.3rem; color:#1a1a2e; }
    .perk-card p  { font-size:.82rem; color:#6b7280; margin:0; line-height:1.6; }

    /* ── Team ── */
    .team-card-about {
        background: #fff; border: 1px solid #e5e7eb;
        border-radius: 8px; padding: 1.75rem 1.5rem;
        text-align: center; height: 100%;
    }
    .team-av {
        width: 60px; height: 60px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-family:'Sora',sans-serif; font-size:1rem; font-weight:800;
        color: #fff; margin: 0 auto 1rem;
    }
    .green-av { background: #3ecf72; }
    .blue-av  { background: #1a9bdc; }
    .team-role-ab { font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:#3ecf72; margin-bottom:.25rem; }
    .team-name-ab { font-family:'Sora',sans-serif; font-size:.95rem; font-weight:700; margin-bottom:.5rem; color:#1a1a2e; }
    .team-card-about p { font-size:.8rem; color:#6b7280; margin:0; }
</style>
@endpush