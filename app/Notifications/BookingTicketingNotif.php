<?php

namespace App\Notifications;

use App\Mail\TicketingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingTicketingNotif extends Notification
{
    use Queueable;

    public $booking;
    public $bookingTicketing;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking, $bookingTicketing)
    {
        $this->booking = $booking;
        $this->bookingTicketing = $bookingTicketing;
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
        return (new TicketingMail($notifiable, $this->booking, $this->bookingTicketing))
            ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
