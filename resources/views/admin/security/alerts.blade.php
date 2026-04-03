@extends('admin.layouts.app')

@section('title', 'Alertes de sécurité')
@section('page-title', 'Alertes de sécurité actives')

@section('content')
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('admin.security.logs') }}" class="btn btn-outline-dark btn-sm">Journal</a>
    <a href="{{ route('admin.security.alerts') }}" class="btn btn-dark btn-sm">Alertes</a>
    <a href="{{ route('admin.password.edit') }}" class="btn btn-outline-primary btn-sm">Mot de passe</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100 border-danger-subtle">
            <h2 class="h5 mb-3">Comptes admin verrouillés</h2>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Compte</th><th>Échecs</th><th>Verrouillé jusqu'à</th></tr></thead>
                    <tbody>
                        @forelse($lockedAdmins as $admin)
                            <tr>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->failed_admin_logins }}</td>
                                <td>{{ optional($admin->admin_locked_until)->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted">Aucun compte verrouillé actuellement.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100 border-warning-subtle">
            <h2 class="h5 mb-3">Rotation mot de passe requise</h2>
            <p class="text-muted small mb-3">Politique actuelle : rotation tous les {{ $passwordMaxAgeDays }} jours.</p>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Compte</th><th>Rotation forcee</th><th>Dernier changement</th></tr></thead>
                    <tbody>
                        @forelse($passwordRotationRiskAdmins as $admin)
                            <tr>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->force_password_reset ? 'Oui' : 'Non' }}</td>
                                <td>{{ optional($admin->password_changed_at)->format('d/m/Y H:i:s') ?? 'Jamais' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted">Aucun compte en alerte rotation.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card card-soft p-4 border-primary-subtle">
            <h2 class="h5 mb-3">Créer un compte admin</h2>
            <p class="text-muted small mb-3">Créer rapidement un nouvel accès administrateur via e-mail et mot de passe.</p>

            <form action="{{ route('admin.security.admins.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label for="new_admin_email" class="form-label">E-mail admin</label>
                    <input
                        type="email"
                        id="new_admin_email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control"
                        required
                        autocomplete="off"
                    >
                </div>
                <div class="col-md-4">
                    <label for="new_admin_password" class="form-label">Mot de passe</label>
                    <input
                        type="password"
                        id="new_admin_password"
                        name="password"
                        class="form-control"
                        required
                        autocomplete="new-password"
                    >
                </div>
                <div class="col-md-4">
                    <label for="new_admin_password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input
                        type="password"
                        id="new_admin_password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        required
                        autocomplete="new-password"
                    >
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Créer l'admin</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12">
        <div class="card card-soft p-4">
            <h2 class="h5 mb-3">Comptes admin existants</h2>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Nom</th><th>E-mail</th><th>Statut</th><th>Créé le</th><th>Dernière connexion</th><th>Action</th></tr></thead>
                    <tbody>
                        @forelse($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @if($admin->admin_disabled_at)
                                        <span class="badge text-bg-warning">Inactif</span>
                                    @else
                                        <span class="badge text-bg-success">Actif</span>
                                    @endif
                                </td>
                                <td>{{ optional($admin->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td>{{ optional($admin->last_admin_login_at)->format('d/m/Y H:i:s') ?? 'Jamais' }}</td>
                                <td>
                                    <form action="{{ route('admin.security.admins.toggle', $admin) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($admin->admin_disabled_at)
                                            <button type="submit" class="btn btn-sm btn-outline-success">Réactiver</button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Désactiver</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-muted">Aucun compte admin trouvé.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100">
            <h2 class="h5 mb-3">Échecs de connexion (24 h) par compte</h2>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Compte</th><th>Tentatives</th></tr></thead>
                    <tbody>
                        @forelse($failedAttemptsByEmail as $item)
                            <tr>
                                <td>{{ $item->user_email }}</td>
                                <td><span class="badge text-bg-secondary">{{ $item->attempts }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-muted">Aucun échec enregistré sur les 24 dernières heures.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100">
            <h2 class="h5 mb-3">Échecs de connexion (24 h) par IP</h2>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>IP</th><th>Tentatives</th></tr></thead>
                    <tbody>
                        @forelse($failedAttemptsByIp as $item)
                            <tr>
                                <td>{{ $item->ip_address }}</td>
                                <td><span class="badge text-bg-secondary">{{ $item->attempts }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-muted">Aucun échec enregistré sur les 24 dernières heures.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
