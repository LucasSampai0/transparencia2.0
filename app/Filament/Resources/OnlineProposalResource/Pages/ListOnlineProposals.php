<?php

namespace App\Filament\Resources\OnlineProposalResource\Pages;

use App\Filament\Resources\OnlineProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOnlineProposals extends ListRecords
{
    protected static string $resource = OnlineProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
