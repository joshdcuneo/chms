<?php

namespace App\Filament\Resources\OtherDemographicResource\Pages;

use App\Filament\Resources\OtherDemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOtherDemographics extends ListRecords
{
    protected static string $resource = OtherDemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
