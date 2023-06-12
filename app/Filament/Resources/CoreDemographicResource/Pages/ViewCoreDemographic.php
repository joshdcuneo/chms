<?php

namespace App\Filament\Resources\CoreDemographicResource\Pages;

use App\Filament\Resources\CoreDemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCoreDemographic extends ViewRecord
{
    protected static string $resource = CoreDemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
