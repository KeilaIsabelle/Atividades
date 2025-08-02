<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Author;

class AuthorPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function view(User $user, Author $author): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function update(User $user, Author $author): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function delete(User $user, Author $author): bool
    {
        return $user->role === 'admin';
    }
}
