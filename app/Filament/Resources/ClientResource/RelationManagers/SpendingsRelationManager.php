<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

class SpendingsRelationManager extends RelationManager
{
    protected static string $relationship = 'spendings';

    protected static ?string $title = 'Investimentos';

    protected static ?string $label = 'Investimento';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')
                    ->label('Data')
                    ->format('d/m/Y')
                    ->required(),

                Money::make('total')
                    ->label('Total')
                    ->prefix('R$ ')
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'spending_mean' => 'Veículo',
                        'spending_supplier' => 'Fornecedor',
                    ])
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('mean_id', null);
                        $set('supplier_id', null);
                    })
                    ,

                Forms\Components\Select::make('mean_id')
                    ->label('Veículo')
                    ->relationship('mean', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpanFull()
                    //visible function if type is spending_mean
                    ->visible(
                        fn($record, $get) => $get('type') === 'spending_mean'
                    ),

                Forms\Components\Select::make('supplier_id')
                    ->label('Fornecedor')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpanFull()
                    ->visible(
                        fn($record, $get) => $get('type') === 'spending_supplier'
                    ),

            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitle('Investimento')
            ->recordTitleAttribute('date')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->label('Nome')
                ->getStateUsing(
                    fn($record) => $record->mean_id ? $record->mean->name : $record->supplier->name
                ),
                Tables\Columns\TextColumn::make('total')->money('BRL'),
                Tables\Columns\TextColumn::make('date')->label('Data')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->searchable()->label('Categoria'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->name('Categoria')
                    ->searchable()
                    ->preload()
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

    public function getTabs(): array
    {
        return [
            'Means' => Tab::make('Veículos', 'spendings')->query(function (Builder $query) {
                $query->where('mean_id', '!=', null);
            }),
            'Suppliers' => Tab::make('Fornecedores', 'spendings')->query(function (Builder $query) {
                $query->where('supplier_id', '!=', null);
            }),
        ];
    }
}
