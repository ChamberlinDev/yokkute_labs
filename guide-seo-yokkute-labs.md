# Guide SEO Yokkute Labs (Laravel)
> Site : https://yokkutelabs.com
> Derniere mise a jour : avril 2026
> Stack : Laravel 12 · site bilingue FR/EN · VPS Contabo · Nginx

---

## Objectif

Ce document sert de feuille de route SEO adaptee au projet Yokkute Labs tel qu'il existe aujourd'hui.

Le site a deja :
- des routes publiques localisees en `/fr/...` et `/en/...`
- des metas SEO injectees depuis le layout Blade
- des balises `hreflang`
- un `robots.txt`
- un `sitemap.xml` statique public

Les prochains gains se feront surtout sur :
- la qualite des metas page par page
- les performances de la home
- les visuels de partage social
- le contenu cible par service
- le suivi dans Search Console

---

## Priorites actuelles

| Priorite | Sujet | Impact |
|---|---|---|
| Haute | Maintenir et automatiser le sitemap FR/EN si le site evolue | Indexation coherente |
| Haute | Creer un vrai visuel Open Graph dedie | Previews LinkedIn / WhatsApp |
| Haute | Optimiser le hero video (`id1.mp4`) pour le LCP | Core Web Vitals |
| Moyenne | Garder des metas uniques pour chaque page publique | CTR et pertinence |
| Moyenne | Ajouter des pages ou contenus par service | SEO business |
| Moyenne | Connecter Search Console, GA4 et Google Business Profile | Pilotage SEO |

---

## 1. Approche retenue dans ce projet

Pour Yokkute Labs, l'approche actuelle la plus simple et la plus fiable est :
- metas gerees directement dans `resources/views/layouts/app.blade.php`
- surcharges page par page via `@section('title')`, `@section('meta_description')`, `@section('og_title')`, `@section('og_description')`
- JSON-LD genere via `@json(...)`

Cette approche suffit pour le site actuel.  
Le package `artesaos/seotools` reste une option si un jour :
- le nombre de pages explose
- les metas deviennent tres dynamiques
- vous voulez centraliser davantage la logique SEO

### Exemple de structure dans le layout

```blade
<title>@yield('title', 'Yokkute Labs')</title>
<meta name="description" content="@yield('meta_description', 'Description par defaut')">
<link rel="canonical" href="{{ url()->current() }}">

<meta property="og:title" content="@yield('og_title', 'Yokkute Labs')">
<meta property="og:description" content="@yield('og_description', 'Description Open Graph')">
<meta property="og:image" content="@yield('og_image', asset('images/logo-yokkute.png'))">
```

---

## 2. hreflang FR / EN

Le site utilise les memes slugs publics en FR et EN, avec seulement le prefixe de langue :
- `/fr`
- `/en`
- `/fr/services`
- `/en/services`
- `/fr/a-propos`
- `/en/a-propos`

Il ne faut donc pas construire les URLs `hreflang` en concaténant simplement `/fr` ou `/en` devant `request()->getPathInfo()`, sinon on obtient des URLs incorrectes du type `/fr/fr/services`.

### Exemple correct

```blade
@php
    $rawPath = request()->getPathInfo();
    $pathWithoutLocale = preg_replace('#^/(fr|en)(?=/|$)#', '', $rawPath) ?: '/';
    $frPath = $pathWithoutLocale === '/' ? '/fr' : '/fr'.$pathWithoutLocale;
    $enPath = $pathWithoutLocale === '/' ? '/en' : '/en'.$pathWithoutLocale;
@endphp

<link rel="alternate" hreflang="fr" href="{{ url($frPath) }}" />
<link rel="alternate" hreflang="en" href="{{ url($enPath) }}" />
<link rel="alternate" hreflang="x-default" href="{{ config('app.url') }}" />
```

---

## 3. Metas a maintenir par page

Chaque page publique doit idealement avoir :
- un `<title>` unique
- une `meta description`
- un `og:title`
- un `og:description`
- si possible une image de partage adaptee

### Titres recommandes

| Page | Titre recommande |
|---|---|
| Accueil | `Yokkute Labs - Agence de transformation numerique a Dakar, Senegal` |
| Services | `Nos services - SEO, ERP, IA, Big Data - Yokkute Labs Dakar` |
| A propos | `Qui sommes-nous ? - Yokkute Labs, agence numerique a Dakar` |
| Contact | `Contactez Yokkute Labs - Dakar, Senegal` |
| Nous rejoindre | `Nous rejoindre - Yokkute Labs Dakar` |
| RGPD | `Politique RGPD - Yokkute Labs` |

### Points de vigilance

- eviter des fallbacks toujours en francais si la page anglaise n'a pas ses propres metas
- garder un seul domaine canonique partout : `https://yokkutelabs.com`
- ne pas referencer d'assets inexistants dans `og:image`

---

## 4. Open Graph et Twitter Card

Aujourd'hui, le fallback peut s'appuyer sur un asset existant comme le logo.

### Minimum viable

```html
<meta property="og:type" content="website">
<meta property="og:title" content="Yokkute Labs">
<meta property="og:description" content="Transformation digitale pour les entreprises africaines.">
<meta property="og:image" content="https://yokkutelabs.com/images/logo-yokkute.png">
```

### Recommandation

Creer ensuite un vrai visuel social :
- fichier cible : `public/images/og-image.jpg`
- format recommande : `1200x630`
- contenu : logo + promesse claire + direction visuelle coherente

---

## 5. Donnees structurees (Schema.org)

Le JSON-LD doit etre genere proprement dans Blade.

### Recommandation

