<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Models\User;
use App\Notifications\NewTicket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTicketCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TicketCreated $event
     * @return void
     */
    public function handle(TicketCreated $event): void
    {
        foreach ((new User)->whereNot('id', $event->ticket->user_id)->cursor() as $user) {
            $user->notify(new NewTicket($event->ticket));
        }
    }
}
