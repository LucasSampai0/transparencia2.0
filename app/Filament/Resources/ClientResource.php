<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
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
                Grid::make(6)
                    ->schema([
                        FileUpload::make('logo')
                            ->avatar()
                            ->disk('public')
                            ->directory('logos')
                            ->hiddenLabel()
                            ->label('Logo'),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')->prefix('Nome')->hiddenLabel(),

                                TextInput::make('cnpj')->prefix('CNPJ')->hiddenLabel()->mask('99.999.999/9999-99')->unique('clients', 'cnpj'),

                                TextInput::make('address')->prefix('Endereço')->hiddenLabel(),

                                TextInput::make('slug')->prefix('Slug')->hiddenLabel()->unique('clients', 'slug'),
                            ])->columnSpan(5)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Buscar Clientes')
            ->columns([
                ImageColumn::make('logo')
                    ->circular()
                    ->label('Logo')
                    ->placeholder('https://via.placeholder.com/150'),
                TextColumn::make('name')->label('Nome')->searchable()->sortable(),
                TextColumn::make('cnpj')->label('CNPJ')->searchable()->toggleable(),
                TextColumn::make('address')->label('Endereço')->searchable()->toggleable(),
                TextColumn::make('slug')->label('Slug')->toggleable()->toggledHiddenByDefault(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([

                    ViewAction::make()->label('Visualizar'),

                    EditAction::make()->label('Editar'),

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

                    DeleteAction::make()->label('Deletar'),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Deletar'),
                ])->label('Ação em massa'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            'means' => RelationManagers\MeansRelationManager::class,
            'suppliers' => RelationManagers\SupplierRelationManager::class,
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
