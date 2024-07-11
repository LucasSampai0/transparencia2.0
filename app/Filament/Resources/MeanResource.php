<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeanResource\Pages;
use App\Filament\Resources\MeanResource\RelationManagers;
use App\Models\Category;
use App\Models\Client;
use App\Models\Mean;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\MeanAttachment;
use Illuminate\Support\Facades\App;

class MeanResource extends Resource
{
    protected static ?string $model = Mean::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nome'),
                TextInput::make('cnpj')->label('CNPJ'),
                Select::make('category')->label('Categoria')->relationship('category', 'name'),
               Repeater::make('mean_attachments')
                    ->schema([
                        TextInput::make('name')->label('Nome'),
                        FileUpload::make('file')->label('Anexo')->disk('public')->directory('attachments')->preserveFilenames(),
                    ])->collapsible()
                    ->columns(2)
                    ->createItemButtonLabel('Adicionar anexo')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nome')->searchable(),
                TextColumn::make('cnpj')->label('CNPJ'),
                TextColumn::make('category.name')->label('Categoria')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListMeans::route('/'),
            'create' => Pages\CreateMean::route('/create'),
            'edit' => Pages\EditMean::route('/{record}/edit'),
        ];
    }
}
