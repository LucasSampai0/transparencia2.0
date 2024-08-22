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
use Illuminate\Support\Facades\Http;

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
    public $company_city;
    public $company_state;
    public $company_number;
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


    public function searchZipCode($company_zipcode)
    {
        $response = curl_init("https://viacep.com.br/ws/{$company_zipcode}/json/");
        curl_setopt($response, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($response));
        curl_close($response);
        if(is_null($result)){
            session()->flash('company_zipcode', 'CEP não encontrado.');
            return;
        }
        else{
            $this->company_address = $result->logradouro;
            $this->company_neighborhood = $result->bairro;
            $this->company_city = $result->localidade;
            $this->company_state = $result->uf;
        }
    }

    protected $rules = [
        'company_name' => 'required|min:3|max:255',
        'company_cnpj' => 'required|min:18',
        'company_IE' => 'required|regex:/^[0-9\/\-.]+$/',
        'company_IM' => 'required|regex:/^[0-9\/\-.]+$/',
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
        'legal_representative_cpf' => 'required|min:11',
        'legal_representative_email' => 'required|email',
        'legal_representative_phone' => 'required',
        'proposal_description' => 'required',
        'proposal_value' => 'required',
        'proposal_expiry_date' => 'required|date|after:today',
        'proposal_signed_attachment' => 'required|file|mimes:pdf'
    ];
    

    protected $messages = [
        'company_name.required' => 'O campo nome da empresa é obrigatório.',
        'company_name.min' => 'O campo nome da empresa deve ter no mínimo 3 caracteres.',
        'company_name.max' => 'O campo nome da empresa deve ter no máximo 255 caracteres.',
        'company_cnpj.required' => 'O campo CNPJ é obrigatório.',
        'company_cnpj.min' => 'O campo CNPJ deve ter no mínimo 14 caracteres.',
        'company_IE.required' => 'O campo IE é obrigatório.',
        'company_IE.regex' => 'O campo só pode conter números e pontuação ("-" , "/" , "." ).',
        'company_IM.required' => 'O campo IM é obrigatório.',
        'company_IM.regex' => 'O campo só pode conter números e pontuação ("-" , "/" , "." ).',
        'company_address.required' => 'O campo endereço é obrigatório.',
        'company_zipcode.required' => 'O campo CEP é obrigatório.',
        'company_neighborhood.required' => 'O campo bairro é obrigatório.',
        'company_number.required' => 'O campo número é obrigatório.',
        'company_state.required' => 'O campo estado é obrigatório.',
        'company_city.required' => 'O campo cidade é obrigatório.',
        'bank_code.required' => 'O campo código do banco é obrigatório.',
        'bank_agency.required' => 'O campo agência é obrigatório.',
        'bank_account.required' => 'O campo conta é obrigatório.',
        'legal_representative_name.required' => 'O campo nome do representante legal é obrigatório.',
        'legal_representative_cpf.required' => 'O campo CPF do representante legal é obrigatório.',
        'legal_representative_cpf.min' => 'O campo CPF do representante legal deve ter no mínimo 11 caracteres.',
        'legal_representative_email.required' => 'O campo email do representante legal é obrigatório.',
        'legal_representative_email.email' => 'O campo email do representante legal deve ser um email válido.',
        'legal_representative_phone.required' => 'O campo telefone do representante legal é obrigatório.',
        'proposal_description.required' => 'O campo descrição da proposta é obrigatório.',
        'proposal_value.required' => 'O campo valor da proposta é obrigatório.',
        'proposal_expiry_date.required' => 'O campo data de expiração da proposta é obrigatório.',
        'proposal_expiry_date.date' => 'O campo data de expiração da proposta deve ser uma data válida.',
        'proposal_expiry_date.after' => 'O campo data de expiração da proposta deve ser uma data futura.',
        'proposal_signed_attachment.required' => 'O campo anexo da proposta é obrigatório.',

    ];


    public function store()
    {

        $this->mount($this->client->id, $this->publicSession->id);

        $this->proposal_value = str_replace('.', '', $this->proposal_value);
        

        $this->validate();



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
            'proposal_signed_attachment' => $this->proposal_signed_attachment->store('', 'attachments')

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
