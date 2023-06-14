<?php

namespace Tests\Feature;

use App\Filament\Resources\OtherDemographicResource;
use App\Models\OtherDemographic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListOtherDemographics extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->withPersonalTeam()->createOne());
    }

    public function test_page_can_be_rendered(): void
    {
        $this->get(OtherDemographicResource::getUrl('index'))->assertSuccessful();
    }

    public function test_other_demographics_are_listed(): void
    {
        $otherDemographics = OtherDemographic::factory()->count(10)->create();

        LiveWire::test(OtherDemographicResource\Pages\ListOtherDemographics::class)
            ->assertCanSeeTableRecords($otherDemographics);
    }

    public function test_only_the_current_teams_other_demographics_are_listed(): void
    {
        $otherDemographics = OtherDemographic::factory()->count(10)->create();

        LiveWire::test(OtherDemographicResource\Pages\ListOtherDemographics::class)
            ->assertCanSeeTableRecords($otherDemographics);

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        LiveWire::test(OtherDemographicResource\Pages\ListOtherDemographics::class)
            ->assertCanNotSeeTableRecords($otherDemographics);
    }
}
