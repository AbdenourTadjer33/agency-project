<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TripMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $booking;
    public $bookingTrip;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $booking, $bookingTrip)
    {
        $this->user = $user;
        $this->booking = $booking;
        $this->bookingTrip = $bookingTrip;
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
            view: 'email.trip-booking-email',
            with: [
                'user' => $this->user,
                'booking' => $this->booking,
                'bookingTrip' => $this->bookingTrip,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
