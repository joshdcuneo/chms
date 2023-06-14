<?php

namespace Database\Factories;

use App\Models\CoreDemographic;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'phone' => $this->faker->phoneNumber,
            'core_demographic_id' => function () {
                $coreDemographics = CoreDemographic::get();
                return $coreDemographics->isEmpty() ? CoreDemographic::factory()->create()->id : $coreDemographics->random()->id;
            }
        ];
    }
}
