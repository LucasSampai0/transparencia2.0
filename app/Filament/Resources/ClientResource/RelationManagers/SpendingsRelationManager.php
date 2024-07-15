<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpendingsRelationManager extends RelationManager
{
    protected static string $relationship = 'spendings';

    protected static ?string $title = 'Investimentos';

    protected static ?string $label = 'Investimento';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('date')
                    ->required()
                    ->maxLength(255),
            ]);
    }


    public function table(Table $table): Table
    {

        return $table
            ->recordTitleAttribute('date')
            ->columns([
                Tables\Columns\TextColumn::make('date'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function getTabs() : array
    {
        return [
            'Means' => Tab::make('Veículos', 'spendings')->query(function (Builder $query) {
                $query->where('type', 'spending_mean');
            }),
            'Suppliers' => Tab::make('Fornecedores', 'spendings')->query(function (Builder $query) {
                $query->where('type', 'spending_supplier');
            }),
        ];
    }
}
