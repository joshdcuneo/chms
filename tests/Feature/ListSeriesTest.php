<?php

namespace Tests\Feature;

use App\Filament\Resources\SeriesResource;
use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListSeriesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->withPersonalTeam()->createOne());
    }

    public function test_page_can_be_rendered(): void
    {
        $this->get(SeriesResource::getUrl('index'))->assertSuccessful();
    }

    public function test_upcoming_series_are_listed_by_default(): void
    {
        $series = Series::factory()->count(10)->create();

        LiveWire::test(SeriesResource\Pages\ListSeries::class)
            ->assertCanSeeTableRecords($series);
    }

    public function test_only_the_current_teams_series_are_listed(): void
    {
        $series = Series::factory()->count(10)->create();

        LiveWire::test(SeriesResource\Pages\ListSeries::class)
            ->assertCanSeeTableRecords($series);

        $this->actingAs(User::factory()->withPersonalTeam()->createOne());

        LiveWire::test(SeriesResource\Pages\ListSeries::class)
            ->assertCanNotSeeTableRecords($series);
    }
}
