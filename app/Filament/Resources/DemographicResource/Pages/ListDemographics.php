<?php

namespace App\Filament\Resources\DemographicResource\Pages;

use App\Filament\Resources\DemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDemographics extends ListRecords
{
    protected static string $resource = DemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
