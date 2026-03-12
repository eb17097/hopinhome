<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->numberBetween(1000, 100000),
            'property_type' => $this->faker->randomElement(['Apartment', 'Villa', 'House']),
            'address' => $this->faker->address(),
            'description' => $this->faker->paragraph(),
            'bedrooms' => $this->faker->randomElement(['Studio', '1', '2', '3']),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'status' => 'Active',
        ];
    }
}
