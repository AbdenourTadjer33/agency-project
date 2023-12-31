<?php

namespace App\Listeners;

use App\Events\BookingTrip;
use App\Notifications\BookingTripNotif;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class BookingTripListener implements ShouldQueue
{

    /**
     * Handle the event.
     */
    public function handle(BookingTrip $event): void
    {
        Notification::sendNow($event->user, New BookingTripNotif($event->booking, $event->bookingTrip));
    }
}
