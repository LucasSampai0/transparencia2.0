<?php

namespace App\Models;

use App\Filament\Resources\PublicSessionResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'public_session_id',
        'company_name',
        'company_cnpj',
        'company_IE',
        'company_IM',
        'company_zipcode',
        'company_address',
        'company_neighborhood',
        'company_number',
        'company_state',
        'company_city',
        'bank_code',
        'bank_agency',
        'bank_account',
        'legal_representative_name',
        'legal_representative_cpf',
        'legal_representative_email',
        'legal_representative_phone',
        'proposal_description',
        'proposal_value',
        'proposal_expiry_date',
        'proposal_signed_attachment',
    ];

    public function publicSession()
    {
        return $this->belongsTo(PublicSession::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
