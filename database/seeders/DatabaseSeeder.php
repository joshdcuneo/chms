<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CoreDemographic;
use App\Models\Event;
use App\Models\OtherDemographic;
use App\Models\Person;
use App\Models\Series;
use App\Models\Study;
use App\Models\Talk;
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

        User::factory()
            ->withPersonalTeam()
            ->create([
                'name' => 'Amy Cuneo',
                'email' => 'amy@critical.codes',
            ]);

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
            ->sequence(fn() => ['core_demographic_id' => $coreDemographics->random()])
            ->count(random_int(1000, 2000))
            ->createQuietly();

        $people->random(random_int(30, 80))->each(fn(Person $person) => $person->otherDemographics()->attach($otherDemographics->random()));

        Event::factory()
            ->for($me->currentTeam)
            ->count(random_int(30, 80))
            ->createQuietly()
            ->each(function (Event $event) use ($people) {
                $event->people()->attach($people->random(random_int(20, 240)));
            });

        $series = Series::factory()
            ->for($me->currentTeam)
            ->count(random_int(4, 40))
            ->createQuietly();

        $series->each(function (Series $series) use ($me) {
            Talk::factory()->count(random_int(3, 15))->for($me->currentTeam)->for($series)->createQuietly();
            Study::factory()->count(random_int(1, 10))->for($me->currentTeam)->for($series)->createQuietly();
        });
    }
}
