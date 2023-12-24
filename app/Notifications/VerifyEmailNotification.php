<?php

namespace App\Notifications;

use App\Mail\VerificationMail;
use App\Models\VerificationCode;
use App\Traits\RandomVerificationCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class VerifyEmailNotification extends Notification implements ShouldQueue
{
    use Queueable, RandomVerificationCode;
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

        $code = $this->generate(); // verification code

        VerificationCode::create([
            'user_uuid' => $notifiable->uuid,
            'code' => $code,
            'type' => 'email',
            'created_at' => now(),
            'invalidated_at' => now()->addHour()
        ]);
        return (new VerificationMail($notifiable, $code))
            ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
