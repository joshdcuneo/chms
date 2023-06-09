<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)
            ->withPersonalTeam()
            ->create();

        $me = User::factory()
            ->withPersonalTeam()
            ->create([
                'name' => 'Josh Cuneo',
                'email' => 'josh@critical.codes',
            ]);

        $people = Person::factory()
            ->for($me->currentTeam)
            ->count(1000)
            ->createQuietly();

        $events = Event::factory()
            ->for($me->currentTeam)
            ->count(200)
            ->createQuietly();

        Attendance::factory()
            ->for($me->currentTeam)
            ->state(new Sequence(
                fn(Sequence $sequence) => [
                    'event_id' => $events->random(),
                    'person_id' => $people->random(),
                ],
            ))
            ->count(10000)
            ->createQuietly();

    }
}
