<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion admin - {{ $siteSettings['site_name'] ?? 'Yokkute Labs' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1rem;
            background:
                radial-gradient(circle at 80% 12%, rgba(26,122,74,0.2), transparent 35%),
                radial-gradient(circle at 15% 85%, rgba(59, 130, 246, 0.16), transparent 30%),
                linear-gradient(135deg, #0f172a, #111827 55%, #1f2937);
        }

        .login-card {
            width: min(100%, 470px);
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 1.35rem;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.28);
            backdrop-filter: blur(4px);
        }

        .login-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            background: rgba(26,122,74,0.13);
            color: #1a7a4a;
            font-weight: 700;
            font-size: 0.74rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .form-control {
            border-radius: 0.8rem;
            border-color: #d9e3f2;
        }

        .form-control:focus,
        .form-check-input:focus,
        .btn:focus {
            border-color: #67e8f9;
            box-shadow: 0 0 0 0.25rem rgba(26,122,74,0.2);
        }

        .btn-success {
            background: linear-gradient(135deg, #1a7a4a, #1a7a4a);
            border: 0;
        }

        .btn-success:hover {
            filter: brightness(0.96);
        }
    </style>
</head>
<body>
    <div class="card login-card p-4 p-md-5">
        <div class="text-center mb-4">
            <p class="login-pill mb-3"><i class="bi bi-shield-lock"></i>Administration</p>
            <h1 class="h3 mb-2">Connexion au back-office</h1>
            <p class="text-muted mb-0">Utilisez votre compte administrateur pour gerer le contenu du site.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-4">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.store') }}" method="POST" class="d-grid gap-3">
            @csrf
            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" autocomplete="username" autocapitalize="off" spellcheck="false" required>
            </div>
            <div>
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control form-control-lg" autocomplete="current-password" required>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Rester connecte</label>
            </div>
            <button type="submit" class="btn btn-success btn-lg">Se connecter</button>
            <a href="{{ route('home') }}" class="btn btn-link text-decoration-none">Retour au site</a>
        </form>
    </div>
</body>
</html>
