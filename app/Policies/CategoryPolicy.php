<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
    }

    public function view(User $user, Category $category): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
    }

    public function create(User $user): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
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

    /**
     * Control panel (Filament): anyone admitted to the panel edits any record. The legacy
     * Inertia admin keeps the author-only categoryUpdate/categoryDestroy abilities below.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
    }

    public function restore(User $user, Category $category): bool
    {
        return false;
    }

    public function forceDelete(User $user, Category $category): bool
    {
        return false;
    }
}
