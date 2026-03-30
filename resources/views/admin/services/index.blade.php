@extends('admin.layouts.app')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="card card-soft p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h5 mb-1">Catalogue des services</h2>
            <p class="text-muted mb-0">Ajoutez, modifiez et publiez les cartes visibles sur la page publique.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-success">Nouveau service</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr><th>#</th><th>Titre</th><th>Badge</th><th>Publication</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>{{ $service->order_column }}</td>
                        <td>
                            <div class="fw-semibold">{{ $service->title }}</div>
                            <div class="text-muted small">{{ $service->icon }}</div>
                        </td>
                        <td>{{ $service->badge ?: 'Sans badge' }}</td>
                        <td><span class="badge {{ $service->is_published ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $service->is_published ? 'En ligne' : 'Brouillon' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary" title="Modifier" aria-label="Modifier">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" aria-label="Supprimer" onclick="return confirm('Supprimer ce service ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-muted">Aucun service enregistre.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection