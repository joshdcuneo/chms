<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
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
            'start' => Date::create($this->faker->dateTimeThisDecade),
            'end' => function (array $attrs) {
                return $this->faker->dateTimeBetween(
                    $attrs['start']->addHour(),
                    $attrs['start']->addDay()
                );
            },
        ];
    }
}
