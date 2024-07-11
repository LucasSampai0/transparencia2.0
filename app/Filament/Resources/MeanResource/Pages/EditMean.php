<?php

namespace App\Filament\Resources\MeanResource\Pages;

use App\Filament\Resources\MeanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMean extends EditRecord
{
    protected static string $resource = MeanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
