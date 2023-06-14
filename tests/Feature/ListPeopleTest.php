<?php

namespace Tests\Feature;

use App\Filament\Resources\PersonResource;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListPeopleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->withPersonalTeam()->createOne());
    }

    public function test_page_can_be_rendered(): void
    {
        $this->get(PersonResource::getUrl('index'))->assertSuccessful();
    }

    public function test_people_are_listed(): void
    {
        $events = Person::factory()->count(10)->create();

        LiveWire::test(PersonResource\Pages\ListPeople::class)
            ->assertCanSeeTableRecords($events);
    }

    public function test_only_the_current_teams_people_are_listed(): void
    {
        $events = Person::factory()->count(10)->create();

        LiveWire::test(PersonResource\Pages\ListPeople::class)
            ->assertCanSeeTableRecords($events);

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        LiveWire::test(PersonResource\Pages\ListPeople::class)
            ->assertCanNotSeeTableRecords($events);
    }
}
