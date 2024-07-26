<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicSessionResource\Pages;
use App\Filament\Resources\PublicSessionResource\RelationManagers;
use App\Models\PublicSession;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Entry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PublicSessionResource extends Resource
{
    protected static ?string $model = PublicSession::class;

    protected static ?string $modelLabel = 'Sessão Pública';

    public static function shouldRegisterNavigation(): bool
    {
        if (!auth()->user()->is_admin) {
            return true;
        }
        else{
            return false;
        }
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


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
            ->modifyQueryUsing(fn (Builder $query) => $query->where('client_id', auth()->user()->client_id))
            ->columns([
                TextColumn::make('description')->label('Descrição')->searchable()->wrap()->limit(75),
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

            ]);
//            ->actions([
//                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
//            ])
//            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
//            ]);

    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make([
                TextEntry::make('description')->label('Descrição')->columnSpanFull(),
                TextEntry::make('date')->label('Data')
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y'))
                    ->columnSpan(1),
                TextEntry::make('time')->label('Hora')->columnSpan(1)
            ])->columns(2)
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
//            'create' => Pages\CreatePublicSession::route('/create'),
            'view' => Pages\ViewPublicSession::route('/{record}'),
//            'edit' => Pages\EditPublicSession::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PublicSessionResource\Widgets\OnlineProposalWidget::class
        ];
    }
}
