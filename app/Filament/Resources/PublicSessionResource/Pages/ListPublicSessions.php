<?php

namespace App\Filament\Resources\PublicSessionResource\Pages;

use App\Filament\Resources\PublicSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPublicSessions extends ListRecords
{
    protected static string $resource = PublicSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
