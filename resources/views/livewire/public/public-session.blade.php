@section('title', 'Sessões Públicas - ' . $client->name)

<div class="p-4 lg:p-8">
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
                    <tr
                        x-on:click="$dispatch('open-modal', { id: '{{$publicSession->id}}' })"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-lg group">
                        <th scope="row" class="px-6 py-6 max-w-xl font-medium text-gray-400 dark:text-white text-justify group-hover:text-black">
                            {{ $this->limitString($publicSession->description, 175 ) }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $publicSession->date }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $publicSession->time }}
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="p-6">
                {{$publicSessions->links()}}
            </div>
            @foreach($publicSessions as $publicSession)
                <x-filament::modal id="{{$publicSession->id}}" width="2xl">
                    <div class="relative overflow-x-auto overflow-hidden rounded-md grid grid-cols-1 gap-y-8">
                        <div>
                            <p class="text-xl font-medium">Descrição</p>
                            <p>{{$publicSession->description}}</p>
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
                            <button class="bg-[#68DC00] py-2 px-4 rounded-lg text-white text-xl font-bold shadow-lg">
                                Ver Edital
                            </button>

                            <button class="bg-[#68DC00] py-2 px-4 rounded-lg text-white text-xl font-bold shadow-lg">
                                Enviar Proposta Online
                            </button>
                        </div>
                </x-filament::modal>
            @endforeach
        </div>

    </div>
</div>
