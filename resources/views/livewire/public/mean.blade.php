@section('title', 'Relação de veículos - ' . $client->name)

<div class="p-4 lg:p-8 dark:bg-gray-900">
    @if($categories->isEmpty())
    <div class="text-center">
        <p class="text-2xl font-semibold text-[#3C7034]">
            Nenhum registro encontrado
        </p>
    </div>
    @else
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        @foreach($categories as $category)
        <div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                <table
                    class="w-full text-sm bg-white text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="px-6 py-3 uppercase text-xl font-semibold text-white bg-[#68DC00]">
                            <th scope="col" colspan="3" class="px-6 py-3">
                                {{$category->name}}
                            </th>
                        </tr>
                    </thead>
                    <thead
                        class="text-xs uppercase bg-white dark:bg-gray-700 dark:text-gray-400 text-[#3C7034] border-b">
                        <tr class="font-semibold">
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                CNPJ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Documentos
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($means[$category->id] as $mean)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p>{{$mean->name}}</p>
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p>{{$mean->cnpj}}</p>
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if($mean->meanAttachments->count() > 0)
                                <button class="inline-flex"
                                    x-on:click="$dispatch('open-modal', { id: '{{$mean->id}}' })">
                                    <x-heroicon-o-paper-clip class="w-5 h-5" />
                                    Documentos
                                    ({{$mean->meanAttachments->count()}})
                                </button>
                                @endif

                            </th>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                @if($means[$category->id]->total() > 5)
                <div class="px-6 py-2 font-medium text-gray-900 ">
                    {{ $means[$category->id]->links() }}
                </div>
                @endif
            </div>
        </div>
        @endforeach

    </div>
    @foreach($categories as $category)
    @foreach($means[$category->id] as $mean)
    <x-filament::modal :close-button="true" id="{{$mean->id}}" width="2xl">
        <div class="relative overflow-x-auto overflow-hidden rounded-md">
            <table class="w-full text-md text-left text-gray-700">
                <tbody>
                    @if($mean->meanAttachments->isEmpty())
                    <tr>
                        <td class="text-center py-4">
                            Nenhum registro encontrado
                        </td>
                    </tr>
                    @endif

                    @foreach($mean->meanAttachments as $attachment)
                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="flex">
                            <a class="px-6 py-3 w-full" href="{{ asset('storage/attachments/' . $attachment->file) }}"
                                target="_blank">
                                {{ $attachment->title }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::modal>
    @endforeach
    @endforeach
    @endif
</div>