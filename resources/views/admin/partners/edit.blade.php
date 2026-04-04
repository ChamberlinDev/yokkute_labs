@extends('admin.layouts.app')

@section('title', 'Modifier ' . $partner->name)
@section('page-title', 'Modifier ' . $partner->name)

@section('content')
<form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.partners._form')
    <div class="mt-4">
        <button type="submit" class="btn btn-success px-4">Enregistrer les modifications</button>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
    </div>
</form>
@endsection
