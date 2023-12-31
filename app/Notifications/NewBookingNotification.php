<?php

namespace App\Notifications;

use App\Mail\NewBookingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;
    public $user;
    public $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $booking)
    {
        $this->user = $user;
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_uuid' => $this->booking->user_uuid,
            'ref' => $this->booking->ref,
            'type' => $this->booking->type,
            'booked_at' => $this->booking->created_at,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
        ];
    }
}
