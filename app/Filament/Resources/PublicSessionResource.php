<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicSessionResource\Pages;
use App\Filament\Resources\PublicSessionResource\RelationManagers;
use App\Models\PublicSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PublicSessionResource extends Resource
{
    protected static ?string $model = PublicSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = 'Sessões Públicas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                //add description column
                TextColumn::make('description')->label('Descrição')->searchable(),
                TextColumn::make('date')->label('Data')->searchable(),
                TextColumn::make('time')->label('Hora')->searchable(),
                TextColumn::make('client.name')->label('Cliente')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPublicSessions::route('/'),
            'create' => Pages\CreatePublicSession::route('/create'),
            'edit' => Pages\EditPublicSession::route('/{record}/edit'),
        ];
    }
}
