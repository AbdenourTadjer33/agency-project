<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HotelMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $booking;
    public $bookingHotel;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $booking, $bookingHotel)
    {
        $this->user = $user;
        $this->booking = $booking;
        $this->bookingHotel = $bookingHotel;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande de réservation' . $this->booking->ref . 'prise en charge',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.hotel-booking-email',
            with: [
                'user' => $this->user,
                'booking' => $this->booking,
                'bookingHotel' => $this->bookingHotel 
            ]
        );
    }
}
