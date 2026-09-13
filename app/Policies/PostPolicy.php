<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
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

    public function update(...$arguments): bool
    {
        return true;
    }

    public function delete(...$arguments): bool
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
