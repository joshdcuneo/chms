<?php

namespace App\Filament\Resources\CoreDemographicResource\Pages;

use App\Filament\Resources\CoreDemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoreDemographic extends EditRecord
{
    protected static string $resource = CoreDemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
