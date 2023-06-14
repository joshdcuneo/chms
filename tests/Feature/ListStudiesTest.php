<?php

namespace Tests\Feature;

use App\Filament\Resources\StudyResource;
use App\Models\Study;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListStudiesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->withPersonalTeam()->createOne());
    }

    public function test_page_can_be_rendered(): void
    {
        $this->get(StudyResource::getUrl('index'))->assertSuccessful();
    }

    public function test_upcoming_studies_are_listed_by_default(): void
    {
        $studies = Study::factory()->count(10)->create();

        LiveWire::test(StudyResource\Pages\ListStudies::class)
            ->assertCanSeeTableRecords($studies);
    }

    public function test_only_the_current_teams_studies_are_listed(): void
    {
        $studies = Study::factory()->count(10)->create();

        LiveWire::test(StudyResource\Pages\ListStudies::class)
            ->assertCanSeeTableRecords($studies);

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        LiveWire::test(StudyResource\Pages\ListStudies::class)
            ->assertCanNotSeeTableRecords($studies);
    }
}
