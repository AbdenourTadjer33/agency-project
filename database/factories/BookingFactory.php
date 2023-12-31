<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_uuid' => User::where('role', 'client')->get()->random()->uuid,
            'ref' => Booking::randomId(),
            'type' => 'ticketing',
            'date_departure' =>  date_format(fake()->dateTimeBetween('-3 year', '+1 year'), 'Y-m-d'),
            'date_return' =>  date_format(fake()->dateTimeBetween('now', '+1 year'), 'Y-m-d'),
            'status' => null,
            'number_adult' => 1,
            'number_child' => 0,
            'number_baby' => 0,
            'beneficiaries' => json_encode([
                'adult' => [['fname' => fake()->firstName(), 'lname' => fake()->lastName(), 'dob' => fake()->date(), 'passport_id' =>  rand(1000000000, 9999999999)]],
                'child' => null,
                'baby' => null,
            ]),
            'status' => rand(0,1) ? 'non-validé' : 'validé' ,
            'observation' => fake()->sentence(),
            'is_payed' => false,
            'is_online' => 1,
            'price' => null,
        ];
    }
}
