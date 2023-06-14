<?php

namespace Tests\Feature;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListEventsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->withPersonalTeam()->createOne());
    }

    public function test_page_can_be_rendered(): void
    {
        $this->get(EventResource::getUrl('index'))->assertSuccessful();
    }

    public function test_upcoming_events_are_listed_by_default(): void
    {
        $events = Event::factory()->count(10)->upcoming()->create();

        LiveWire::test(EventResource\Pages\ListEvents::class)
            ->assertCanSeeTableRecords($events);
    }

    public function test_only_the_current_teams_events_are_listed(): void
    {
        $events = Event::factory()->count(10)->upcoming()->create();

        LiveWire::test(EventResource\Pages\ListEvents::class)
            ->assertCanSeeTableRecords($events);

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        LiveWire::test(EventResource\Pages\ListEvents::class)
            ->assertCanNotSeeTableRecords($events);
    }
}
