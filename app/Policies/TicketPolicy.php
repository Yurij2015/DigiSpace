<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return Response|bool
     */
    public function view(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return Response|bool
     */
    public function update(User $user, Ticket $ticket): Response|bool
    {
        return $ticket->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return Response|bool
     */
    public function delete(User $user, Ticket $ticket): Response|bool
    {
        return $this->update($user, $ticket);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return Response|bool
     */
    public function restore(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return Response|bool
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        //
    }
}
