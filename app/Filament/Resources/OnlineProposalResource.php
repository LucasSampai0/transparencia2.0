<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OnlineProposalResource\Pages;
use App\Filament\Resources\OnlineProposalResource\RelationManagers;
use App\Models\OnlineProposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OnlineProposalResource extends Resource
{
    protected static ?string $model = OnlineProposal::class;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Empresa')
                        ->schema([
                            Forms\Components\Select::make('client_id')
                                ->options(\App\Models\Client::all()->pluck('name', 'id')->toArray())
                                ->required()
                                ->label('Cliente'),
                            Forms\Components\Select::make('public_session_id')
                                ->options(\App\Models\PublicSession::all()->pluck('description', 'id')->toArray())
                                ->required()
                                ->label('Sessão Pública'),
                            Forms\Components\Textarea::make('company_name'),
                            Forms\Components\Textarea::make('company_cnpj'),
                            Forms\Components\Textarea::make('company_IE'),
                            Forms\Components\Textarea::make('company_IM'),
                            Forms\Components\Textarea::make('company_address'),
                            Forms\Components\Textarea::make('company_neighborhood'),
                            Forms\Components\Textarea::make('company_number'),
                            Forms\Components\Textarea::make('company_state'),
                            Forms\Components\Textarea::make('company_city'),
                    ]),
                    Forms\Components\Wizard\Step::make('Faturamento')
                        ->schema([
                            Forms\Components\Textarea::make('bank_code'),
                            Forms\Components\Textarea::make('bank_agency'),
                            Forms\Components\Textarea::make('bank_account'),
                        ]),
                    Forms\Components\Wizard\Step::make('Representante Legal')
                    ->schema([
                            Forms\Components\Textarea::make('legal_representative_name'),
                            Forms\Components\Textarea::make('legal_representative_cpf'),
                            Forms\Components\Textarea::make('legal_representative_email'),
                            Forms\Components\Textarea::make('legal_representative_phone'),
                        ]),
                    Forms\Components\Wizard\Step::make('Proposta')
                    ->schema([
                        Forms\Components\Textarea::make('proposal_description'),
                        Forms\Components\Textarea::make('proposal_value'),
                        Forms\Components\DatePicker::make('proposal_expiry_date')->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y')),
                        Forms\Components\FileUpload::make('proposal_signed_attachment'),
                    ]),
                ])
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Panel::make([
                    Split::make([
                        Stack::make([
                            Tables\Columns\TextColumn::make('company_name')->prefix('Empresa: '),
                            Tables\Columns\TextColumn::make('company_cnpj')->prefix('CNPJ: '),
                            Tables\Columns\TextColumn::make('company_IE')->prefix('IE: '),
                            Tables\Columns\TextColumn::make('company_IM')->prefix('IM: '),
                            Tables\Columns\TextColumn::make('company_address')->prefix('Endereço: '),
                            Tables\Columns\TextColumn::make('company_neighborhood')->prefix('Bairro: '),
                            Tables\Columns\TextColumn::make('company_number')->prefix('Número: '),
                            Tables\Columns\TextColumn::make('company_state')->prefix('Estado: '),
                            Tables\Columns\TextColumn::make('company_city')->prefix('Cidade: '),
                        ]),
                        Stack::make([
                            Tables\Columns\TextColumn::make('bank_code')->prefix('Código do Banco: '),
                            Tables\Columns\TextColumn::make('bank_agency')->prefix('Agência: '),
                            Tables\Columns\TextColumn::make('bank_account')->prefix('Conta: '),
                        ]),
                        Stack::make([
                            Tables\Columns\TextColumn::make('legal_representative_name')->prefix('Representante Legal: '),
                            Tables\Columns\TextColumn::make('legal_representative_cpf')->prefix('CPF: '),
                            Tables\Columns\TextColumn::make('legal_representative_email')->prefix('Email: '),
                            Tables\Columns\TextColumn::make('legal_representative_phone')->prefix('Telefone: '),
                        ]),
                        Stack::make([
                            Tables\Columns\TextColumn::make('proposal_description')->prefix('Descrição da Proposta: '),
                            Tables\Columns\TextColumn::make('proposal_value')->prefix('Valor da Proposta: '),
                            Tables\Columns\TextColumn::make('proposal_expiry_date')->prefix('Validade da Proposta: '),
                            Tables\Columns\TextColumn::make('proposal_signed_attachment')
                                ->label('Anexo')
                                ->icon('heroicon-o-paper-clip')
                                ->formatStateUsing(fn($state) => $state ? 'Ver Anexo' : 'Sem Anexo')
                                ->url(fn($record) => $record->attachment ? Storage::disk('attachments')->url($record->attachment) : null)
                                ->openUrlInNewTab()
                        ]),
                    ])
                ])->collapsible(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOnlineProposals::route('/'),
            'create' => Pages\CreateOnlineProposal::route('/create'),
            'edit' => Pages\EditOnlineProposal::route('/{record}/edit'),
        ];
    }
}
