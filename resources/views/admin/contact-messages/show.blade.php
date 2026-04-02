@extends('admin.layouts.app')

@section('title', 'Message de contact')
@section('page-title', 'Message de contact')

@section('content')
<div class="row g-4">
    <div class="col-xl-8">
        <div class="card card-soft p-4">
            <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <h2 class="h4 mb-1">{{ $message->prenom }} {{ $message->nom }}</h2>
                    <p class="text-muted mb-0">{{ $message->email }} @if($message->whatsapp) &middot; {{ $message->whatsapp }} @endif</p>
                </div>
                <span class="badge text-bg-secondary">{{ $message->status }}</span>
            </div>
            <dl class="row mb-4">
                <dt class="col-sm-3">Entreprise</dt><dd class="col-sm-9">{{ $message->entreprise ?: 'Non renseignée' }}</dd>
                <dt class="col-sm-3">Besoin</dt><dd class="col-sm-9">{{ $message->besoin }}</dd>
                <dt class="col-sm-3">Orientation</dt><dd class="col-sm-9">{{ $message->orientation_requested ? 'Oui' : 'Non' }}</dd>
            </dl>
            <div class="p-4 rounded-4 bg-light" style="white-space:pre-line;">{{ $message->message }}</div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-soft p-4 d-grid gap-3">
            <form action="{{ route('admin.contact-messages.update', $message) }}" method="POST" class="d-grid gap-3">
                @csrf
                @method('PATCH')
                <div>
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select">
                        @foreach(['new', 'in_progress', 'done', 'archived'] as $status)
                            <option value="{{ $status }}" @selected($message->status === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </form>
            <a href="mailto:{{ $message->email }}" class="btn btn-outline-secondary">Répondre par email</a>
            <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger w-100">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
