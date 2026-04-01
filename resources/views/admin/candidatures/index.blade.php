@extends('admin.layouts.app')

@section('title', 'Candidatures')
@section('page-title', 'Candidatures')

@section('content')
@php
    $currentSort = $filters['sort'] ?? 'created_at';
    $currentDir = $filters['dir'] ?? 'desc';
    $queryParams = request()->query();
    $sortUrl = static function (string $column) use ($currentSort, $currentDir, $queryParams): string {
        $nextDir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';

        return route('admin.candidatures.index', array_merge($queryParams, [
            'sort' => $column,
            'dir' => $nextDir,
        ]));
    };
    $sortLabel = static function (string $label, string $column) use ($currentSort, $currentDir): string {
        if ($currentSort !== $column) {
            return $label;
        }

        return $label . ($currentDir === 'asc' ? ' (A)' : ' (D)');
    };
@endphp

<div class="card card-soft p-4">
    <form method="GET" action="{{ route('admin.candidatures.index') }}" class="row g-2 mb-4">
        <div class="col-md-6 col-lg-4">
            <input type="text" name="q" class="form-control" value="{{ $filters['q'] ?? '' }}" placeholder="Rechercher: nom, email, domaine...">
        </div>
        <div class="col-md-3 col-lg-2">
            <select name="status" class="form-select">
                <option value="">Tous les statuts</option>
                @foreach($statuses as $statusOption)
                    <option value="{{ $statusOption }}" @selected(($filters['status'] ?? '') === $statusOption)>{{ $statusOption }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-lg-2">
            <select name="sort" class="form-select">
                <option value="created_at" @selected(($filters['sort'] ?? 'created_at') === 'created_at')>Trier par date</option>
                <option value="nom" @selected(($filters['sort'] ?? '') === 'nom')>Trier par nom</option>
                <option value="domaine" @selected(($filters['sort'] ?? '') === 'domaine')>Trier par domaine</option>
                <option value="experience" @selected(($filters['sort'] ?? '') === 'experience')>Trier par expérience</option>
                <option value="status" @selected(($filters['sort'] ?? '') === 'status')>Trier par statut</option>
            </select>
        </div>
        <div class="col-md-3 col-lg-1">
            <select name="dir" class="form-select">
                <option value="desc" @selected(($filters['dir'] ?? 'desc') === 'desc')>Desc</option>
                <option value="asc" @selected(($filters['dir'] ?? '') === 'asc')>Asc</option>
            </select>
        </div>
        <div class="col-md-9 col-lg-3 d-flex gap-2">
            <button type="submit" class="btn btn-success w-100">Filtrer</button>
            <a href="{{ route('admin.candidatures.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
            <a href="{{ route('admin.candidatures.export.csv', request()->query()) }}" class="btn btn-outline-success">Exporter CSV</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th><a href="{{ $sortUrl('nom') }}" class="text-decoration-none text-body">{{ $sortLabel('Candidat', 'nom') }}</a></th>
                    <th><a href="{{ $sortUrl('domaine') }}" class="text-decoration-none text-body">{{ $sortLabel('Domaine', 'domaine') }}</a></th>
                    <th><a href="{{ $sortUrl('experience') }}" class="text-decoration-none text-body">{{ $sortLabel('Expérience', 'experience') }}</a></th>
                    <th><a href="{{ $sortUrl('status') }}" class="text-decoration-none text-body">{{ $sortLabel('Statut', 'status') }}</a></th>
                    <th><a href="{{ $sortUrl('created_at') }}" class="text-decoration-none text-body">{{ $sortLabel('Date', 'created_at') }}</a></th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidatures as $candidature)
                    @php
                        $statusClass = match($candidature->status) {
                            'new' => 'text-bg-warning',
                            'reviewed' => 'text-bg-info',
                            'shortlisted' => 'text-bg-success',
                            'rejected' => 'text-bg-danger',
                            default => 'text-bg-secondary',
                        };
                    @endphp
                    <tr>
                        <td>{{ $candidature->prenom }} {{ $candidature->nom }}</td>
                        <td>{{ $candidature->domaine }}</td>
                        <td>{{ $candidature->experience }}</td>
                        <td><span class="badge {{ $statusClass }}">{{ $candidature->status }}</span></td>
                        <td>{{ $candidature->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            @if(in_array($candidature->status, ['new', 'reviewed'], true))
                                <form action="{{ route('admin.candidatures.update', $candidature) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="shortlisted">
                                    <button type="submit" class="btn btn-sm btn-success">Traiter</button>
                                </form>
                            @endif
                            <a href="{{ route('admin.candidatures.show', $candidature) }}" class="btn btn-sm btn-outline-primary">Ouvrir</a>
                            <form action="{{ route('admin.candidatures.destroy', $candidature) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette candidature ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted">Aucune candidature reçue.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $candidatures->links() }}</div>
</div>
@endsection
