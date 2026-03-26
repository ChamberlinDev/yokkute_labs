<nav class="navbar-yokkute">
    <a href="{{ route('home') }}" class="nav-brand">
            <img src="{{ asset('images/logo-yokkute.png') }}" alt="Yokkuté Labs" style="height:48px; width:auto;">
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}"     class="{{ request()->routeIs('home')     ? 'active' : '' }}">Accueil</a></li>
        <li><a href="{{ route('about') }}"    class="{{ request()->routeIs('about')    ? 'active' : '' }}">À propos</a></li>
        <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
        <li><a href="{{ route('contact') }}"  class="{{ request()->routeIs('contact')  ? 'active' : '' }}">Contact</a></li>
        <li><a href="{{ route('contact') }}"  class="btn btn-primary text-white px-3 py-2">Nous rejoindre</a></li>
    </ul>
</nav>