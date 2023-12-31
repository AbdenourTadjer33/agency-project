<?php

namespace App\Notifications;

use App\Mail\TripMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingTripNotif extends Notification
{
    use Queueable;


    public $booking; 
    public $bookingTrip;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking, $bookingTrip)
    {
        $this->booking = $booking;
        $this->bookingTrip = $bookingTrip;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        return (new TripMail($notifiable, $this->booking, $this->bookingTrip))
            ->to($notifiable->email);
    }
}
