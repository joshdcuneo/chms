<?php

namespace Tests\Feature;

use App\Filament\Resources\TalkResource;
use App\Models\Talk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListTalksTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->withPersonalTeam()->createOne());
    }

    public function test_page_can_be_rendered(): void
    {
        $this->get(TalkResource::getUrl('index'))->assertSuccessful();
    }

    public function test_upcoming_talks_are_listed_by_default(): void
    {
        $talks = Talk::factory()->count(10)->create();

        LiveWire::test(TalkResource\Pages\ListTalks::class)
            ->assertCanSeeTableRecords($talks);
    }

    public function test_only_the_current_teams_talks_are_listed(): void
    {
        $talks = Talk::factory()->count(10)->create();

        LiveWire::test(TalkResource\Pages\ListTalks::class)
            ->assertCanSeeTableRecords($talks);

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        LiveWire::test(TalkResource\Pages\ListTalks::class)
            ->assertCanNotSeeTableRecords($talks);
    }
}
