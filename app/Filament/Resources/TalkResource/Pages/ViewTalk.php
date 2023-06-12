<?php

namespace App\Filament\Resources\TalkResource\Pages;

use App\Filament\Resources\TalkResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTalk extends ViewRecord
{
    protected static string $resource = TalkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
