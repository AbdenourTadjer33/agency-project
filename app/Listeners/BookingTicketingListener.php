<?php

namespace App\Listeners;

use App\Events\BookingTicketing;
use App\Notifications\BookingTicketingNotif;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class BookingTicketingListener implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(BookingTicketing $event): void
    {
        Notification::sendNow($event->user, new BookingTicketingNotif($event->booking, $event->bookingTicketing));
    }
}
