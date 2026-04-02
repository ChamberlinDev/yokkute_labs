@extends('admin.layouts.app')

@section('title', 'Candidature')
@section('page-title', 'Candidature')

@section('content')
<div class="row g-4">
    <div class="col-xl-8">
        <div class="card card-soft p-4">
            <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <h2 class="h4 mb-1">{{ $candidature->prenom }} {{ $candidature->nom }}</h2>
                    <p class="text-muted mb-0">{{ $candidature->email }} @if($candidature->telephone) &middot; {{ $candidature->telephone }} @endif</p>
                </div>
                <span class="badge text-bg-secondary">{{ $candidature->status }}</span>
            </div>
            <dl class="row mb-4">
                <dt class="col-sm-3">Domaine</dt><dd class="col-sm-9">{{ $candidature->domaine }}</dd>
                <dt class="col-sm-3">Expérience</dt><dd class="col-sm-9">{{ $candidature->experience }}</dd>
                <dt class="col-sm-3">Portfolio</dt><dd class="col-sm-9">{{ $candidature->portfolio ?: 'Non renseigné' }}</dd>
                <dt class="col-sm-3">CV</dt><dd class="col-sm-9">@if($candidature->cv_path)<a href="{{ route('admin.candidatures.cv.download', $candidature) }}">Télécharger le CV</a>@else Aucun fichier @endif</dd>
            </dl>
            <div class="p-4 rounded-4 bg-light" style="white-space:pre-line;">{{ $candidature->message }}</div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-soft p-4 d-grid gap-3">
            <form action="{{ route('admin.candidatures.update', $candidature) }}" method="POST" class="d-grid gap-3">
                @csrf
                @method('PATCH')
                <div>
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select">
                        @foreach(['new', 'reviewed', 'shortlisted', 'rejected', 'archived'] as $status)
                            <option value="{{ $status }}" @selected($candidature->status === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </form>
            <a href="mailto:{{ $candidature->email }}" class="btn btn-outline-secondary">Contacter le candidat</a>
            <form action="{{ route('admin.candidatures.destroy', $candidature) }}" method="POST" onsubmit="return confirm('Supprimer cette candidature ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger w-100">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
