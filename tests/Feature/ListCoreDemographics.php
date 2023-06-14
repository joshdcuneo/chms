<?php

namespace Tests\Feature;

use App\Filament\Resources\CoreDemographicResource;
use App\Models\CoreDemographic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Livewire\Livewire;
use Tests\TestCase;

class ListCoreDemographics extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->withPersonalTeam()->createOne());
    }

    public function test_page_can_be_rendered(): void
    {
        $this->get(CoreDemographicResource::getUrl('index'))->assertSuccessful();
    }

    public function test_core_demographics_are_listed_on_page(): void
    {
        $coreDemographics = CoreDemographic::factory()->count(10)->create();

        LiveWire::test(CoreDemographicResource\Pages\ListCoreDemographics::class)
            ->assertCanSeeTableRecords($coreDemographics);
    }

    public function test_only_the_current_teams_core_demographics_are_listed_on_page(): void
    {
        $coreDemographics = CoreDemographic::factory()->count(10)->create();

        LiveWire::test(CoreDemographicResource\Pages\ListCoreDemographics::class)
            ->assertCanSeeTableRecords($coreDemographics);

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        LiveWire::test(CoreDemographicResource\Pages\ListCoreDemographics::class)
            ->assertCanNotSeeTableRecords($coreDemographics);
    }

    public function test_core_demographics_are_listed_via_api(): void
    {
        CoreDemographic::factory()->count(10)->create();

        $this->graphQL($this->query())
            ->assertJson(function (AssertableJson $json) {
                $json->has('data.listCoreDemographics.data', 10, function (AssertableJson $json) {
                    $json->whereType('id', 'string')
                        ->whereType('name', 'string')
                        ->whereType('description', 'string')
                        ->whereType('createdAt', 'string')
                        ->whereType('updatedAt', 'string');
                });
            });
    }

    public function test_only_the_current_teams_core_demographics_are_listed_via_api(): void
    {
        CoreDemographic::factory()->count(10)->create();

        $this->graphQL($this->query())
            ->assertJson(function (AssertableJson $json) {
                $json->has('data.listCoreDemographics.data', 10)->etc();
            });

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        $this->graphQL($this->query())
            ->assertJson([]);
    }

    private function query(): string
    {
        return /** @lang GraphQL */
            '
            query {
                listCoreDemographics {
                    data {
                        id
                        name
                        description
                        createdAt
                        updatedAt
                    }
                }
            }';
    }
}
