<?php

namespace App\Policies;

use App\Http\Models\Book;
use App\Http\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\UserRole;


class BookPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Book $book)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->can('Create') && $user->role_id === UserRole::Author;
    }

    public function update(User $user, Book $book)
    {
        return $user->can('Edit') && $user->id === $book->user_id;
    }

    public function delete(User $user, Book $book)
    {
        return $user->can('Delete') && $user->id === $book->user_id;
    }
}
