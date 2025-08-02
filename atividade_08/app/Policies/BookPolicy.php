<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    /**
     * Determine whether the user can view any books.
     */
    public function viewAny(User $user): bool
    {
        // Todos podem ver lista de livros
        return in_array($user->role, ['admin', 'bibliotecario', 'cliente']);
    }

    /**
     * Determine whether the user can view the book.
     */
    public function view(User $user, Book $book): bool
    {
        // Todos podem ver livros
        return in_array($user->role, ['admin', 'bibliotecario', 'cliente']);
    }

    /**
     * Determine whether the user can create books.
     */
    public function create(User $user): bool
    {
        // Apenas admin e bibliotecario podem criar
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    /**
     * Determine whether the user can update the book.
     */
    public function update(User $user, Book $book): bool
    {
        // Apenas admin e bibliotecario podem editar
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    /**
     * Determine whether the user can delete the book.
     */
    public function delete(User $user, Book $book): bool
    {
        // Apenas admin pode deletar
        return $user->role === 'admin';
    }
}
