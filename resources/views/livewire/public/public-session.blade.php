@section('title', 'Sessões Públicas - ' . $client->name)

<div class="p-4 lg:p-8">
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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white shadow-xl">
                <table class="w-full text-sm bg-white text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-white dark:bg-gray-700 dark:text-gray-400 text-[#3C7034] border-b">
                    <h2 class="px-6 py-3 text-3xl font-semibold text-white bg-[#68DC00]">
                        Sessões Públicas
                    </h2>
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
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-lg group cursor-pointer">
                            <th scope="row" class="p-6 py-4 max-w-xl font-medium text-gray-400 dark:text-white text-justify group-hover:text-black">
                                {{ $this->limitString($publicSession->description, 175 ) }}
                            </th>
                            <th scope="row" class="p-6 py-4 font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">
                                {{ $publicSession->date }}
                            </th>
                            <th scope="row" class="p-6 py-4 font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">
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
                <div class="relative overflow-x-auto overflow-hidden rounded-md grid grid-cols-1 gap-y-8">
                    <div>
                        <p class="text-xl font-medium">Descrição</p>
                        <div class="max-h-[18rem] overflow-y-auto">
                            <p>{{$publicSession->description}}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div>
                            <p class="text-xl font-medium">Data</p>
                            <p>{{$publicSession->date }}</p>
                        </div>
                        <div>
                            <p class="text-xl font-medium">Hora</p>
                            <p>{{$publicSession->time}}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6 p-4">
                        <a href="{{ asset('storage/attachments/' . $publicSession->attachment) }}" class="bg-[#68DC00] py-2 px-4 rounded-lg text-white text-xl font-bold shadow-lg text-center">
                            <button >
                                Ver Edital
                            </button>
                        </a>
                        <button class="bg-[#68DC00] py-2 px-4 rounded-lg text-white text-xl font-bold shadow-lg">
                            Enviar Proposta Online
                        </button>
                    </div>
                </div>
            </x-filament::modal>
        @endforeach

    @endif
</div>
