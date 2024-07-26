<?php

namespace App\Filament\Resources\PublicSessionResource\Pages;

use App\Filament\Resources\PublicSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPublicSession extends EditRecord
{
    protected static string $resource = PublicSessionResource::class;



    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
