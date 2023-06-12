<?php

namespace App\Filament\Resources\DemographicResource\Pages;

use App\Filament\Resources\DemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDemographic extends ViewRecord
{
    protected static string $resource = DemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
