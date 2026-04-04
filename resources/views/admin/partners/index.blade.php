@extends('admin.layouts.app')

@section('title', 'Partenaires')
@section('page-title', 'Partenaires')

@section('content')
<div class="card card-soft p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h5 mb-1">Nos partenaires</h2>
            <p class="text-muted mb-0">Gérez les logos affichés dans la section partenaires (Accueil &amp; Qui sommes-nous).</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-success">Ajouter un partenaire</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Nom</th>
                    <th>Site web</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                    <tr>
                        <td>{{ $partner->order_column }}</td>
                        <td>
                            @if($partner->logo_path)
                                <img src="{{ asset($partner->logo_path) }}"
                                     alt="{{ $partner->name }}"
                                     style="width:80px;height:48px;object-fit:contain;border:1px solid #e4eae6;border-radius:8px;background:#fff;padding:4px;">
                            @else
                                <div style="width:80px;height:48px;border:1px solid #e4eae6;border-radius:8px;background:#f5f7fa;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $partner->name }}</td>
                        <td>
                            @if($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="text-muted small">
                                    {{ $partner->website_url }}
                                </a>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $partner->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ $partner->is_active ? 'Visible' : 'Masqué' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary" title="Modifier" aria-label="Modifier">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" aria-label="Supprimer"
                                        onclick="return confirm('Supprimer ce partenaire ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted">Aucun partenaire enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
