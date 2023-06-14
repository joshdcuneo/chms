<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Talk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Talk>
 */
class TalkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'speaker_id' => Person::factory(),
            'audio_file_url' => $this->faker->url
        ];
    }
}
