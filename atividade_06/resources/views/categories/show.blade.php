@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Autor</h1>

    <div class="mb-3">
        <strong>Nome:</strong> {{ $author->name }}
    </div>
    <div class="mb-3">
        <strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($author->birth_date)->format('d/m/Y') }}
    </div>

    <a href="{{ route('authors.edit', $author) }}" class="btn btn-primary">Editar</a>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
