<?php

namespace App\Filament\Resources\OtherDemographicResource\Pages;

use App\Filament\Resources\OtherDemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOtherDemographic extends ViewRecord
{
    protected static string $resource = OtherDemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
