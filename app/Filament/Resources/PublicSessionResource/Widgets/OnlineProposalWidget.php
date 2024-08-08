<?php

namespace App\Filament\Resources\PublicSessionResource\Widgets;

use App\Models\OnlineProposal;
use App\Models\PublicSession;
use Carbon\Carbon;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Storage;

class OnlineProposalWidget extends BaseWidget
{

    protected static ?string $heading = 'Propostas Online';

    public ?PublicSession $record = null;

    public PublicSession $publicSession;
    protected int|string|array $columnSpan = 'full';



    public function table(Table $table): Table
    {
        $date = Carbon::createFromFormat('d-m-Y', $this->record->date)->startOfDay();
        $hour = Carbon::createFromFormat('H:i', $this->record->time);
        $dateNow = Carbon::now()->startOfDay();
        $hourNow = Carbon::now();

        if ($date <= $dateNow && $hour <= $hourNow) {
            return $table
                ->deferLoading()
                ->striped()
                ->query(
                    OnlineProposal::with('publicSession')->where('public_session_id', $this->record->id),
                )
                ->columns([
                    Split::make([

                        Tables\Columns\TextColumn::make('company_name')->prefix('Empresa: '),
                        Tables\Columns\TextColumn::make('company_name')->prefix('Representante Legal: '),
                        Tables\Columns\TextColumn::make('company_name')->prefix('Valor da Proposta: '),
                    ]),
                    Panel::make([
                        Split::make([
                            Stack::make([
                                Tables\Columns\TextColumn::make('company_cnpj')->prefix('CNPJ: '),
                                Tables\Columns\TextColumn::make('company_IE')->prefix('IE: '),
                                Tables\Columns\TextColumn::make('company_IM')->prefix('IM: '),
                            ]),
                            Stack::make([
                                Tables\Columns\TextColumn::make('legal_representative_cpf')->prefix('CPF: '),
                                Tables\Columns\TextColumn::make('legal_representative_email')->prefix('Email: '),
                                Tables\Columns\TextColumn::make('legal_representative_phone')->prefix('Telefone: '),
                            ]),
                            Stack::make([
                                //                                Tables\Columns\TextColumn::make('proposal_value')->prefix('Valor da Proposta: '),
                                Tables\Columns\TextColumn::make('proposal_expiry_date')->prefix('Validade da Proposta: '),
                                Tables\Columns\TextColumn::make('proposal_signed_attachment')
                                    ->label('Anexo')
                                    ->icon('heroicon-o-paper-clip')
                                    ->formatStateUsing(fn($state) => $state ? 'Ver Proposta Assinada' : 'Sem Anexo')
                                    ->url(fn($record) => $record->proposal_signed_attachment ? Storage::disk('attachments')->url($record->proposal_signed_attachment) : null)
                                    ->openUrlInNewTab()
                            ]),
                        ])->from('sm'),
                        //                        Tables\Columns\TextColumn::make('proposal_description')->prefix('Descrição da proposta: ')
                    ])
                        ->collapsible(),
                ])
                ->actions([
                    Tables\Actions\ViewAction::make()
                        ->visible()
                        ->label('Ver proposta completa')
                        ->modalHeading('Proposta Online')
                        ->infolist(function ($record) {
                            return Infolist::make()
                                ->record($record)
                                ->schema([
                                    Section::make('Proposta')
                                        ->schema([
                                            TextEntry::make('proposal_description')->label('Descrição da Proposta')->columnSpanFull(),
                                            TextEntry::make('proposal_value')->label('Valor da Proposta'),
                                            TextEntry::make('proposal_expiry_date')->label('Validade da Proposta'),
                                            TextEntry::make('proposal_signed_attachment')
                                                ->label('Anexo')
                                                ->formatStateUsing(fn($state) => $state ? 'Ver Proposta Assinada' : 'Sem Anexo')
                                                ->url(fn($record) => $record->proposal_signed_attachment ? Storage::disk('attachments')->url($record->proposal_signed_attachment) : null)
                                                ->openUrlInNewTab(),
                                        ])->columns(3),
                                    Section::make('Informações da Empresa')
                                        ->schema([
                                            TextEntry::make('company_name')->label('Empresa'),
                                            TextEntry::make('company_cnpj')->label('CNPJ'),
                                            TextEntry::make('company_IE')->label('Ins. Estadual'),
                                            TextEntry::make('company_IM')->label('Ins. Municipal'),
                                            TextEntry::make('company_address')->label('Endereço'),
                                            TextEntry::make('company_zipcode')->label('CEP'),
                                            TextEntry::make('company_neighborhood')->label('Bairro'),
                                            TextEntry::make('company_number')->label('Número'),
                                            TextEntry::make('company_state')->label('Estado'),
                                            TextEntry::make('company_city')->label('Cidade'),
                                        ])->columns(4),
                                    Section::make('Dados Bancários')
                                        ->schema([
                                            TextEntry::make('bank_code')->label('Código do Banco'),
                                            TextEntry::make('bank_agency')->label('Agência'),
                                            TextEntry::make('bank_account')->label('Conta'),
                                        ])->columns(3),
                                    Section::make('Representante Legal')
                                        ->schema([
                                            TextEntry::make('legal_representative_name')->label('Representante Legal'),
                                            TextEntry::make('legal_representative_cpf')->label('CPF'),
                                            TextEntry::make('legal_representative_email')->label('Email'),
                                            TextEntry::make('legal_representative_phone')->label('Telefone'),
                                        ])->columns(2),

                                ]);
                        }),
                ]);
        } else {
            return $table
                ->query(
                    OnlineProposal::with('publicSession')->where('public_session_id', '=', '-1'),
                )
                ->columns([])->emptyStateHeading('Você verá as propostas online após a data desta sessão pública')
                ->emptyStateIcon('heroicon-o-information-circle')
                ->paginated(false);
        }
    }
}
