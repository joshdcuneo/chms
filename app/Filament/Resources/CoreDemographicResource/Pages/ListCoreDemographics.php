<?php

namespace App\Filament\Resources\CoreDemographicResource\Pages;

use App\Filament\Resources\CoreDemographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoreDemographics extends ListRecords
{
    protected static string $resource = CoreDemographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
