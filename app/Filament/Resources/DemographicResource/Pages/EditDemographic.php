<?php

namespace App\Filament\Resources\DemographicResource\Pages;

use App\Filament\Resources\DemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDemographic extends EditRecord
{
    protected static string $resource = DemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
