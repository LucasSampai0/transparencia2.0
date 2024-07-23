<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'Admin' => Tab::make('ADM', 'users')->query(function (Builder $query) {
                $query->where('is_admin', '1');
            }),
            'Suppliers' => Tab::make('Clientes', 'users')->query(function (Builder $query) {
                $query->where('is_admin', '0');
            }),

        ];
    }
}
