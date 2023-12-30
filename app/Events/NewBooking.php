<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewBooking
{
    use SerializesModels;

    public $user;
    public $booking;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $booking)
    {
        $this->user = $user;
        $this->booking = $booking;
    }

}
