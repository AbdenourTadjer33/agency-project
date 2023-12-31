<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'slug' => fake()->slug(2),
            'description' => fake()->sentence(10),
            'country' => fake()->country(),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'coordinates' => json_encode(['phone' => "0500000000", 'email' => fake()->unique()->safeEmail()]),
            'classification' => rand(1, 5),
            'number_rooms' => rand(20, 100),
            'services' => json_encode([]),
            'assets' => json_encode([]),
        ];
    }
}
