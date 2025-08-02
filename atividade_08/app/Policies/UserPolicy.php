<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
{
    return $user->role === 'admin';
}

public function view(User $user, User $model): bool
{
    return $user->role === 'admin';
}

public function create(User $user): bool
{
    return $user->role === 'admin';
}

public function update(User $user, User $model): bool
{
    // Pode ser que admins possam editar qualquer usuário
    // Ou pode implementar lógica para só editar se for ele mesmo ou admin
    return $user->role === 'admin';
}

public function delete(User $user, User $model): bool
{
    return $user->role === 'admin';
}

public function updateRole(User $authUser)
{
    return $authUser->role === 'admin';
}


}
