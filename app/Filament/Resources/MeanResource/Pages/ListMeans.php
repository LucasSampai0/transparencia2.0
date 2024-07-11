<?php

namespace App\Filament\Resources\MeanResource\Pages;

use App\Filament\Resources\MeanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeans extends ListRecords
{
    protected static string $resource = MeanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
