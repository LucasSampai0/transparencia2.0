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
use Illuminate\Support\Facades\Storage;

class PublicSessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'publicSessions';

    protected static ?string $title = 'Sessões Públicas';

    protected static ?string $label = 'Sessão Pública';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label('Descrição')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Data'),
                Forms\Components\TimePicker::make('time')
                    ->required()
                    ->time('H:i')
                    ->seconds(false)
                    ->label('Hora'),
                Forms\Components\FileUpload::make('attachment')
                    ->label('Anexo')
                    ->disk('attachments')
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle('Sessão Pública')
            ->columns([
                TextColumn::make('description')->label('Descrição')->searchable(),
                TextColumn::make('date')->label('Data')->searchable(),
                TextColumn::make('time')->label('Hora')->toggleable()->time('H:i'),
                TextColumn::make('attachment')
                    ->label('Anexo')
                    ->toggleable()
                    ->icon('heroicon-o-paper-clip')
                    ->formatStateUsing(fn ($state) => $state ? 'Ver Anexo' : 'Sem Anexo')
                    ->url(fn ($record) => $record->attachment ? Storage::disk('attachments')->url($record->attachment) : null)
                    ->openUrlInNewTab()
            ])
            ->filters([
                //
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
