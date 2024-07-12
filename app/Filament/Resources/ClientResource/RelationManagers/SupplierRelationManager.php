<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierRelationManager extends RelationManager
{
    protected static string $relationship = 'suppliers';

    protected static ?string $title = 'Fornecedores';

    protected static ?string $label = 'Fornecedor';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nome'),
                Forms\Components\TextInput::make('cnpj')
                    ->required()
                    ->label('CNPJ')
                    ->mask('99.999.999/9999-99'),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Categoria'),
            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),
                Tables\Columns\TextColumn::make('cnpj')->label('CNPJ'),
                Tables\Columns\TextColumn::make('category.name')->label('Categoria')->searchable(),
            ])
            ->filters([

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])

            ]);
    }
}
