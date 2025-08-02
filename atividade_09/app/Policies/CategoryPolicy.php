<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function view(User $user, Category $category): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function update(User $user, Category $category): bool
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->role === 'admin';
    }
}
