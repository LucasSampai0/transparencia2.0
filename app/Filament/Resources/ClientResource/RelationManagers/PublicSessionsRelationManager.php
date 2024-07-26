<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Filament\Resources\PublicSessionResource;
use App\Filament\Resources\PublicSessionResource\Widgets\OnlineProposalWidget;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Form;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Storage;

class PublicSessionsRelationManager extends RelationManager
{

    use ExposesTableToWidgets;

    protected static string $relationship = 'publicSessions';

    protected static ?string $title = 'Sessões Públicas';

    protected static ?string $label = 'Sessão Pública';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                MarkdownEditor::make('description')
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'table',
                        'undo',
                    ])
                    ->label('Descrição')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Data')
                    ->format('d/m/Y')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d/m/Y')),
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
                TextColumn::make('description')->label('Descrição')->searchable()->wrap()->limit(75),
                TextColumn::make('date')
                    ->label('Data')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d/m/Y'))
                    ->searchable(),
                TextColumn::make('time')->label('Hora')->toggleable()->time('H:i'),
                TextColumn::make('attachment')
                    ->label('Anexo')
                    ->toggleable()
                    ->icon('heroicon-o-paper-clip')
                    ->formatStateUsing(fn($state) => $state ? 'Ver Anexo' : 'Sem Anexo')
                    ->url(fn($record) => $record->attachment ? Storage::disk('attachments')->url($record->attachment) : null)
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
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
                    ->url(fn($record): string => PublicSessionResource::getUrl('view', ['record' => $record]))

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])
            ]);
    }
}
