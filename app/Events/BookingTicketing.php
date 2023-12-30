<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingTicketing
{
    use Dispatchable, SerializesModels;

    public $user;
    public $booking;
    public $bookingTicketing;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $booking, $bookingTicketing)
    {
        $this->user = $user;
        $this->booking = $booking;
        $this->bookingTicketing = $bookingTicketing;
    }
}