Utiliser un tableau PHP puis `@json(...)`, plutot qu'un bloc JSON brut contenant des cles comme `@context` directement dans Blade.

### Exemple

```blade
@php
    $schemaData = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Yokkute Labs',
        'url' => config('app.url'),
        'logo' => asset('images/logo-yokkute.png'),
        'inLanguage' => ['fr', 'en'],
    ];
@endphp

<script type="application/ld+json">
@json($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
</script>
```

---

## 6. Sitemap XML

Le projet dispose actuellement d'un sitemap statique :
- `public/sitemap.xml`

Il doit contenir uniquement les URLs publiques indexables, par exemple :
- `/fr`
- `/en`
- `/fr/services`
- `/en/services`
- `/fr/a-propos`
- `/en/a-propos`
- `/fr/contact`
- `/en/contact`
- `/fr/rejoindre`
- `/en/rejoindre`
- `/fr/faq`
- `/en/faq`
- `/fr/rgpd`
- `/en/rgpd`

### Soumission

- Google Search Console
- URL a soumettre : `https://yokkutelabs.com/sitemap.xml`

### Si le site evolue souvent

Vous pourrez ensuite automatiser la generation avec `spatie/laravel-sitemap`, mais il faudra alors :
- installer le package
- ecrire la logique de generation
- planifier cette logique via le scheduler Laravel

Exemple d'idee :

```php
Schedule::call(function (): void {
    // Generer ici le sitemap a partir des routes publiques
})->weekly();
```

---

## 7. robots.txt

Le `robots.txt` doit rester coherent avec le vrai domaine et le vrai sitemap.

### Version attendue

```txt
User-agent: *
Allow: /

Sitemap: https://yokkutelabs.com/sitemap.xml

Disallow: /admin/
Disallow: /api/
Disallow: /admin/login
```

Note :
- `Disallow` ne remplace pas une vraie strategie `noindex` pour les ecrans admin
- si l'admin ne doit jamais ressortir, il faut aussi eviter de le promouvoir publiquement

---

## 8. Performances et Core Web Vitals

Le principal point sensible du site actuel reste la home.

### Hero video

Le hero utilise `id1.mp4`.  
Pour limiter son impact SEO :
- garder `preload="none"`
- utiliser un `poster` existant ou optimise
- envisager une image statique sur mobile si besoin

### Recommandations concretes

```html
<video autoplay muted loop playsinline preload="none" poster="/images/videoframe_4349.png">
    <source src="/images/id1.mp4" type="video/mp4">
</video>
```

### Autres optimisations utiles

- convertir les visuels lourds en WebP quand c'est pertinent
- garder le preload seulement sur les assets critiques
- activer la compression et le cache navigateur dans Nginx

Exemple Nginx :

```nginx
gzip on;
gzip_types text/html text/css application/javascript application/json image/svg+xml;
gzip_min_length 1024;

location ~* \.(css|js|webp|png|jpg|jpeg|ico|woff2)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

---

## 9. Strategie mots-cles

Les pages actuelles doivent surtout viser des intentions commerciales proches du coeur d'offre.

### Axes prioritaires

| Page | Mot-cle principal | Exemples secondaires |
|---|---|---|
| Accueil | `agence digitale Dakar` | `transformation numerique Senegal`, `agence web Dakar` |
| Services | `services numeriques Senegal` | `ERP PME Afrique`, `SEO Dakar`, `IA entreprise` |
| Contact | `agence numerique contact Dakar` | `devis transformation digitale Senegal` |
| A propos | `agence numerique Dakar` | `expert data IA Dakar` |

### Etape suivante importante

Creer a moyen terme des pages dediees par service :
- `/fr/services/audit-numerique`
- `/fr/services/seo`
- `/fr/services/integration-ia`
- etc.

Ce type de pages aura plus d'impact SEO qu'une simple page liste.

---

## 10. Contenu

Le SEO long terme viendra surtout du contenu utile.

### Idees d'articles

1. `Comment digitaliser votre PME a Dakar en 2026`
2. `SEO au Senegal : pourquoi votre site n'apparait pas sur Google`
3. `ERP pour les entreprises africaines : comment choisir`
4. `Cas d'usage IA concrets pour les PME senegalaises`
5. `Business Intelligence : quels tableaux de bord mettre en place`

### Rythme minimal

- 2 articles par mois si possible
- version FR d'abord
- version EN ensuite si elle apporte une vraie valeur

---

## 11. Outils a connecter

| Outil | Usage |
|---|---|
| Google Search Console | Indexation, erreurs, performances SEO |
| Google Analytics 4 | Trafic et conversions |
| Google Business Profile | Visibilite locale Dakar |
| PageSpeed Insights | Controle des performances |
| Ahrefs / Semrush / Ubersuggest | Recherche de mots-cles et concurrence |

---

## Checklist prioritaire

### A court terme

- [x] Mettre en place les metas SEO dans le layout public
- [x] Ajouter les `hreflang` FR/EN
- [x] Ajouter un `robots.txt` coherent
- [x] Publier un `sitemap.xml`
- [ ] Creer un vrai visuel `og-image.jpg`
- [ ] Connecter Google Search Console

### Dans le mois

- [ ] Tester toutes les pages publiques dans Search Console
- [ ] Mesurer le LCP de la home avec PageSpeed Insights
- [ ] Ameliorer encore les visuels et poids des assets
- [ ] Rediger les premieres pages ou contenus SEO par service

### A moyen terme

- [ ] Automatiser le sitemap si le site devient plus dynamique
- [ ] Ajouter une vraie strategie contenu
- [ ] Suivre les positions sur les mots-cles cibles

---

*Guide adapte au projet Yokkute Labs - https://yokkutelabs.com*
