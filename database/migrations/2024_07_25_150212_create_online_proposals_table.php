<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('online_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('public_session_id')->constrained()->cascadeOnDelete();
            $table->string('company_name');
            $table->string('company_cnpj');
            $table->string('company_IE');
            $table->string('company_IM');
            $table->string('company_zipcode');
            $table->string('company_address');
            $table->string('company_neighborhood');
            $table->string('company_number');
            $table->string('company_state');
            $table->string('company_city');
            $table->string('bank_code');
            $table->string('bank_agency');
            $table->string('bank_account');
            $table->string('legal_representative_name');
            $table->string('legal_representative_cpf');
            $table->string('legal_representative_email');
            $table->string('legal_representative_phone');
            $table->text('proposal_description');
            $table->decimal('proposal_value', 10, 2);
            $table->date('proposal_expiry_date');
            $table->string('proposal_signed_attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_proposals');
    }
};
