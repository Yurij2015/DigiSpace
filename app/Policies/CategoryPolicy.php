<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(...$arguments): bool
    {
        return true;
    }

    public function view(...$arguments): bool
    {
        return true;
    }

    public function create(...$arguments): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function categoryUpdate(User $user, Category $category): Response|bool
    {
        return $category->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function categoryDestroy(User $user, Category $category): bool
    {
        return $category->user()->is($user);
    }

    public function update(User $user, Category $category): bool
    {
        return true;
    }

    public function delete(User $user, Category $category): bool
    {
        return true;
    }

    public function restore(...$arguments): bool
    {
        return true;
    }

    public function forceDelete(...$arguments): bool
    {
        return true;
    }
}
