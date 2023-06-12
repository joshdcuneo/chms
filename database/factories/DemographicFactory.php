<?php

namespace Database\Factories;

use App\Models\Demographic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Demographic>
 */
class DemographicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
