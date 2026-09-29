<header class="site-header">
    <button class="icon-button menu-button" type="button" aria-label="Deschide meniul" aria-controls="side-menu"
            aria-expanded="false" data-menu-open>
        <x-heroicon-o-bars-3 class="ui-icon" aria-hidden="true"/>
    </button>

    <a class="brand" href="{{ route('project.index') }}">
        <span class="brand-mark">CP</span>
        <span>{{ $projectName }}</span>
    </a>

    <a class="icon-button account-button" href="{{ route('project.login') }}" aria-label="Autentificare">
        <x-heroicon-o-user-circle class="ui-icon" aria-hidden="true"/>
    </a>
</header>

<div class="menu-backdrop" data-menu-backdrop></div>

<aside id="side-menu" class="side-menu" aria-hidden="true" data-side-menu>
    <div class="side-menu-header">
        <p>Meniu principal</p>
        <button class="icon-button close-button" type="button" aria-label="Închide meniul" data-menu-close>
            <x-heroicon-o-x-mark class="ui-icon" aria-hidden="true"/>
        </button>
    </div>

    <nav aria-label="Navigare principală">
        <a class="menu-link {{ request()->routeIs('project.index') ? 'is-active' : '' }}"
           href="{{ route('project.index') }}">
            <x-heroicon-o-home class="menu-icon" aria-hidden="true"/>
            Acasă</a>
        <a class="menu-link {{ request()->routeIs('project.catalog') ? 'is-active' : '' }}"
           href="{{ route('project.catalog') }}">
            <x-heroicon-o-shopping-cart class="menu-icon" aria-hidden="true"/>
            Catalog</a>
        <a class="menu-link {{ request()->routeIs('project.services') ? 'is-active' : '' }}"
           href="{{ route('project.services') }}">
            <x-heroicon-o-wrench-screwdriver class="menu-icon" aria-hidden="true"/>
            Servicii</a>
        <a class="menu-link {{ request()->routeIs('project.contact') ? 'is-active' : '' }}"
           href="{{ route('project.contact') }}">
            <x-heroicon-o-phone class="menu-icon" aria-hidden="true"/>
            Contact</a>
        <a class="menu-link {{ request()->routeIs('project.login') ? 'is-active' : '' }}"
           href="{{ route('project.login') }}">
            <x-heroicon-o-arrow-right-end-on-rectangle class="menu-icon" aria-hidden="true"/>
            Autentificare</a>
    </nav>
</aside>
