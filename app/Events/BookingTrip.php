<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingTrip
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $booking;
    public $bookingTrip;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $booking, $bookingTrip)
    {   
        $this->user = $user;
        $this->booking = $booking;
        $this->bookingTrip = $bookingTrip;
    }
}
