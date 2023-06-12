<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Demographic;
use App\Models\Event;
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

        $createDemographic = function (string $name) use ($me) {
            return Demographic::factory()
                ->for($me->currentTeam)
                ->createQuietly([
                    'name' => $name,
                ]);
        };

        $coreDemographics = collect(['Contact', 'New Person', 'Adherent', 'Member', 'Child'])
            ->map($createDemographic);
        $otherDemographics = collect(['Volunteer', 'Extra Care'])
            ->map($createDemographic);

        $people = $coreDemographics->map(function (Demographic $demographic) use ($me, $otherDemographics) {
            return Person::factory()
                ->for($me->currentTeam)
                ->for($demographic, 'mainDemographic')
                ->hasAttached($otherDemographics->random(), [], 'otherDemographics')
                ->count(200)
                ->createQuietly();
        })->flatten();

        collect()->range(1, 50)->each(function () use ($me, $people) {
            Event::factory()
                ->for($me->currentTeam)
                ->hasAttached($people->random(120))
                ->createOneQuietly();
        });
    }
}
