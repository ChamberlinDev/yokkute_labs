@extends('admin.layouts.app')

@section('title', 'Modifier service')
@section('page-title', 'Modifier service')

@section('content')
<form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="d-grid gap-4">
    @csrf
    @method('PUT')
    @include('admin.services._form')
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </div>
</form>
@endsection