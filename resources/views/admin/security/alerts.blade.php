@extends('admin.layouts.app')

@section('title', 'Alertes securite')
@section('page-title', 'Alertes securite actives')

@section('content')
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('admin.security.logs') }}" class="btn btn-outline-dark btn-sm">Journal</a>
    <a href="{{ route('admin.security.alerts') }}" class="btn btn-dark btn-sm">Alertes</a>
    <a href="{{ route('admin.password.edit') }}" class="btn btn-outline-primary btn-sm">Mot de passe</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100 border-danger-subtle">
            <h2 class="h5 mb-3">Comptes admin verrouilles</h2>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Compte</th><th>Echecs</th><th>Verrouille jusqu'a</th></tr></thead>
                    <tbody>
                        @forelse($lockedAdmins as $admin)
                            <tr>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->failed_admin_logins }}</td>
                                <td>{{ optional($admin->admin_locked_until)->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted">Aucun compte verrouille actuellement.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100 border-warning-subtle">
            <h2 class="h5 mb-3">Rotation mot de passe requise</h2>
            <p class="text-muted small mb-3">Politique actuelle: rotation tous les {{ $passwordMaxAgeDays }} jours.</p>
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
    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100">
            <h2 class="h5 mb-3">Echecs login (24h) par compte</h2>
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
                            <tr><td colspan="2" class="text-muted">Aucun echec enregistre sur les 24 dernieres heures.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-soft p-4 h-100">
            <h2 class="h5 mb-3">Echecs login (24h) par IP</h2>
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
                            <tr><td colspan="2" class="text-muted">Aucun echec enregistre sur les 24 dernieres heures.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection