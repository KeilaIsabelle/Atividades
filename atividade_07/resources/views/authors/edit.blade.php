@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Editora</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('publishers.update', $publisher) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome da Editora</label>
            <input type="text" name="name" id="name" value="{{ $publisher->name }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
