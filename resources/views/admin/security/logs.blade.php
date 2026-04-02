@extends('admin.layouts.app')

@section('title', 'Journal de sécurité')
@section('page-title', 'Journal de sécurité')

@section('content')
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('admin.security.logs') }}" class="btn btn-dark btn-sm">Journal</a>
    <a href="{{ route('admin.security.alerts') }}" class="btn btn-outline-dark btn-sm">Alertes</a>
    <a href="{{ route('admin.password.edit') }}" class="btn btn-outline-primary btn-sm">Mot de passe</a>
</div>

<div class="card card-soft p-4 mb-4">
    <form method="GET" action="{{ route('admin.security.logs') }}" class="row g-3 align-items-end">
        <div class="col-md-6">
            <label class="form-label">Recherche</label>
            <input type="text" name="q" class="form-control" value="{{ $filters['q'] }}" placeholder="email, action, route, IP...">
        </div>
        <div class="col-md-4">
            <label class="form-label">Action</label>
            <select name="action" class="form-select">
                <option value="">Toutes</option>
                @foreach($actions as $action)
                    <option value="{{ $action }}" @selected($filters['action'] === $action)>{{ $action }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-success" type="submit">Filtrer</button>
        </div>
    </form>
</div>

<div class="card card-soft p-4">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Heure</th>
                    <th>Action</th>
                    <th>Compte</th>
                    <th>Route</th>
                    <th>Cible</th>
                    <th>Code</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ optional($event->created_at)->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $event->action }}</td>
                        <td>{{ $event->user_email ?? 'anonyme' }}</td>
                        <td>{{ $event->route ?? '-' }}</td>
                        <td>{{ $event->target_type && $event->target_id ? $event->target_type.' #'.$event->target_id : '-' }}</td>
                        <td><span class="badge text-bg-secondary">{{ $event->status_code ?? '-' }}</span></td>
                        <td>{{ $event->ip_address ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-muted">Aucun événement de sécurité.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $events->links() }}
    </div>
</div>
@endsection
