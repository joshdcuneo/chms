<?php

namespace App\Filament\Resources\OtherDemographicResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOtherDemographic extends EditRecord
{
    protected static string $resource = OtherDemographicResource::class;

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
