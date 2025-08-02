@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Livro</h1>

    @if($errors->has('book_unavailable'))
    <div class="alert alert-danger my-3">
        {{ $errors->first('book_unavailable') }}
    </div>
    @endif

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

    <!-- Formulário de Empréstimo -->
    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'bibliotecario')
        <div class="card mb-4">
            <div class="card-header">
                <strong>Registrar Empréstimo</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="user_id">Selecionar Usuário</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">-- Selecione um usuário --</option>
                            @foreach (\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="bi bi-book"></i> Fazer Empréstimo
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Botão de Voltar -->
    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>

    <!-- Histórico de Empréstimos -->
    <h3 class="mt-5">Histórico de Empréstimos</h3>

    @if($book->borrowings->isEmpty())
        <p>Este livro ainda não foi emprestado.</p>
    @else
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                </tr>
            </thead>
            <tbody>
                @foreach($book->borrowings as $borrowing)
                    <tr>
                        <td>{{ $borrowing->user->name }}</td>
                        <td>{{ $borrowing->borrowed_at }}</td>
                        <td>{{ $borrowing->returned_at ?? 'Em Aberto' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
