<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Models\Category;
use App\Models\Mean;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class MeansRelationManager extends RelationManager
{

    protected static ?string $model = Mean::class;
    protected static string $relationship = 'means';
    protected static ?string $recordTitleAttribute = 'title';


    protected static ?string $title = 'Veículos';

    protected static ?string $label = 'Veículo';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Veículo')
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cnpj')->label('CNPJ')
                            ->required()
                            ->mask('99.999.999/9999-99'),
                        Forms\Components\Select::make('category_id')
                            ->label('Categoria')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->options(Category::all()->pluck('name', 'id'))
                            ->required(),
                    ])->columns(3),


                Section::make('Documentos')
                    ->schema([
                        Repeater::make('file')
                            ->relationship('meanAttachments')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->label('Título'),
                                FileUpload::make('file')
                                    ->required()
                                    ->disk('attachments')
                                    ->label('Anexo'),
                            ])->columns(2)
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->itemLabel(function (array $state): string {
                                return $state['title'] ?? 'Anexo sem nome';
                            })
                            ->defaultItems(0)
                            ->createItemButtonLabel('Adicionar Documento'),
                    ])->columnSpanFull(),
            ]);

    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                TextColumn::make('cnpj')->label('CNPJ'),
                TextColumn::make('category.name')->label('Categoria')->searchable(),
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
                Tables\Actions\Action::make('viewAttachments')
                    ->label('Ver Documentos')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Documentos')
                    ->modalContent(function ($record) {
                        return view('filament.resources.mean.view-attachments-modal', ['mean' => $record]);
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])
            ]);
    }
}
