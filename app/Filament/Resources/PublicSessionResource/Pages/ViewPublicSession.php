<?php

namespace App\Filament\Resources\PublicSessionResource\Pages;

use App\Filament\Resources\PublicSessionResource;
use App\Models\PublicSession;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Widgets\WidgetConfiguration;


class ViewPublicSession extends ViewRecord
{
    protected static string $resource = PublicSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            PublicSessionResource\Widgets\OnlineProposalWidget::class,
        ];
    }
}
