<nav class="navbar-yokkute">
    <a href="{{ route('home') }}" class="nav-brand">
        <img src="{{ $versionedAsset('images/logo-yokkute.png') }}" alt="Yokkute Labs" style="height:52px; width:auto;">
    </a>

    <button class="nav-burger" id="navBurger" aria-label="Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <ul class="nav-links" id="navLinks">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('site.nav.home') }}</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('site.nav.about') }}</a></li>
        <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ __('site.nav.services') }}</a></li>
        <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('site.nav.contact') }}</a></li>
        <li class="nav-locale-group">
            <a href="{{ $switchLocaleUrl('fr') }}" hreflang="fr" lang="fr" class="nav-locale-link {{ app()->getLocale() === 'fr' ? 'active' : '' }}">FR</a>
            <span class="nav-locale-separator">/</span>
            <a href="{{ $switchLocaleUrl('en') }}" hreflang="en" lang="en" class="nav-locale-link {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
        </li>
        <li>
            <a href="{{ route('rejoindre') }}" class="nav-cta {{ request()->routeIs('rejoindre') ? 'active' : '' }}">{{ __('site.nav.join') }}</a>
        </li>
    </ul>

    <div class="nav-overlay" id="navOverlay"></div>
</nav>
