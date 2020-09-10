<?php

namespace App\Policies;

use App\Http\Models\User;
use App\Http\Models\Role;
use App\Enums\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->can('Edit Permission') && $user->role_id === UserRole::Administrator;
    }

    public function update(User $user, Role $role)
    {
        return $user->can('Edit Permission') && $user->role_id === UserRole::Administrator;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Http\Models\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        return $user->can('Edit Permission') && $user->role_id === UserRole::Administrator;
    }
}
