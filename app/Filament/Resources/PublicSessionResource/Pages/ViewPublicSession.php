<?php

namespace App\Filament\Resources\PublicSessionResource\Pages;

use App\Filament\Resources\PublicSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPublicSession extends ViewRecord
{
    protected static string $resource = PublicSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}