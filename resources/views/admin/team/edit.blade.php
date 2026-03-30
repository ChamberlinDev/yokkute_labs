@extends('admin.layouts.app')

@section('title', 'Modifier membre')
@section('page-title', 'Modifier membre')

@section('content')
<form action="{{ route('admin.team.update', $member) }}" method="POST" enctype="multipart/form-data" class="d-grid gap-4">
    @csrf
    @method('PUT')
    @include('admin.team._form')
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </div>
</form>
@endsection