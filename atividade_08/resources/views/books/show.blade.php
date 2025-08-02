@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Livro</h1>

    <div class="card mb-3">
        <div class="card-header d-flex align-items-center">
            <strong>Título:</strong> {{ $book->title }}

            <!-- Imagem da capa, ao lado do título -->
            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('storage/covers/default.png') }}" 
                 alt="Capa do livro" 
                 style="max-height: 100px; margin-left: 15px; border-radius: 5px;">
        </div>

        <div class="card-body">
            <p><strong>Autor:</strong>
                <a href="{{ route('authors.show', $book->author->id) }}">
                    {{ $book->author->name }}
                </a>
            </p>
            <p><strong>Editora:</strong>
                <a href="{{ route('publishers.show', $book->publisher->id) }}">
                    {{ $book->publisher->name }}
                </a>
            </p>
            <p><strong>Categoria:</strong>
                <a href="{{ route('categories.show', $book->category->id) }}">
                    {{ $book->category->name }}
                </a>
            </p>
        </div>
    </div>

    <!-- resto do código permanece igual -->
    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>


<!-- continua seu formulário de empréstimos e histórico -->

@endsection
