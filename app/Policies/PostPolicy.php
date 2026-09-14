<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
    }

    public function view(User $user, Post $post): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
    }

    public function create(User $user): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control'));
    }

    public function update(User $user, Post $post): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control')) && (int) $post->user_id === (int) $user->id;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->canAccessPanel(Filament::getPanel('control')) && (int) $post->user_id === (int) $user->id;
    }

    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function postUpdate(User $user, Post $post): Response|bool
    {
        return $post->user()->is($user);
    }

    /**
     * Determine whether the user can destroy the model.
     */
    public function postDestroy(User $user, Post $post): Response|bool
    {
        return $post->user()->is($user);
    }
}
