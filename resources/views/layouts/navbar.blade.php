<nav class="navbar-yokkute">

  <!-- Brand -->
  <a href="{{ route('home') }}" class="nav-brand">
    <img src="{{ $versionedAsset('images/logo-yokkute.png') }}" alt="Yokkuté Labs" style="height:52px; width:auto;">
  </a>

  <!-- Hamburger -->
  <button class="nav-burger" id="navBurger" aria-label="Menu" aria-expanded="false">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <!-- Links -->
  <ul class="nav-links" id="navLinks">
    <li><a href="{{ route('home') }}"     class="{{ request()->routeIs('home')     ? 'active' : '' }}">Accueil</a></li>
    <li><a href="{{ route('about') }}"    class="{{ request()->routeIs('about')    ? 'active' : '' }}">Qui sommes-nous ?</a></li>
    <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
    <li><a href="{{ route('contact') }}"  class="{{ request()->routeIs('contact')  ? 'active' : '' }}">Contact</a></li>
    <li>
      <a href="{{ route('rejoindre') }}" class="nav-cta {{ request()->routeIs('rejoindre') ? 'active' : '' }}">Nous rejoindre</a>
    </li>
  </ul>

  <!-- Overlay mobile -->
  <div class="nav-overlay" id="navOverlay"></div>

</nav>
