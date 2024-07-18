<div class="grid grid-cols-1 xl:grid-cols-2 gap-12">
    @foreach($categories as $category)
        <div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                <table class="w-full text-sm bg-white text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-white dark:bg-gray-700 dark:text-gray-400 text-[#3C7034]">
                    <h2 class="px-6 py-3 text-2xl font-semibold  text-[#3C7034]">
                        {{$category->name}}
                    </h2>
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
                    @foreach($means as $mean)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p>{{$mean->name}}</p>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p>{{$mean->cnpj}}</p>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <button class="inline-flex"
                                        x-on:click="$dispatch('open-modal', { id: '{{$mean->id}}' })">
                                    <x-heroicon-o-paper-clip class="w-5 h-5"/>
                                    Documentos
                                    ({{$mean->meanAttachments->count()}})
                                </button>
                            </th>
                        </tr>
                    @endforeach
                    {{ $means->links() }}

                    </tbody>
                </table>
            </div>
            <x-filament::modal id="{{$mean->id}}">
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
                                    <a class="px-6 py-3  w-full" href="{{ asset('storage/attachments/' . $attachment->file) }}" target="_blank">
                                        {{ $attachment->title }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </x-filament::modal>
        </div>

    @endforeach
</div>
