<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\OnlineProposal;
use App\Models\PublicSession;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Form;
use Livewire\WithFileUploads;

class OnlineProposalForm extends Component
{

    use WithFileUploads;

    public $client;
    public $publicSession;
    public $company_name;
    public $company_cnpj;

    public $company_IE;
    public $company_IM;
    public $company_zipcode;
    public $company_address;
    public $company_neighborhood;
    public $company_number;
    public $company_state;
    public $company_city;
    public $bank_code;
    public $bank_agency;
    public $bank_account;
    public $legal_representative_name;
    public $legal_representative_cpf;
    public $legal_representative_email;
    public $legal_representative_phone;
    public $proposal_description;
    public $proposal_value;
    public $proposal_expiry_date;
    public $proposal_signed_attachment;

    public function mount($client_id, $public_session_id)
    {
        $this->client = Client::find($client_id);
        $this->publicSession = PublicSession::find($public_session_id);
    }


    public function store()
    {

        $this->mount($this->client->id, $this->publicSession->id);

        $this->validate([
            'company_name' => 'required|min:3|max:255',
            'company_cnpj' => 'required',
            'company_IE' => 'required',
            'company_IM' => 'required',
            'company_address' => 'required',
            'company_zipcode' => 'required',
            'company_neighborhood' => 'required',
            'company_number' => 'required',
            'company_state' => 'required',
            'company_city' => 'required',
            'bank_code' => 'required',
            'bank_agency' => 'required',
            'bank_account' => 'required',
            'legal_representative_name' => 'required',
            'legal_representative_cpf' => 'required',
            'legal_representative_email' => 'required',
            'legal_representative_phone' => 'required',
            'proposal_description' => 'required',
            'proposal_value' => 'required',
            'proposal_expiry_date' => 'required',
            'proposal_signed_attachment' => 'required|file|mimes:pdf'
        ]);

        OnlineProposal::create([
            'client_id' => $this->client->id,
            'public_session_id' => $this->publicSession->id,
            'company_name' => $this->company_name,
            'company_cnpj' => $this->company_cnpj,
            'company_IE' => $this->company_IE,
            'company_IM' => $this->company_IM,
            'company_address' => $this->company_address,
            'company_zipcode' => $this->company_zipcode,
            'company_neighborhood' => $this->company_neighborhood,
            'company_number' => $this->company_number,
            'company_state' => $this->company_state,
            'company_city' => $this->company_city,
            'bank_code' => $this->bank_code,
            'bank_agency' => $this->bank_agency,
            'bank_account' => $this->bank_account,
            'legal_representative_name' => $this->legal_representative_name,
            'legal_representative_cpf' => $this->legal_representative_cpf,
            'legal_representative_email' => $this->legal_representative_email,
            'legal_representative_phone' => $this->legal_representative_phone,
            'proposal_description' => $this->proposal_description,
            'proposal_value' => $this->proposal_value,
            'proposal_expiry_date' => $this->proposal_expiry_date,
            'proposal_signed_attachment' => $this->proposal_signed_attachment->store('' , 'attachments')

        ]);


        Notification::make()
            ->title('Nova Proposta')
            ->success()
            ->body('Nova proposta recebida.')
            ->send();

        session()->flash('success', 'Nova proposta recebida com sucesso.');

        return redirect()->route('client.public-session', ['slug' => $this->client->slug]);
    }


    public function render()
    {
        return view('livewire.online-proposal-form');
    }
}
