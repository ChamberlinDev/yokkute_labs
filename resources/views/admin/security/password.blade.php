@extends('admin.layouts.app')

@section('title', 'Sécurité du mot de passe')
@section('page-title', 'Sécurité du mot de passe')

@section('content')
<div class="card card-soft p-4 mb-4">
    <h2 class="h5 mb-3">Politique du mot de passe admin</h2>
    <ul class="mb-0">
        <li>12 caractères minimum, avec majuscule, minuscule, chiffre et symbole.</li>
        <li>Rotation obligatoire tous les {{ $passwordMaxAgeDays }} jours.</li>
        <li>Le mot de passe ne doit pas être compromis ni identique à l'ancien.</li>
    </ul>
</div>

<div class="card card-soft p-4">
    <div class="mb-3 text-muted">
        @if($passwordAgeDays !== null)
            Âge du mot de passe actuel : {{ $passwordAgeDays }} jour(s).
        @else
            Aucun historique de rotation enregistré pour ce compte.
        @endif
        @if($mustRotate)
            <div class="text-danger mt-2">Rotation forcée active : changez le mot de passe maintenant.</div>
        @endif
    </div>

    <form method="POST" action="{{ route('admin.security.password.update') }}" class="d-grid gap-3">
        @csrf
        @method('PUT')

        <div>
            <label class="form-label">Mot de passe actuel</label>
            <input type="password" name="current_password" class="form-control" autocomplete="current-password" required>
        </div>

        <div>
            <label class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" class="form-control" autocomplete="new-password" required>
        </div>

        <div>
            <label class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" required>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-success" type="submit">Mettre à jour</button>
            <a class="btn btn-outline-secondary" href="{{ route('admin.dashboard') }}">Retour</a>
        </div>
    </form>
</div>
@endsection
