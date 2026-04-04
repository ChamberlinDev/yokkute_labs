<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') - {{ $siteSettings['site_name'] ?? 'Yokkute Labs' }}</title>
    <link rel="icon" type="image/png" href="{{ $versionedAsset('images/logo-yokkute.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #eef3fb;
            --admin-surface: #ffffff;
            --admin-surface-soft: #f8fbff;
            --admin-border: #d9e3f2;
            --admin-primary: #1a7a4a;
            --admin-primary-strong: #1a7a4a;
            --admin-ink: #0f172a;
            --admin-muted: #5f6f85;
            --admin-sidebar: #0f172a;
            --admin-sidebar-2: #111b32;
        }

        body {
            background:
                radial-gradient(circle at 85% 10%, rgba(26,122,74,0.08), transparent 30%),
                radial-gradient(circle at 10% 90%, rgba(59, 130, 246, 0.06), transparent 28%),
                var(--admin-bg);
            color: var(--admin-ink);
        }

        .admin-sidebar {
            min-height: 100vh;
            position: sticky;
            top: 0;
            background: linear-gradient(180deg, var(--admin-sidebar) 0%, var(--admin-sidebar-2) 100%);
            border-right: 1px solid rgba(148, 163, 184, 0.18);
        }

        .admin-sidebar .nav-link {
            color: rgba(241, 245, 249, 0.82);
            border-radius: 0.85rem;
            padding: 0.75rem 0.9rem;
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover {
            background: rgba(26,122,74,0.2);
            color: #ffffff;
            transform: translateX(2px);
        }

        .admin-brand {
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.01em;
        }

        .admin-main {
            min-height: 100vh;
        }

        .card-soft {
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            background: var(--admin-surface);
            box-shadow: 0 18px 44px rgba(15, 23, 42, 0.07);
            transition: transform 0.22s cubic-bezier(0.34, 1.26, 0.64, 1), box-shadow 0.22s ease;
        }
        .card-soft:hover {
            transform: translateY(-4px) scale(1.008);
            box-shadow: 0 26px 56px rgba(15, 23, 42, 0.13), 0 3px 10px rgba(26, 122, 74, 0.07);
        }

        .table th {
            color: #334155;
            font-weight: 700;
            background: var(--admin-surface-soft);
            border-bottom: 1px solid var(--admin-border);
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .form-control,
        .form-select {
            border-color: var(--admin-border);
            border-radius: 0.8rem;
        }

        .form-control:focus,
        .form-select:focus,
        .btn:focus {
            border-color: #67e8f9;
            box-shadow: 0 0 0 0.25rem rgba(26,122,74,0.2);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-strong));
            border: 0;
        }

        .btn-success:hover {
            filter: brightness(0.96);
        }

        .alert {
            border-radius: 0.9rem;
        }

        .btn-admin-back {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border-radius: 999px;
            border: 1px solid var(--admin-border);
            background: #fff;
            color: var(--admin-ink);
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-admin-back:hover {
            color: var(--admin-primary);
            border-color: rgba(26,122,74,0.45);
            background: rgba(26,122,74,0.06);
        }

        .badge {
            font-weight: 600;
            letter-spacing: 0.01em;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                min-height: auto;
                position: static;
                border-right: 0;
                border-bottom: 1px solid rgba(148, 163, 184, 0.18);
            }

            .admin-sidebar .nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .admin-sidebar .nav-link {
                padding: 0.6rem 0.8rem;
                font-size: 0.92rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row g-0">
            <aside class="col-lg-2 admin-sidebar p-3 p-lg-4">
                <a href="{{ route('admin.dashboard') }}" class="admin-brand d-flex align-items-center gap-2 mb-4">
                    <img src="{{ $versionedAsset($siteSettings['logo_path'] ?? 'images/logo-yokkute.png') }}" alt="Logo" style="width:42px;height:42px;object-fit:contain;background:#fff;border-radius:.75rem;padding:.35rem;">
                    <span>Admin</span>
                </a>

                <nav class="nav flex-column gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid me-2"></i>Tableau de bord</a>
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="bi bi-box-seam me-2"></i>Services</a>
                    <a href="{{ route('admin.team.index') }}" class="nav-link {{ request()->routeIs('admin.team.*') ? 'active' : '' }}"><i class="bi bi-people me-2"></i>Équipe</a>
                    <a href="{{ route('admin.partners.index') }}" class="nav-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}"><i class="bi bi-building me-2"></i>Partenaires</a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}"><i class="bi bi-envelope me-2"></i>Messages</a>
                    <a href="{{ route('admin.candidatures.index') }}" class="nav-link {{ request()->routeIs('admin.candidatures.*') ? 'active' : '' }}"><i class="bi bi-person-workspace me-2"></i>Candidatures</a>
                    <a href="{{ route('admin.security.logs') }}" class="nav-link {{ request()->routeIs('admin.security.*') ? 'active' : '' }}"><i class="bi bi-shield-check me-2"></i>Sécurité</a>
                    <a href="{{ route('admin.security.alerts') }}" class="nav-link {{ request()->routeIs('admin.security.alerts') ? 'active' : '' }}"><i class="bi bi-exclamation-triangle me-2"></i>Alertes actives</a>
                    <a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="bi bi-sliders me-2"></i>Réglages</a>
                </nav>
            </aside>

            <main class="col-lg-10 p-3 p-md-4 p-xl-5 admin-main">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                    <div>
                        @unless(request()->routeIs('admin.dashboard'))
                            <a href="{{ route('admin.dashboard') }}"
                               class="btn-admin-back mb-2"
                               onclick="if (window.history.length > 1) { event.preventDefault(); window.history.back(); }">
                                <i class="bi bi-arrow-left-short"></i>
                                Retour
                            </a>
                        @endunless
                        <p class="text-uppercase text-muted small mb-1">Back-office</p>
                        <h1 class="h3 mb-0">@yield('page-title', 'Administration')</h1>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        @if(auth()->check() && auth()->user()?->is_admin)
                            <a href="{{ route('admin.password.edit') }}" class="btn btn-outline-primary">Mot de passe</a>
                        @endif
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary" target="_blank" rel="noopener noreferrer">Voir le site</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark">Déconnexion</button>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success border-0 rounded-4 mb-4">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-4 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
