<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Faker\Provider\Text;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
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
                            ->disk('logos')
                            ->hiddenLabel()
                            ->label('Logo'),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->prefixIcon('heroicon-o-user')
                                    ->prefix('Nome')
                                    ->hiddenLabel(),

                                TextInput::make('cnpj')->prefix('CNPJ')
                                    ->prefixIcon('heroicon-o-identification')
                                    ->unique(ignoreRecord: true)
                                    ->hiddenLabel()
                                    ->mask('99.999.999/9999-99'),

                                TextInput::make('address')
                                    ->prefixIcon('heroicon-o-map-pin')
                                    ->prefix('Endereço')
                                    ->hiddenLabel(),

                                TextInput::make('slug')
                                    ->prefixIcon('heroicon-o-link')
                                    ->unique(ignoreRecord: true)
                                    ->prefix('Slug')
                                    ->hiddenLabel(),

                                TextInput::make('phone')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->tel()
                                    ->prefix('Telefone')
                                    ->hiddenLabel()
                                    ->mask(
                                        RawJs::make(<<<'JS'
                                            $input.length > 14
                                                ? '(99) 99999-9999'
                                                : '(99) 9999-9999'
                                        JS)
                                    ),

                                TextInput::make('site')
                                    ->prefixIcon('heroicon-o-globe-alt')
                                    ->url()
                                    ->prefix('Site')
                                    ->hiddenLabel(),
                            ])->columnSpan(5)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Buscar Clientes')
            ->columns([
                ImageColumn::make('logo')
                    ->circular()
                    ->disk('logos')
                    ->label('Logo'),
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

                    ViewAction::make()
                        ->label('Visualizar')
                        ->url(function ($record) {
                            return url("{$record->slug}");
                        }),
                    EditAction::make()->label('Editar'),

                    //                    Action::make('mean')
                    //                        ->label('Veículos')
                    //                        ->icon('heroicon-o-megaphone'),
                    //
                    //                    Action::make('supplier')
                    //                        ->label('Fornecedores')
                    //                        ->icon('heroicon-o-truck'),
                    //
                    //                    Action::make('spending')
                    //                        ->label('Investimentos')
                    //                        ->icon('heroicon-o-banknotes'),
                    //
                    //                    Action::make('publicSession')
                    //                        ->label('Sessões Públicas')
                    //                        ->icon('heroicon-o-user-group'),

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
            'spendings' => RelationManagers\SpendingsRelationManager::class,
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
