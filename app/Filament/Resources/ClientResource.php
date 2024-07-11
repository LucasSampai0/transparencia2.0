<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{

    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $modelLabel = 'Clientes';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logo')->
                image()->
                disk('public')->
                directory('logos')->
                label('Logo'),

                TextInput::make('name')->label('Nome'),

                TextInput::make('cnpj')->label('CNPJ'),

                TextInput::make('address')->label('Endereço'),

                TextInput::make('slug')->label('Slug'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->circular()
                    ->label('Logo')
                    ->placeholder('https://via.placeholder.com/150'),
                TextColumn::make('name')->label('Nome')->searchable()->sortable(),
                TextColumn::make('cnpj')->label('CNPJ')->searchable()->toggleable(),
                TextColumn::make('address')->label('Endereço')->searchable()->toggleable(),
                TextColumn::make('slug')->label('Slug')->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([

                    ViewAction::make(),

                    EditAction::make(),

                    Action::make('mean')
                        ->label('Veículos')
                        ->icon('heroicon-o-megaphone'),

                    Action::make('supplier')
                        ->label('Fornecedores')
                        ->icon('heroicon-o-truck'),

                    Action::make('spending')
                        ->label('Investimentos')
                        ->icon('heroicon-o-banknotes'),

                    Action::make('publicSession')
                        ->label('Sessões Públicas')
                        ->icon('heroicon-o-user-group'),

                    DeleteAction::make(),
                ]),

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
            'means' => RelationManagers\MeansRelationManager::class,
//            'suppliers' => RelationManagers\SuppliersRelationManager::class,
//            'spendingsMeans' => RelationManagers\SpendingsMeansRelationManager::class,
//            'spendingsSuppliers' => RelationManagers\SpendingsSuppliersRelationManager::class,
            'publicSessions' => RelationManagers\PublicSessionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
