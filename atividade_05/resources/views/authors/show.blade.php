@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes da Editora</h1>

    <div class="mb-3">
        <strong>Nome:</strong> {{ $publisher->name }}
    </div>

    <a href="{{ route('publishers.edit', $publisher) }}" class="btn btn-primary">Editar</a>
    <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
