@extends('admin.layouts.app')

@section('title', 'Nouveau membre')
@section('page-title', 'Nouveau membre')

@section('content')
<form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="d-grid gap-4">
    @csrf
    @include('admin.team._form')
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Ajouter le membre</button>
    </div>
</form>
@endsection