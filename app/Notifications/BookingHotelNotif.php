<?php

namespace App\Notifications;

use App\Mail\HotelMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingHotelNotif extends Notification
{
    use Queueable;

    public $booking;
    public $bookingHotel;
    /**
     * Create a new notification instance.
     */
    public function __construct($booking, $bookingHotel)
    {
        $this->booking = $booking;
        $this->bookingHotel= $bookingHotel;
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
        return (new HotelMail($notifiable, $this->booking, $this->bookingHotel))
            ->to($notifiable->email, $notifiable->first_name . ' ' . $notifiable->last_name);
    }
}
