@extends('admin.layouts.app')

@section('title', 'Ajouter un partenaire')
@section('page-title', 'Ajouter un partenaire')

@section('content')
<form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.partners._form')
    <div class="mt-4">
        <button type="submit" class="btn btn-success px-4">Enregistrer</button>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
    </div>
</form>
@endsection
