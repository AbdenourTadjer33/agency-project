<?php

namespace App\Listeners;

use App\Events\NewBooking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBookingNotification;
use App\Models\User;

class NewBookingListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    public $admins;
    public function __construct()
    {
        $this->admins = User::where('role', 'admin')->get();
    }

    /**
     * Handle the event.
     */
    public function handle(NewBooking $event): void
    {
        Notification::sendNow($this->admins, new NewBookingNotification($event->user, $event->booking));
    }
}
