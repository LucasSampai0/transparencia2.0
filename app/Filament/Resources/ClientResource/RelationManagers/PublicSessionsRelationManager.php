<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PublicSessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'publicSessions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(255)
                ->columnSpanFull(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TimePicker::make('time')
                    ->required()
                    ->format('H:i')
                ->time(00, 00, 00),
                Forms\Components\FileUpload::make('file')
                    ->label('Anexo')
                    ->disk('public')
                    ->directory('attachments')
                    ->preserveFilenames()->columnSpanFull()

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle('Sessão Pública')
            ->columns([
                TextColumn::make('description')->label('Descrição')->searchable(),
                TextColumn::make('date')->label('Data')->searchable(),
                TextColumn::make('time')->label('Hora')->toggleable(),
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
}
