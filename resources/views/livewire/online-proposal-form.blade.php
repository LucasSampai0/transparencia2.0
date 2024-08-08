<div x-data="{step: 1}">
    <div>
        <div class="grid grid-cols-4 rounded-md overflow-hidden">
            <p x-on:click="step = 1"
                :class="{ 'bg-[#93DD00] text-white font-bold cursor-pointer p-2': step === 1, 'bg-gray-100 font-bold cursor-pointer p-2': step !== 1 }">
                Dados Iniciais</p>
            <p x-on:click="step = 2"
                :class="{ 'bg-[#93DD00] text-white font-bold cursor-pointer p-2': step === 2, 'bg-gray-100 font-bold cursor-pointer p-2': step !== 2 }">
                Dados Bancários</p>
            <p x-on:click="step = 3"
                :class="{ 'bg-[#93DD00] text-white font-bold cursor-pointer p-2': step === 3, 'bg-gray-100 font-bold cursor-pointer p-2': step !== 3 }">
                Representante Legal</p>
            <p x-on:click="step = 4"
                :class="{ 'bg-[#93DD00] text-white font-bold cursor-pointer p-2': step === 4, 'bg-gray-100 font-bold cursor-pointer p-2': step !== 4 }">
                Informações da Proposta</p>
        </div>
    </div>
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div x-show="step === 1">
            <div class="grid grid-cols-6 gap-4 my-6">
                <div class="col-span-3">
                    <x-label for="company_name">Razão Social</x-label>
                    <x-input class="w-full" wire:model="company_name" id="company_name" type="text"></x-input>

                </div>
                <div class="col-span-3">
                    <x-label for="company_cnpj">CNPJ</x-label>
                    <x-input class="w-full" wire:model="company_cnpj" id="company_cnpj" type="text"></x-input>
                </div>
                <div class="col-span-3">
                    <x-label for="company_IE">Inscrição Estadual</x-label>
                    <x-input class="w-full" wire:model="company_IE" id="company_IE" type="text"></x-input>
                </div>
                <div class="col-span-3">
                    <x-label for="company_IM">Inscrição Municipal</x-label>
                    <x-input class="w-full" wire:model="company_IM" id="company_IM" type="text"></x-input>
                </div>
                <div class="col-span-2">
                    <x-label for="company_zipcode">CEP</x-label>
                    <x-input class="w-full" wire:model="company_zipcode" id="company_zipcode" type="text"></x-input>
                </div>
                <div class="col-span-4">
                    <x-label for="company_address">Endereço</x-label>
                    <x-input class="w-full" wire:model="company_address" id="company_address" type="text"></x-input>
                </div>
                <div class="col-span-2">
                    <x-label for="company_neighborhood">Bairro</x-label>
                    <x-input class="w-full" wire:model="company_neighborhood" id="company_neighborhood" type="text">
                    </x-input>
                </div>
                <div class="col-span-1">
                    <x-label for="company_number">Número</x-label>
                    <x-input class="w-full" wire:model="company_number" id="company_number" type="text"></x-input>
                </div>
                <div class="col-span-1">
                    <x-label for="company_state">Estado</x-label>
                    <x-input class="w-full" wire:model="company_state" id="company_state" type="text"></x-input>
                </div>
                <div class="col-span-2">
                    <x-label for="company_city">Cidade</x-label>
                    <x-input class="w-full" wire:model="company_city" id="company_city" type="text"></x-input>
                </div>
            </div>
            <div class="inline-flex justify-end w-full">
                <p class="p-2 bg-[#93DD00] text-white cursor-pointer rounded-md" @click="step++">Próximo</p>
            </div>
        </div>
        <div x-show="step === 2">

            <div class="grid grid-cols-3 gap-4 my-6">
                <div>
                    <x-label for="bank_code">Número do Banco</x-label>
                    <x-input class="w-full" wire:model="bank_code" id="bank_code" type="text"></x-input>
                </div>
                <div>
                    <x-label for="bank_agency">Agência</x-label>
                    <x-input class="w-full" wire:model="bank_agency" id="bank_agency" type="text"></x-input>
                </div>
                <div>
                    <x-label for="bank_account">Conta</x-label>
                    <x-input class="w-full" wire:model="bank_account" id="bank_account" type="text"></x-input>
                </div>
            </div>
            <div class="inline-flex justify-between w-full">
                <p class="p-2 bg-red-500 text-white cursor-pointer rounded-md" @click="step--">Anterior</p>
                <p class="p-2 bg-[#93DD00] text-white cursor-pointer rounded-md" @click="step++">Próximo</p>
            </div>

        </div>
        <div x-show="step === 3">
            <div class="grid grid-cols-2 gap-4 my-6">

                <div>
                    <x-label for="legal_representative_name">Nome</x-label>
                    <x-input class="w-full" wire:model="legal_representative_name" id="legal_representative_name"
                        type="text"></x-input>
                </div>
                <div>
                    <x-label for="legal_representative_cpf">CPF</x-label>
                    <x-input class="w-full" wire:model="legal_representative_cpf" id="legal_representative_cpf"
                        type="text"></x-input>
                </div>
                <div>
                    <x-label for="legal_representative_email">Email</x-label>
                    <x-input class="w-full" wire:model="legal_representative_email" id="legal_representative_email"
                        type="text"></x-input>
                </div>
                <div>
                    <x-label for="legal_representative_phone">Telefone</x-label>
                    <x-input class="w-full" wire:model="legal_representative_phone" id="legal_representative_phone"
                        type="text"></x-input>
                </div>

            </div>
            <div class="inline-flex justify-between w-full">
                <p class="p-2 bg-red-500 text-white cursor-pointer rounded-md" @click="step--">Anterior</p>
                <p class="p-2 bg-[#93DD00] text-white cursor-pointer rounded-md" @click="step++">Próximo</p>

            </div>
        </div>
        <div x-show="step === 4">
            <div class="grid grid-cols-3 gap-4 my-6">
                <div class="col-span-3">
                    <x-label for="proposal_description">Descrição da Proposta</x-label>
                    <textarea rows="5" wire:model="proposal_description"
                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        id="proposal_description" type="text"></textarea>
                </div>
                <div>
                    <x-label for="proposal_value">Valor da Proposta</x-label>
                    <x-input class="w-full" wire:model="proposal_value" id="proposal_value" type="text"></x-input>
                </div>
                <div>
                    <x-label for="proposal_expiry_date">Data de Vencimento</x-label>
                    <x-input class="w-full" wire:model="proposal_expiry_date" id="proposal_expiry_date" type="date">
                    </x-input>
                </div>
                <div>
                    <x-label for="proposal_signed_attachment">Proposta Assinada</x-label>
                    <x-input class="w-full" wire:model="proposal_signed_attachment" id="proposal_signed_attachment"
                        type="file"></x-input>
                </div>
                <div class="inline-flex col-span-3 gap-x-2">
                    <x-checkbox name="allowance" id="allowance" required></x-checkbox>
                    <x-label for="allowance">Eu concordo em salvar meus dados para fins de consulta.</x-label>
                </div>

            </div>
            <div class="inline-flex justify-between w-full">
                <p class="p-2 bg-red-500 text-white cursor-pointer rounded-md" @click="step--">Anterior</p>
                <x-button type="submit">Salvar</x-button>
            </div>
        </div>
    </form>
</div>