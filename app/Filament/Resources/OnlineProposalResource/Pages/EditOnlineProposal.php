<?php

namespace App\Filament\Resources\OnlineProposalResource\Pages;

use App\Filament\Resources\OnlineProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOnlineProposal extends EditRecord
{
    protected static string $resource = OnlineProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
