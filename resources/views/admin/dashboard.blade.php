@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card card-soft p-4 h-100"><p class="text-muted mb-2">Services</p><h2 class="mb-0">{{ $stats['services'] }}</h2></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-soft p-4 h-100"><p class="text-muted mb-2">Membres de l'équipe</p><h2 class="mb-0">{{ $stats['team'] }}</h2></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-soft p-4 h-100"><p class="text-muted mb-2">Candidatures</p><h2 class="mb-0">{{ $stats['candidatures'] }}</h2></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-soft p-4 h-100"><p class="text-muted mb-2">Messages de contact</p><h2 class="mb-0">{{ $stats['contactMessages'] }}</h2></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-soft p-4 h-100 border-warning-subtle"><p class="text-muted mb-2">Événements de sécurité</p><h2 class="mb-0 text-warning">{{ $stats['securityEvents'] }}</h2></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-soft p-4 h-100 border-danger-subtle"><p class="text-muted mb-2">Échecs de connexion admin (jour)</p><h2 class="mb-0 text-danger">{{ $stats['failedLoginsToday'] }}</h2></div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card card-soft p-4 h-100 border-success-subtle">
            <p class="text-muted mb-2">À traiter aujourd'hui (candidatures)</p>
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-success">{{ $stats['candidaturesToProcessToday'] }}</h2>
                <a href="{{ route('admin.candidatures.index', ['status' => 'new']) }}" class="btn btn-sm btn-outline-success">Voir la liste</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-soft p-4 h-100 border-info-subtle">
            <p class="text-muted mb-2">À traiter aujourd'hui (messages)</p>
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-info">{{ $stats['messagesToProcessToday'] }}</h2>
                <a href="{{ route('admin.contact-messages.index', ['status' => 'new']) }}" class="btn btn-sm btn-outline-info">Voir la liste</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-6">
        <div class="card card-soft p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 mb-0">Dernières candidatures</h2>
                <a href="{{ route('admin.candidatures.index') }}" class="btn btn-sm btn-outline-secondary">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Nom</th><th>Domaine</th><th>Statut</th></tr></thead>
                    <tbody>
                        @forelse($latestCandidatures as $candidature)
                            <tr>
                                <td><a href="{{ route('admin.candidatures.show', $candidature) }}" class="text-decoration-none">{{ $candidature->prenom }} {{ $candidature->nom }}</a></td>
                                <td>{{ $candidature->domaine }}</td>
                                <td><span class="badge text-bg-secondary">{{ $candidature->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted">Aucune candidature pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-soft p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 mb-0">Derniers messages</h2>
                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-outline-secondary">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Expéditeur</th><th>Besoin</th><th>Statut</th></tr></thead>
                    <tbody>
                        @forelse($latestMessages as $message)
                            <tr>
                                <td><a href="{{ route('admin.contact-messages.show', $message) }}" class="text-decoration-none">{{ $message->prenom }} {{ $message->nom }}</a></td>
                                <td>{{ $message->besoin }}</td>
                                <td><span class="badge text-bg-secondary">{{ $message->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted">Aucun message pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="card card-soft p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 mb-0">Activité admin récente</h2>
                <a href="{{ route('admin.security.logs') }}" class="btn btn-sm btn-outline-dark">Journal complet</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Heure</th><th>Action</th><th>Compte</th><th>Cible</th><th>Statut</th><th>IP</th></tr></thead>
                    <tbody>
                        @forelse($latestSecurityEvents as $event)
                            <tr>
                                <td>{{ optional($event->created_at)->format('d/m H:i') }}</td>
                                <td>{{ $event->action }}</td>
                                <td>{{ $event->user_email ?? 'anonyme' }}</td>
                                <td>{{ $event->target_type && $event->target_id ? $event->target_type.' #'.$event->target_id : '-' }}</td>
                                <td><span class="badge text-bg-secondary">{{ $event->status_code ?? '-' }}</span></td>
                                <td>{{ $event->ip_address ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-muted">Aucun événement de sécurité journalisé pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
