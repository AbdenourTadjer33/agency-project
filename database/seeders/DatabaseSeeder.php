<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(100)->create();
        // \App\Models\Hotel::factory(100)->create();
        // case of ticketing book
        $bookings = \App\Models\Booking::factory(200)->create();
        foreach ($bookings as $booking) {
            DB::table('booking_ticketings')->insert([
                'booking_id' => $booking->id,
                'flight_type' => 'AR',
                'airport_departure' => fake()->city(),
                'airport_arrived' => fake()->city(),
                'compagnie' => 'air algérie',
                'class' => "Pas de préférence",
            ]);
        }
    }
}
