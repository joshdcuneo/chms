<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Study;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Study>
 */
class StudyFactory extends Factory
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
            'author_id' => Person::factory(),
            'document_file_url' => $this->faker->url
        ];
    }
}
