<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierRelationManager extends RelationManager
{
    protected static string $relationship = 'suppliers';

    protected static ?string $title = 'Fornecedores';

    protected static ?string $label = 'Fornecedor';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Fornecedor')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nome'),
                        Forms\Components\TextInput::make('cnpj')
                            ->required()
                            ->label('CNPJ')
                            ->mask('99.999.999/9999-99'),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Categoria'),
                    ])->columns(3),


                Section::make('Documentos')
                    ->schema([
                        Repeater::make('file')
                            ->relationship('supplierAttachments')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->label('Título'),
                                FileUpload::make('file')
                                    ->required()
                                    ->disk('attachments')
                                    ->label('Anexo')
                            ])->columns(2)
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->itemLabel(
                                function (array $state): string {
                                    return $state['title'] ?? 'Anexo sem nome';
                                }
                            )
                            ->defaultItems(0)
                            ->createItemButtonLabel('Adicionar Documento')
                    ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),
                Tables\Columns\TextColumn::make('cnpj')->label('CNPJ'),
                Tables\Columns\TextColumn::make('category.name')->label('Categoria')->searchable(),
            ])
            ->filters([])
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
                        return view('filament.resources.supplier.view-attachments-modal', ['supplier' => $record]);
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])
            ]);
    }
}
