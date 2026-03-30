@extends('admin.layouts.app')

@section('title', 'Equipe')
@section('page-title', 'Equipe')

@section('content')
<div class="card card-soft p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h5 mb-1">Membres de l'equipe</h2>
            <p class="text-muted mb-0">Gerez les profils affiches dans la section equipe.</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="btn btn-success">Ajouter un membre</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>#</th><th>Membre</th><th>Role</th><th>Statut</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>{{ $member->order_column }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset($member->image_path ?: 'images/img2.jpeg') }}" alt="{{ $member->name }}" style="width:48px;height:48px;object-fit:cover;border-radius:999px;">
                                <div>
                                    <div class="fw-semibold">{{ $member->name }}</div>
                                    <div class="text-muted small">{{ $member->linkedin_url ?: 'Sans lien LinkedIn' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $member->role }}</td>
                        <td><span class="badge {{ $member->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $member->is_active ? 'Visible' : 'Masque' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-sm btn-outline-primary" title="Modifier" aria-label="Modifier">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" aria-label="Supprimer" onclick="return confirm('Supprimer ce profil ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-muted">Aucun membre enregistre.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection