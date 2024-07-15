<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
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
                Forms\Components\DatePicker::make('date')
                    ->label('Data')
                    ->format('d-m-Y')
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
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('supplier_id')
                    ->label('Fornecedor')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                ->columnSpanFull(),
            ]);
    }


    public function table(Table $table): Table
    {

        return $table
            ->recordTitle('Investimento')
            ->recordTitleAttribute('date')
            ->columns([
                Tables\Columns\TextColumn::make('supplier.name')->searchable()->label('Fornecedor')->searchable(),
                Tables\Columns\TextColumn::make('total')->money('BRL'),
                Tables\Columns\TextColumn::make('date')->label('Data')->date('d-m-Y')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->searchable()->label('Categoria')->searchable(),
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
                $query->where('type', 'spending_mean');
            }),
            'Suppliers' => Tab::make('Fornecedores', 'spendings')->query(function (Builder $query) {
                $query->where('type', 'spending_supplier');
            }),
        ];
    }
}
