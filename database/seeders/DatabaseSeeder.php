<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CoreDemographic;
use App\Models\Event;
use App\Models\OtherDemographic;
use App\Models\Person;
use App\Models\User;
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

        $coreDemographics = collect(['Contact', 'New Person', 'Adherent', 'Member', 'Child'])
            ->map(function (string $name) use ($me) {
                return CoreDemographic::factory()
                    ->for($me->currentTeam)
                    ->createQuietly([
                        'name' => $name,
                    ]);
            });

        $otherDemographics = collect(['Volunteer', 'Extra Care'])
            ->map(function (string $name) use ($me) {
                return OtherDemographic::factory()
                    ->for($me->currentTeam)
                    ->createQuietly([
                        'name' => $name,
                    ]);
            });

        $people = Person::factory()
            ->for($me->currentTeam)
            ->sequence(fn () => ['core_demographic_id' => $coreDemographics->random()])
            ->count(random_int(1000, 2000))
            ->createQuietly();

        $people->random(random_int(30, 80))->each(fn (Person $person) => $person->otherDemographics()->attach($otherDemographics->random()));

        Event::factory()
            ->for($me->currentTeam)
            ->count(random_int(30, 80))
            ->createQuietly()
            ->each(function (Event $event) use ($people) {
                $event->people()->attach($people->random(random_int(20, 240)));
            });
    }
}
