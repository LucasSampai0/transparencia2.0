<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Client as ClientModel;
use App\Models\OnlineProposal;
use App\Models\PublicSession;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Form;
use function SebastianBergmann\CodeCoverage\TestFixture\g;

class OnlineProposalForm extends Component implements hasForms
{

    use Forms\Concerns\InteractsWithForms;

    public $data = [];
    public $client_id;
    public $public_session_id;
    public ?array $attachment;

    public function mount($client_id, $public_session_id)
    {
        $this->client_id = $client_id;
        $this->public_session_id = $public_session_id;
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Empresa')
                        ->schema([
                            Forms\Components\TextInput::make('company_name'),
                            Forms\Components\TextInput::make('company_cnpj'),
                            Forms\Components\TextInput::make('company_IE'),
                            Forms\Components\TextInput::make('company_IM'),
                            Forms\Components\TextInput::make('company_address'),
                            Forms\Components\TextInput::make('company_neighborhood'),
                            Forms\Components\TextInput::make('company_number'),
                            Forms\Components\TextInput::make('company_state'),
                            Forms\Components\TextInput::make('company_city'),
                        ])->columns(2),
                    Forms\Components\Wizard\Step::make('Faturamento')
                        ->schema([
                            Forms\Components\TextInput::make('bank_code'),
                            Forms\Components\TextInput::make('bank_agency'),
                            Forms\Components\TextInput::make('bank_account'),
                        ]),
                    Forms\Components\Wizard\Step::make('Representante Legal')
                        ->schema([
                            Forms\Components\TextInput::make('legal_representative_name'),
                            Forms\Components\TextInput::make('legal_representative_cpf'),
                            Forms\Components\TextInput::make('legal_representative_email'),
                            Forms\Components\TextInput::make('legal_representative_phone'),
                        ]),
                    Forms\Components\Wizard\Step::make('Proposta')
                        ->schema([
                            Forms\Components\TextInput::make('proposal_description'),
                            Forms\Components\TextInput::make('proposal_value'),
                            Forms\Components\DatePicker::make('proposal_expiry_date'),
                            Forms\Components\FileUpload::make('proposal_signed_attachment'),
                        ]),
                ])
                    ->columnSpanFull(),
            ]);
    }



    public function create()
    {
        $data = $this->form->getState();
        $data['client_id'] = $this->client_id;
        $data['public_session_id'] = $this->public_session_id;

        OnlineProposal::create([
            "client_id" => $data['client_id'],
            "public_session_id" => $data['public_session_id'],
            "company_name" => $data['company_name'],
            "company_cnpj" => $data['company_cnpj'],
            "company_IE" => $data['company_IE'],
            "company_IM" => $data['company_IM'],
            "company_address" => $data['company_address'],
            "company_neighborhood" => $data['company_neighborhood'],
            "company_number" => $data['company_number'],
            "company_state" => $data['company_state'],
            "company_city" => $data['company_city'],
            "bank_code" => $data['bank_code'] ?? null,
            "bank_agency" => $data['bank_agency'] ?? null,
            "bank_account" => $data['bank_account'] ?? null,
            "legal_representative_name" => $data['legal_representative_name'] ?? null,
            "legal_representative_cpf" => $data['legal_representative_cpf'] ?? null,
            "legal_representative_email" => $data['legal_representative_email'] ?? null,
            "legal_representative_phone" => $data['legal_representative_phone'] ?? null,
            "proposal_description" => $data['proposal_description'] ?? null,
            "proposal_value" => $data['proposal_value'] ?? null,
            "proposal_expiry_date" => $data['proposal_expiry_date'] ?? null,
            "proposal_signed_attachment" => $data['proposal_signed_attachment'],
        ]);

        Notification::make()
            ->success()
            ->title('Proposta enviada com sucesso!')
            ->seconds(5)
            ->send();
    }


    public function render()
    {
        return view('livewire.online-proposal-form', [
            'form' => $this->form,
        ]);
    }
}
