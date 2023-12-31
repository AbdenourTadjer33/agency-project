<?php

namespace App\Listeners;

use App\Events\BookingHotel;
use App\Notifications\BookingHotelNotif;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class BookingHotelListener implements ShouldQueue
{

    public function handle(BookingHotel $event): void
    {
        Notification::sendNow($event->user, new BookingHotelNotif($event->booking, $event->bookingHotel));
    }
}
