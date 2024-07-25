<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OnlineProposalResource\Pages;
use App\Filament\Resources\OnlineProposalResource\RelationManagers;
use App\Models\OnlineProposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OnlineProposalResource extends Resource
{
    protected static ?string $model = OnlineProposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
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
                Forms\Components\Textarea::make('bank_code'),
                Forms\Components\Textarea::make('bank_agency'),
                Forms\Components\Textarea::make('bank_account'),
                Forms\Components\Textarea::make('legal_representative_name'),
                Forms\Components\Textarea::make('legal_representative_cpf'),
                Forms\Components\Textarea::make('legal_representative_email'),
                Forms\Components\Textarea::make('legal_representative_phone'),
                Forms\Components\Textarea::make('proposal_description'),
                Forms\Components\Textarea::make('proposal_value'),
                Forms\Components\DatePicker::make('proposal_expiry_date'),
                Forms\Components\FileUpload::make('proposal_signed_attachment'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
