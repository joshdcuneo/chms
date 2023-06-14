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
use Illuminate\Support\Facades\Auth;

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

        Auth::setUser($me);

        $coreDemographics = collect(['Contact', 'New Person', 'Adherent', 'Member', 'Child'])
            ->map(function (string $name) use ($me) {
                return CoreDemographic::factory()->create(['name' => $name,]);
            });

        $otherDemographics = collect(['Volunteer', 'Extra Care'])
            ->map(function (string $name) use ($me) {
                return OtherDemographic::factory()->create([ 'name' => $name,]);
            });

        $people = Person::factory()
            ->sequence(fn() => ['core_demographic_id' => $coreDemographics->random()])
            ->count(random_int(1000, 2000))
            ->create();

        $people->random(random_int(30, 80))->each(fn(Person $person) => $person->otherDemographics()->attach($otherDemographics->random()));

        Event::factory()
            ->count(random_int(30, 80))
            ->create()
            ->each(function (Event $event) use ($people) {
                $event->people()->attach($people->random(random_int(20, 240)));
            });

        $series = Series::factory()->count(random_int(4, 40))->create();

        $series->each(function (Series $series) use ($me) {
            Talk::factory()->count(random_int(3, 15))->for($series)->create();
            Study::factory()->count(random_int(1, 10))->for($series)->create();
        });
    }
}
