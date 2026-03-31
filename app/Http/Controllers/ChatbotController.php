<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function message(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1200'],
            'history' => ['nullable', 'array', 'max:12'],
            'history.*.role' => ['required_with:history', 'in:user,assistant'],
            'history.*.content' => ['required_with:history', 'string', 'max:900'],
        ]);

        $userMessage = trim($validated['message']);
        $history = collect($validated['history'] ?? [])
            ->map(fn (array $item): array => [
                'role' => $item['role'],
                'content' => trim((string) $item['content']),
            ])
            ->filter(fn (array $item): bool => $item['content'] !== '')
            ->take(-8)
            ->values()
            ->all();

        $reply = $this->getLocalReply($userMessage, $history);

        return response()->json([
            'reply' => $reply,
            'source' => 'site_knowledge',
        ]);
    }


    private function getLocalReply(string $userMessage, array $history): string
    {
        $text = $this->normalize($userMessage);
        $settings = SiteSetting::asArray();
        $contactEmail = $settings['contact_email'] ?? 'solution@yokkutelabs.com';
        $contactPhone = $settings['contact_phone'] ?? '+221 771488937';
        $contactAddress = $settings['contact_address'] ?? 'Dakar, Senegal';
        $rhEmail = $settings['rh_email'] ?? 'solution@yokkutelabs.com';
        $services = Service::query()
            ->where('is_published', true)
            ->orderBy('order_column')
            ->get(['title', 'badge', 'description', 'audience', 'deliverables']);
        $team = TeamMember::query()
            ->where('is_active', true)
            ->orderBy('order_column')
            ->get(['name', 'role', 'linkedin_url']);
        $teamCount = $team->count();
        $knowledgeEntries = $this->buildKnowledgeBase($settings, $services->all(), $team->all());
        $language = $this->resolveConversationLanguage($userMessage, $history);

        if ($language !== 'fr') {
            return $this->getMultilingualReply(
                $language,
                $userMessage,
                $text,
                $contactEmail,
                $contactPhone,
                $contactAddress,
                $rhEmail,
                $services->all(),
                $team->all(),
                $teamCount
            );
        }

        if (preg_match('/bonjour|salut|hello|bonsoir/', $text)) {
            return "Bonjour. Je peux vous aider a clarifier votre besoin, identifier le bon service et definir la prochaine etape la plus utile. Quel resultat cherchez-vous a obtenir en priorite ?";
        }

        $matchedTeamMember = $this->bestTeamMemberMatch($text, $team->all());
        if ($matchedTeamMember !== null && preg_match('/qui est|qui c est|parle moi de|profil de|membre|linkedin/', $text)) {
            return $this->formatTeamMemberReplyFr($matchedTeamMember);
        }

        if (preg_match('/rejoindre|recrut|emploi|poste|carriere|candidature|cv/', $text)) {
            return "Vous pouvez candidater directement via /rejoindre. Le formulaire demande surtout: prenom, nom, email, domaine, experience et message. Le CV est optionnel, en PDF, avec une limite de 30 Mo. " .
                "Domaines principaux: developpement, data/BI, conseil, gestion de projet, formation, commercial, marketing ou profil transversal. Contact RH: {$rhEmail}.";
        }

        if (preg_match('/delai|delais|temps|combien de temps|livraison/', $text)) {
            return "Le delai depend du perimetre et du niveau de complexite. A titre indicatif, un site vitrine peut etre livre en 2 a 4 semaines, tandis qu'une application metier ou un projet de transformation plus large peut demander plusieurs mois. Nous fixons un planning clair des la phase de cadrage pour donner de la visibilite des le depart.";
        }

        if (preg_match('/rgpd|donnees personnelles|donnees|confidentialite|vie privee/', $text)) {
            return "La protection des donnees est une priorite. Vous pouvez consulter /rgpd pour le detail complet: donnees collectees, finalites, durees de conservation, mesures de securite et droits d'acces, rectification ou suppression. Si vous voulez, je peux aussi vous en faire un resume rapide et clair.";
        }

        if (preg_match('/orient|hesite|je ne sais pas|pas sur|quel service|quoi choisir/', $text)) {
            return "Si votre besoin n'est pas encore parfaitement defini, le plus simple est de passer par /contact pour un echange exploratoire. Nous vous repondons sous 24h ouvrrees pour vous orienter vers l'audit, le conseil, l'integration numerique, l'IA, la formation ou la data/BI selon votre contexte et votre priorite business.";
        }

        if (preg_match('/qui sommes|a propos|propos|membre|membres|notre equipe|agent|agents|linkedin/', $text)) {
            $roles = $team->pluck('role')->filter()->unique()->take(3)->implode(', ');

            $profiles = $team
                ->filter(fn ($member): bool => trim((string) ($member->name ?? '')) !== '' && trim((string) ($member->role ?? '')) !== '')
                ->take(3)
                ->map(function ($member): string {
                    $name = trim((string) $member->name);
                    $role = trim((string) $member->role);
                    $linkedin = trim((string) ($member->linkedin_url ?? ''));

                    if ($linkedin !== '' && $linkedin !== '#') {
                        return "- {$name} ({$role}) - LinkedIn: {$linkedin}";
                    }

                    return "- {$name} ({$role})";
                })
                ->implode("\n");

            if ($roles !== '') {
                $base = "Notre equipe active compte actuellement {$teamCount} profil(s), avec notamment des expertises en {$roles}. Vous pouvez decouvrir les profils et l'approche de Yokkute Labs ici: /a-propos";

                if ($profiles !== '') {
                    return $base . "\n\nExemples de profils:\n" . $profiles;
                }

                return $base;
            }

            return "Notre equipe active compte actuellement {$teamCount} profil(s). Vous pouvez decouvrir l'equipe et notre approche ici: /a-propos";
        }

        if (preg_match('/service|prestation|offre|faites|proposez/', $text)) {
            $titles = $services->pluck('title')->all();
            if (empty($titles)) {
                return "Nos services sont en cours de mise a jour. Le plus simple est de nous decrire votre besoin via /contact et nous vous orienterons rapidement vers la meilleure option.";
            }

            return "Voici nos services actuellement disponibles: " . implode(', ', $titles) . ". Si vous me donnez votre secteur, votre enjeu principal ou votre objectif, je peux vous recommander le point de depart le plus pertinent.";
        }

        if (preg_match('/audit|diagnostic|commencer|debut/', $text)) {
            return "Dans la plupart des cas, le meilleur point de depart est un audit numerique. Nous identifions les blocages, priorisons les actions et construisons une feuille de route exploitable sur 90 jours. " .
                "Prochaine etape: faites votre demande via /contact en resumant votre contexte actuel en 4 ou 5 lignes.";
        }

        $matchedService = $this->bestServiceMatch($text, $services->all());

        if ($matchedService !== null) {
            $shortDesc = Str::of((string) ($matchedService->description ?? ''))
                ->squish()
                ->limit(180, '...');

            $deliverables = collect($matchedService->deliverables ?? [])
                ->filter(fn (mixed $deliverable): bool => is_string($deliverable) && trim($deliverable) !== '')
                ->take(3)
                ->implode(', ');

            $audience = trim((string) ($matchedService->audience ?? ''));

            $parts = ["Service recommande: {$matchedService->title}.", (string) $shortDesc];

            if ($audience !== '') {
                $parts[] = "Cible: {$audience}.";
            }

            if ($deliverables !== '') {
                $parts[] = "Livrables typiques: {$deliverables}.";
            }

            $parts[] = "Prochaine etape: consultez /services puis ecrivez-nous via /contact pour un cadrage rapide et pertinent.";

            return implode(' ', $parts);
        }

        $matchedKnowledge = $this->bestKnowledgeMatch($text, $knowledgeEntries);

        if ($matchedKnowledge !== null) {
            return $matchedKnowledge;
        }

        if (preg_match('/ia|intelligence artificielle|chatbot|automatisation|agent/', $text)) {
            return "Oui. Nous deployons des cas d'usage IA concrets: automatisation repetitive, chatbots metier, analyse documentaire et aide a la decision. " .
                "L'approche recommandee est generalement un pilote court, avec mesure de la valeur creee avant extension.";
        }

        if (preg_match('/prix|tarif|cout|devis|budget/', $text)) {
            return "Les couts dependent de votre maturite numerique, du perimetre et des integrations necessaires. " .
                "Pour obtenir un chiffrage fiable, passez par /contact: nous revenons rapidement avec un cadrage adapte a votre contexte.";
        }

        if (preg_match('/mail|email|contacter|contact|telephone|whatsapp|rdv|rendez/', $text)) {
            return "Vous pouvez nous joindre via /contact, par email a {$contactEmail}, ou par telephone au {$contactPhone}. " .
                "Si vous le souhaitez, je peux aussi vous aider a formuler un brief court et utile avant envoi.";
        }

        if (preg_match('/ou|adresse|ville|dakar|senegal/', $text)) {
            return "Nous sommes bases a {$contactAddress} et nous accompagnons aussi des clients a distance.";
        }

        if (preg_match('/merci/', $text)) {
            return "Avec plaisir. Si vous voulez avancer vite, je peux vous proposer un plan d'action simple en 3 etapes selon votre objectif.";
        }

        if (!empty($history)) {
            return "Je peux vous aider a transformer votre besoin en plan concret. Dites-moi simplement: 1) votre secteur, 2) votre principal blocage, 3) votre objectif sur 90 jours.";
        }

        return "Je peux vous aider sur l'audit numerique, l'integration IA, les services, le budget, le recrutement et le contact. Quel resultat voulez-vous obtenir en priorite ?";
    }

    private function detectLanguage(string $message): string
    {
        if (preg_match('/[\x{0600}-\x{06FF}]/u', $message)) {
            return 'ar';
        }

        $text = $this->normalize($message);

        // Prioritize clear French markers to avoid false English matches on shared words like "services".
        if (preg_match('/\b(bonjour|bonsoir|salut|merci|s il vous plait|svp|quel|quelle|quels|quelles|comment|pourquoi|qui est|vous|votre|vos|proposez|besoin|devis|rejoindre|candidature)\b/', $text)) {
            return 'fr';
        }

        if (preg_match('/\b(hola|buenos|servicios|contacto|equipo|precio|candidatura|trabajo|quienes|linkedin)\b/', $text)) {
            return 'es';
        }

        if (preg_match('/\b(ciao|servizi|contatto|squadra|prezzo|candidatura|lavoro|chi\s+siamo|linkedin)\b/', $text)) {
            return 'it';
        }

        if (preg_match('/\b(hello|hi|hey|thanks|thank you|please|team|price|pricing|career|apply|linkedin|what|how|can you|tell me|show me|need|help|more|about|your|do you|are you)\b|who\s+are\s+you|what\s+services|how\s+to\s+contact/', $text)) {
            return 'en';
        }

        return 'fr';
    }

    private function resolveConversationLanguage(string $userMessage, array $history): string
    {
        $current = $this->detectLanguage($userMessage);

        // 'de' and any other detected non-fr language are passed through as-is.
        // Unknown input defaults to 'fr'.
        return $current;
    }

    private function hasExplicitFrenchSignal(string $normalizedText): bool
    {
        return preg_match('/\b(bonjour|bonsoir|salut|merci|s il vous plait|svp|quel|quelle|quels|quelles|comment|pourquoi|qui est|vous|votre|vos|proposez|besoin|devis|rejoindre|candidature)\b/', $normalizedText) === 1;
    }

    private function getMultilingualReply(
        string $language,
        string $rawMessage,
        string $normalizedMessage,
        string $contactEmail,
        string $contactPhone,
        string $contactAddress,
        string $rhEmail,
        array $services,
        array $team,
        int $teamCount
    ): string {
        $servicesList = collect($services)
            ->pluck('title')
            ->filter(fn (mixed $title): bool => is_string($title) && trim($title) !== '')
            ->take(7)
            ->implode(', ');

        $teamExamples = collect($team)
            ->filter(fn ($member): bool => trim((string) ($member->name ?? '')) !== '' && trim((string) ($member->role ?? '')) !== '')
            ->take(3)
            ->map(function ($member): string {
                $name = trim((string) $member->name);
                $role = trim((string) $member->role);
                $linkedin = trim((string) ($member->linkedin_url ?? ''));

                if ($linkedin !== '' && $linkedin !== '#') {
                    return "{$name} ({$role}) - LinkedIn: {$linkedin}";
                }

                return "{$name} ({$role})";
            })
            ->implode(' ; ');

        $matchedTeamMember = $this->bestTeamMemberMatch($normalizedMessage, $team);

        if ($language === 'en') {
            if ($matchedTeamMember !== null && preg_match('/\b(who is|tell me about|profile|linkedin|member)\b/', $normalizedMessage)) {
                return $this->formatTeamMemberReplyEn($matchedTeamMember);
            }

            if (preg_match('/\b(hello|hi|hey|good morning|good evening)\b/', $normalizedMessage)) {
                return 'Hello, I am Edouard. I can help you choose the right service and next step. What result do you want to achieve first?';
            }
            if (preg_match('/\b(service|services|offer|offering|solution|solutions)\b/', $normalizedMessage)) {
                return $servicesList !== ''
                    ? "Our current services are: {$servicesList}. If you share your context, I can recommend the best starting point."
                    : 'Our services are being updated. Share your need and I will guide you to the right option.';
            }
            if (preg_match('/\b(contact|email|phone|whatsapp|reach|call)\b/', $normalizedMessage)) {
                return "You can contact us via /contact, by email at {$contactEmail}, or by phone/WhatsApp at {$contactPhone}. Address: {$contactAddress}.";
            }
            if (preg_match('/\b(team|member|members|agent|agents|linkedin|about|who are you)\b/', $normalizedMessage)) {
                return "Our active team currently has {$teamCount} profile(s)." . ($teamExamples !== '' ? " Examples: {$teamExamples}." : '') . ' More on /a-propos.';
            }
            if (preg_match('/\b(career|job|apply|recruit|cv|resume)\b/', $normalizedMessage)) {
                return "You can apply on /rejoindre. Main fields: first name, last name, email, domain, experience, message. CV is optional in PDF (max 30 MB). HR contact: {$rhEmail}.";
            }
            if (preg_match('/\b(price|cost|budget|quote|quotation)\b/', $normalizedMessage)) {
                return 'Pricing depends on scope and complexity. The fastest way is to send your context via /contact for a reliable estimate.';
            }

            return 'I can answer about services, team, contact details, recruitment, pricing, and data privacy. Ask me in English and I will help.';
        }

        if ($language === 'es') {
            if ($matchedTeamMember !== null && preg_match('/\b(quien es|hablame de|perfil|linkedin|miembro)\b/', $normalizedMessage)) {
                return $this->formatTeamMemberReplyEs($matchedTeamMember);
            }

            if (preg_match('/\b(hola|buenos dias|buenas tardes|buenas noches)\b/', $normalizedMessage)) {
                return 'Hola, soy Edouard. Puedo ayudarte a elegir el servicio adecuado y el siguiente paso. ?Cual es tu objetivo principal?';
            }
            if (preg_match('/\b(servicio|servicios|oferta|solucion|soluciones)\b/', $normalizedMessage)) {
                return $servicesList !== ''
                    ? "Nuestros servicios actuales son: {$servicesList}. Si me compartes tu contexto, te recomiendo el mejor punto de partida."
                    : 'Nuestros servicios estan en actualizacion. Comparte tu necesidad y te orientare.';
            }
            if (preg_match('/\b(contacto|correo|email|telefono|whatsapp|llamar)\b/', $normalizedMessage)) {
                return "Puedes contactarnos por /contact, por correo en {$contactEmail}, o por telefono/WhatsApp en {$contactPhone}. Direccion: {$contactAddress}.";
            }
            if (preg_match('/\b(equipo|miembro|miembros|agente|agentes|linkedin|quienes)\b/', $normalizedMessage)) {
                return "Nuestro equipo activo tiene {$teamCount} perfil(es)." . ($teamExamples !== '' ? " Ejemplos: {$teamExamples}." : '') . ' Mas informacion en /a-propos.';
            }
            if (preg_match('/\b(candidatura|empleo|trabajo|postular|cv|curriculum)\b/', $normalizedMessage)) {
                return "Puedes postular en /rejoindre. Campos principales: nombre, apellido, email, area, experiencia y mensaje. CV opcional en PDF (max 30 MB). Contacto RRHH: {$rhEmail}.";
            }

            return 'Puedo ayudarte con servicios, equipo, contacto, reclutamiento y presupuesto. Escribeme tu pregunta en espanol.';
        }

        if ($language === 'it') {
            if ($matchedTeamMember !== null && preg_match('/\b(chi e|parlami di|profilo|linkedin|membro)\b/', $normalizedMessage)) {
                return $this->formatTeamMemberReplyIt($matchedTeamMember);
            }

            if (preg_match('/\b(ciao|buongiorno|buonasera)\b/', $normalizedMessage)) {
                return 'Ciao, sono Edouard. Posso aiutarti a scegliere il servizio giusto e il prossimo passo. Qual e il tuo obiettivo principale?';
            }
            if (preg_match('/\b(servizio|servizi|offerta|soluzione|soluzioni)\b/', $normalizedMessage)) {
                return $servicesList !== ''
                    ? "I nostri servizi attuali sono: {$servicesList}. Se mi descrivi il tuo contesto, ti consiglio il miglior punto di partenza."
                    : 'I nostri servizi sono in aggiornamento. Descrivi il tuo bisogno e ti guidero.';
            }
            if (preg_match('/\b(contatto|email|telefono|whatsapp|chiamare)\b/', $normalizedMessage)) {
                return "Puoi contattarci da /contact, via email a {$contactEmail}, o via telefono/WhatsApp al {$contactPhone}. Indirizzo: {$contactAddress}.";
            }
            if (preg_match('/\b(squadra|team|membro|membri|agente|agenti|linkedin|chi siamo)\b/', $normalizedMessage)) {
                return "Il nostro team attivo conta {$teamCount} profilo/i." . ($teamExamples !== '' ? " Esempi: {$teamExamples}." : '') . ' Dettagli su /a-propos.';
            }
            if (preg_match('/\b(candidatura|lavoro|carriera|cv|curriculum)\b/', $normalizedMessage)) {
                return "Puoi candidarti su /rejoindre. Campi principali: nome, cognome, email, area, esperienza e messaggio. CV opzionale in PDF (max 30 MB). Contatto HR: {$rhEmail}.";
            }

            return 'Posso aiutarti su servizi, team, contatti, candidatura e budget. Scrivimi in italiano.';
        }

        if ($language === 'ar') {
            if ($matchedTeamMember !== null && preg_match('/من هو|حدثني عن|ملف|لينكد.?ان/u', $rawMessage)) {
                return $this->formatTeamMemberReplyAr($matchedTeamMember);
            }

            if (preg_match('/مرحبا|اهلا|السلام/', $rawMessage)) {
                return 'مرحبا، انا Edouard. يمكنني مساعدتك في اختيار الخدمة المناسبة والخطوة التالية.';
            }
            if (preg_match('/خدمة|الخدمات|حلول|الخدمة/u', $rawMessage)) {
                return $servicesList !== ''
                    ? "الخدمات المتاحة حاليا: {$servicesList}. ارسل لي احتياجك وساقترح لك افضل نقطة بداية."
                    : 'الخدمات قيد التحديث حاليا. اكتب احتياجك وساوجهك الى الخيار المناسب.';
            }
            if (preg_match('/تواصل|اتصال|بريد|ايميل|واتساب|هاتف/u', $rawMessage)) {
                return "يمكنك التواصل عبر /contact او البريد {$contactEmail} او الهاتف/واتساب {$contactPhone}. العنوان: {$contactAddress}.";
            }
            if (preg_match('/فريق|اعضاء|عضو|لينكد.?ان|linkedin/u', $rawMessage)) {
                return "عدد اعضاء الفريق النشط حاليا: {$teamCount}." . ($teamExamples !== '' ? " امثلة: {$teamExamples}." : '') . ' مزيد من التفاصيل في /a-propos.';
            }
            if (preg_match('/توظيف|وظيفة|انضم|سيرة|cv/u', $rawMessage)) {
                return "يمكنك التقديم عبر /rejoindre. السيرة الذاتية اختيارية بصيغة PDF (حد اقصى 30 MB). للتواصل مع الموارد البشرية: {$rhEmail}.";
            }

            return 'يمكنني مساعدتك في الخدمات، الفريق، وسائل التواصل، التوظيف، والتكلفة. اكتب سؤالك بالعربية.';
        }

        return "Je peux vous aider en francais, english, espanol, italiano ou arabe. Posez votre question.";
    }

    private function buildKnowledgeBase(array $settings, array $services, array $team): array
    {
        $contactEmail = $settings['contact_email'] ?? 'solution@yokkutelabs.com';
        $contactPhone = $settings['contact_phone'] ?? '+221 771488937';
        $rhEmail = $settings['rh_email'] ?? 'solution@yokkutelabs.com';
        $contactAddress = $settings['contact_address'] ?? 'Dakar, Senegal';
        $homeTitle = trim((string) ($settings['home_hero_title'] ?? 'Transformez votre entreprise a l ere du numerique et de l IA'));
        $homeSub = trim((string) ($settings['home_hero_sub'] ?? 'Nous accompagnons les entreprises africaines avec des solutions concretes.'));
        $homePrimaryCtaLabel = trim((string) ($settings['home_primary_cta_label'] ?? 'Demarrer avec un audit gratuit'));
        $homePrimaryCtaUrl = trim((string) ($settings['home_primary_cta_url'] ?? '/contact'));
        $servicesTitles = collect($services)
            ->pluck('title')
            ->filter(fn (mixed $title): bool => is_string($title) && trim($title) !== '')
            ->values();
        $servicesList = $servicesTitles->take(7)->implode(', ');

        $entries = [
            [
                'keywords' => ['accueil', 'home', 'presentation', 'yokkute', 'yokkute labs', 'votre approche'],
                'answer' => "Sur la page Accueil (/), notre promesse est claire: {$homeTitle}. {$homeSub} Prochaine etape recommandee: {$homePrimaryCtaLabel} via {$homePrimaryCtaUrl}.",
            ],
            [
                'keywords' => ['qui sommes nous', 'a propos', 'apropos', 'histoire', 'identite', 'equipe yokkute'],
                'answer' => "Sur Qui sommes-nous (/a-propos), nous expliquons notre vision, notre methode terrain et notre equipe pluridisciplinaire. Nous intervenons avec une approche pragmatique, orientee resultats, en combinant conseil, execution et transfert de competences.",
            ],
            [
                'keywords' => ['services', 'offres', 'prestations', 'ce que vous faites'],
                'answer' => $servicesList !== ''
                    ? "Sur la page Services (/services), vous retrouvez nos domaines d intervention: {$servicesList}. Si vous me decrivez votre besoin, je peux vous recommander le meilleur point de depart."
                    : "La page Services (/services) presente nos offres de transformation numerique. Dites-moi votre objectif et je vous orienterai vers le service pertinent.",
            ],
            [
                'keywords' => ['contact', 'joindre', 'coordonnees', 'adresse', 'email', 'telephone', 'whatsapp'],
                'answer' => "Sur la page Contact (/contact), vous pouvez nous ecrire pour un cadrage rapide. Email: {$contactEmail}. Telephone/WhatsApp: {$contactPhone}. Adresse: {$contactAddress}. Nous repondons generalement sous 24h ouvrrees.",
            ],
            [
                'keywords' => ['rejoindre', 'carriere', 'candidature', 'postuler', 'cv', 'recrutement'],
                'answer' => "Sur Nous rejoindre (/rejoindre), vous pouvez deposer une candidature spontanee. Champs principaux: prenom, nom, email, domaine, experience, message. CV optionnel en PDF (max 30 Mo). Domaines couverts: developpement, data/BI, conseil, gestion de projet, formation, commercial, marketing et transversal. Contact RH: {$rhEmail}.",
            ],
            [
                'keywords' => ['projet', 'projets', 'prise en charge', 'application', 'site web', 'ux', 'design'],
                'answer' => "Nous accompagnons les entreprises sur des projets de site web, application sur mesure, design UX/UI et transformation numerique globale. Si vous me donnez votre contexte, je peux vous orienter vers le point de depart le plus pertinent.",
            ],
            [
                'keywords' => ['delai', 'delais', 'temps', 'combien de temps', 'livraison'],
                'answer' => "Les delais dependent du perimetre: un site vitrine peut prendre 2 a 4 semaines, tandis qu'une application metier ou une transformation plus large peut demander plusieurs mois. Nous cadrons un planning detaille des le debut pour donner une trajectoire claire.",
            ],
            [
                'keywords' => ['maintenance', 'suivi', 'apres livraison', 'evolution', 'support'],
                'answer' => "Oui, nous proposons un suivi apres livraison: maintenance, corrections, mises a jour et evolutions. L'objectif est d'assurer la perennite de la solution, pas seulement de livrer un projet.",
            ],
            [
                'keywords' => ['rgpd', 'donnees', 'confidentialite', 'protection des donnees', 'vie privee'],
                'answer' => "La protection des donnees est une priorite. Vous pouvez consulter /rgpd pour le detail complet. Si besoin, je peux aussi vous resumer la politique de confidentialite en quelques points cles.",
            ],
            [
                'keywords' => ['premier contact', 'comment contacter', 'prise de contact', 'demarrer un projet'],
                'answer' => "La premiere etape est simple: passez par /contact avec votre contexte, votre besoin et votre horizon. Nous revenons vers vous sous 24 a 48 heures pour un premier echange de cadrage utile et concret.",
            ],
            [
                'keywords' => ['faq', 'questions frequentes', 'question frequente'],
                'answer' => "Vous pouvez consulter /faq pour retrouver les questions frequentes sur les projets, les delais, le suivi, le RGPD et le recrutement.",
            ],
            [
                'keywords' => ['contact', 'email', 'telephone', 'whatsapp', 'rdv', 'rendez vous'],
                'answer' => "Vous pouvez nous contacter via /contact, par email a {$contactEmail}, ou par telephone/WhatsApp au {$contactPhone}. Un membre de l'equipe lit chaque message et repond sous 24h ouvrrees.",
            ],
            [
                'keywords' => ['rejoindre', 'carriere', 'emploi', 'recrutement', 'postuler'],
                'answer' => "Pour nous rejoindre, allez sur /rejoindre. Nous recherchons notamment des profils en developpement, data/BI, conseil, gestion de projet, formation et business development. Contact RH: {$rhEmail}.",
            ],
        ];

        foreach ($services as $service) {
            $keywords = array_values(array_filter([
                (string) ($service->title ?? ''),
                (string) ($service->badge ?? ''),
                (string) ($service->audience ?? ''),
            ], static fn (string $value): bool => trim($value) !== ''));

            $deliverables = collect($service->deliverables ?? [])
                ->filter(fn (mixed $deliverable): bool => is_string($deliverable) && trim($deliverable) !== '')
                ->take(3)
                ->implode(', ');

            $answer = "Service {$service->title}: " . Str::of((string) ($service->description ?? ''))->squish()->limit(220, '...');

            if (trim((string) ($service->audience ?? '')) !== '') {
                $answer .= " Cible: {$service->audience}.";
            }

            if ($deliverables !== '') {
                $answer .= " Livrables: {$deliverables}.";
            }

            $answer .= " Plus de details sur /services.";

            $entries[] = [
                'keywords' => $keywords,
                'answer' => $answer,
            ];
        }

        if (!empty($team)) {
            $roles = collect($team)
                ->pluck('role')
                ->filter()
                ->unique()
                ->take(4)
                ->implode(', ');

            $teamExamples = collect($team)
                ->filter(fn ($member): bool => trim((string) ($member->name ?? '')) !== '' && trim((string) ($member->role ?? '')) !== '')
                ->take(3)
                ->map(function ($member): string {
                    $name = trim((string) $member->name);
                    $role = trim((string) $member->role);
                    $linkedin = trim((string) ($member->linkedin_url ?? ''));

                    if ($linkedin !== '' && $linkedin !== '#') {
                        return "{$name} ({$role}) - LinkedIn: {$linkedin}";
                    }

                    return "{$name} ({$role})";
                })
                ->implode(' ; ');

            $entries[] = [
                'keywords' => ['equipe', 'a propos', 'qui sommes nous', 'profils', 'membres', 'agent', 'agents', 'linkedin'],
                'answer' => "Notre equipe regroupe actuellement " . count($team) . " profil(s) actif(s)" . ($roles !== '' ? ", avec notamment {$roles}" : '') . ". Vous pouvez voir les profils sur /a-propos." . ($teamExamples !== '' ? " Exemples: {$teamExamples}." : ''),
            ];
        }

        return $entries;
    }

    private function bestKnowledgeMatch(string $normalizedMessage, array $entries): ?string
    {
        $bestAnswer = null;
        $bestScore = 0;

        foreach ($entries as $entry) {
            $score = 0;
            foreach ($entry['keywords'] ?? [] as $keyword) {
                $normalizedKeyword = $this->normalize((string) $keyword);

                if ($normalizedKeyword === '') {
                    continue;
                }

                if (str_contains($normalizedMessage, $normalizedKeyword)) {
                    $score += max(2, count($this->tokenize($normalizedKeyword)));
                    continue;
                }

                foreach ($this->tokenize($normalizedKeyword) as $token) {
                    if (strlen($token) >= 4 && str_contains($normalizedMessage, $token)) {
                        $score++;
                    }
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestAnswer = $entry['answer'] ?? null;
            }
        }

        return $bestScore >= 2 ? $bestAnswer : null;
    }

    private function bestServiceMatch(string $normalizedMessage, array $services): ?object
    {
        $tokens = $this->tokenize($normalizedMessage);

        if (empty($tokens) || empty($services)) {
            return null;
        }

        $best = null;
        $bestScore = 0;

        foreach ($services as $service) {
            $haystack = $this->normalize(trim((string) ($service->title ?? '') . ' ' . (string) ($service->badge ?? '') . ' ' . (string) ($service->description ?? '')));

            $score = 0;
            foreach ($tokens as $token) {
                if (strlen($token) < 3) {
                    continue;
                }

                if (str_contains($haystack, $token)) {
                    $score++;
                }
            }

            if ($score > $bestScore) {
                $best = $service;
                $bestScore = $score;
            }
        }

        return $bestScore >= 2 ? $best : null;
    }

    private function tokenize(string $text): array
    {
        $parts = preg_split('/[^a-z0-9]+/i', $text);

        if ($parts === false) {
            return [];
        }

        return array_values(array_filter(array_map('trim', $parts), static fn (string $part): bool => $part !== ''));
    }

    private function normalize(string $text): string
    {
        $normalized = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', mb_strtolower($text));

        if ($normalized === false) {
            return mb_strtolower($text);
        }

        return $normalized;
    }

    private function bestTeamMemberMatch(string $normalizedMessage, array $team): ?object
    {
        if (empty($team)) {
            return null;
        }

        $messageTokens = array_values(array_filter(
            $this->tokenize($normalizedMessage),
            static fn (string $token): bool => strlen($token) >= 3
        ));

        if (empty($messageTokens)) {
            return null;
        }

        $bestMember = null;
        $bestScore = 0;

        foreach ($team as $member) {
            $normalizedName = $this->normalize(trim((string) ($member->name ?? '')));

            if ($normalizedName === '') {
                continue;
            }

            $score = 0;
            if (str_contains($normalizedMessage, $normalizedName)) {
                $score += 8;
            }

            foreach ($this->tokenize($normalizedName) as $nameToken) {
                if (strlen($nameToken) < 3) {
                    continue;
                }

                if (in_array($nameToken, $messageTokens, true)) {
                    $score += 2;
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestMember = $member;
            }
        }

        return $bestScore >= 2 ? $bestMember : null;
    }

    private function formatTeamMemberReplyFr(object $member): string
    {
        $name = trim((string) ($member->name ?? ''));
        $role = trim((string) ($member->role ?? ''));
        $linkedin = trim((string) ($member->linkedin_url ?? ''));

        if ($linkedin !== '' && $linkedin !== '#') {
            return "{$name} fait partie de l'equipe Yokkute Labs en tant que {$role}. Vous pouvez consulter son profil LinkedIn ici: {$linkedin}.";
        }

        return "{$name} fait partie de l'equipe Yokkute Labs en tant que {$role}.";
    }

    private function formatTeamMemberReplyEn(object $member): string
    {
        $name = trim((string) ($member->name ?? ''));
        $role = trim((string) ($member->role ?? ''));
        $linkedin = trim((string) ($member->linkedin_url ?? ''));

        if ($linkedin !== '' && $linkedin !== '#') {
            return "{$name} is part of Yokkute Labs as {$role}. LinkedIn: {$linkedin}.";
        }

        return "{$name} is part of Yokkute Labs as {$role}.";
    }

    private function formatTeamMemberReplyEs(object $member): string
    {
        $name = trim((string) ($member->name ?? ''));
        $role = trim((string) ($member->role ?? ''));
        $linkedin = trim((string) ($member->linkedin_url ?? ''));

        if ($linkedin !== '' && $linkedin !== '#') {
            return "{$name} forma parte de Yokkute Labs como {$role}. LinkedIn: {$linkedin}.";
        }

        return "{$name} forma parte de Yokkute Labs como {$role}.";
    }

    private function formatTeamMemberReplyIt(object $member): string
    {
        $name = trim((string) ($member->name ?? ''));
        $role = trim((string) ($member->role ?? ''));
        $linkedin = trim((string) ($member->linkedin_url ?? ''));

        if ($linkedin !== '' && $linkedin !== '#') {
            return "{$name} fa parte di Yokkute Labs come {$role}. LinkedIn: {$linkedin}.";
        }

        return "{$name} fa parte di Yokkute Labs come {$role}.";
    }

    private function formatTeamMemberReplyAr(object $member): string
    {
        $name = trim((string) ($member->name ?? ''));
        $role = trim((string) ($member->role ?? ''));
        $linkedin = trim((string) ($member->linkedin_url ?? ''));

        if ($linkedin !== '' && $linkedin !== '#') {
            return "{$name} عضو في فريق Yokkute Labs بصفة {$role}. لينكدان: {$linkedin}.";
        }

        return "{$name} عضو في فريق Yokkute Labs بصفة {$role}.";
    }
}
