@section('title', 'Sessões Públicas - ' . $client->name)


<div class="p-4 lg:p-8 dark:bg-gray-900">
    <div x-data="{ showToast: true }" x-init="setTimeout(() => showToast = false, 10000)" class="absolute right-3 top-3 z-10">
        @if(session('success'))
        <div id="toast-success" x-show="showToast" x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">Sua proposta foi enviada com sucesso.</div>
            <button type="button"

                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close" x-on:click="showToast = false">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif
    </div>
    @if(
    $publicSessions->isEmpty()
    )
    <div class="text-center">
        <p class="text-2xl font-semibold text-[#3C7034]">
            Nenhum registro encontrado
        </p>
    </div>
    @else
    <div class="grid grid-cols-1 xl:grid-cols-1 gap-12">
        <div class="relative overflow-x-auto sm:rounded-lg bg-white shadow-xl">
            <table class="w-full text-sm bg-white text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead>
                    <tr class="px-6 py-3 uppercase text-xl font-semibold text-white bg-[#68DC00]">
                        <th scope="col" colspan="3" class="px-6 py-3">
                            Sessões Públicas
                        </th>
                    </tr>
                </thead>
                <thead class="text-xs uppercase bg-white dark:bg-gray-700 dark:text-gray-400 text-[#3C7034] border-b">
                    <tr class="font-semibold text-lg">
                        <th scope="col" class="px-6 py-3">
                            Descrição
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hora
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicSessions as $publicSession)
                    <tr x-on:click="$dispatch('open-modal', { id: '{{$publicSession->id}}' })"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 group cursor-pointer">
                        <th scope="row"
                            class="p-6 py-4 max-w-xl font-medium text-gray-400 dark:text-white text-justify group-hover:text-black">
                            {{ $this->limitString($publicSession->description, 175 ) }}
                        </th>
                        <th scope="row"
                            class="p-6 py-4 font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">


                            {{ \Carbon\Carbon::parse($publicSession->date)->format('d/m/Y') }}

                        </th>
                        <th scope="row"
                            class="p-6 py-4 font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">
                            {{ $publicSession->time }}
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($publicSessions->total() > 5)
            <div class="p-6">
                {{$publicSessions->links()}}
            </div>
            @endif
        </div>

    </div>
    @foreach($publicSessions as $publicSession)
    <x-filament::modal :close-button="true" id="{{$publicSession->id}}" width="2xl">
        <div class="relative overflow-x-auto overflow-hidden rounded-md grid grid-cols-1 gap-y-8 dark:!text-white">
            <div>
                <p class="text-xl font-medium">Descrição</p>
                <div class="max-h-[18rem] overflow-y-auto">
                    <p>{{$publicSession->description}}</p>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div>
                    <p class="text-xl font-medium">Data</p>
                    <p>{{ \Carbon\Carbon::parse($publicSession->date)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-xl font-medium">Hora</p>
                    <p>{{$publicSession->time}}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 p-4">
                <button>
                <a href="{{ asset('storage/attachments/' . $publicSession->attachment) }}"
                    class="bg-[#68DC00] py-2 px-4 rounded-lg text-white text-xl font-bold shadow-lg text-center">
                    Ver Edital
                </a>
            </button>
                <button class="bg-[#68DC00] py-2 px-4 rounded-lg text-white text-xl font-bold shadow-lg"
                    x-on:click="$dispatch('open-modal', { id: 'online-proposal-{{$publicSession->id}}' })">
                    Enviar Proposta Online
                </button>
            </div>
        </div>
        <x-filament::modal :close-button="true" id="online-proposal-{{$publicSession->id}}" width="5xl">
            <div class="relative overflow-x-auto overflow-hidden rounded-md grid grid-cols-1 gap-y-8">
                @livewire('online-proposal-form', ['client_id' => $client->id, 'public_session_id' =>
                $publicSession->id])
            </div>
        </x-filament::modal>
    </x-filament::modal>
    @endforeach

    @endif
</div>