<?php

namespace App\Providers;

use App\Events\NewBooking;
use App\Events\BookingTrip;
use App\Events\BookingHotel;
use App\Events\BookingTicketing;

// use Illuminate\Auth\Events\Registered;
// use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Events\RegistrationEvent;
use App\Listeners\NewBookingListener;
use Illuminate\Support\Facades\Event;
use App\Listeners\BookingTripListener;
use App\Listeners\BookingHotelListener;
use App\Listeners\BookingTicketingListener;
use App\Listeners\SendEmailVerificationNotif;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Registered::class => [
            // SendEmailVerificationNotification::class,
        // ],
        RegistrationEvent::class => [
            SendEmailVerificationNotif::class,
        ],
        NewBooking::class => [
            NewBookingListener::class,
        ],
        BookingTicketing::class => [
            BookingTicketingListener::class,
        ],

        BookingTrip::class => [
            BookingTripListener::class,
        ],

        BookingHotel::class => [
            BookingHotelListener::class,
        ],


    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
