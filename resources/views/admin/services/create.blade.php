@extends('admin.layouts.app')

@section('title', 'Nouveau service')
@section('page-title', 'Nouveau service')

@section('content')
<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="d-grid gap-4">
    @csrf
    @include('admin.services._form')
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Creer le service</button>
    </div>
</form>
@endsection