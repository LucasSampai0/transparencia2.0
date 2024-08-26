@section('title', 'Investimentos - ' . $client->name)

<div class="p-4 lg:p-8">
    <div class="flex flex-col lg:flex-row gap-4 dark:bg-gray-900">
        <div class="max-w-fit min-w-fit">
            <livewire:date-picker />
        </div>
        <div class="flex flex-col flex-grow gap-6">
            <div class="relative overflow-x-auto sm:rounded-lg bg-white shadow-xl">
                <table class="w-full text-sm dark:bg-gray-700 text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <h2
                                    class="px-6 py-3 uppercase text-xl font-semibold text-white bg-[#68DC00]">
                                    Fornecedores
                                </h2>
                            </th>
                        </tr>
                    </thead>
                    <thead class="text-xs bg-white dark:bg-gray-700 dark:text-gray-400 text-[#3C7034] border-b">
                        <tr class="font-semibold text-lg">
                            <th scope="col" class="px-6 py-3">
                                Categoria
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fornecedor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($spendingSuppliers as $supplier)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-lg group cursor-pointer">
                            <th scope="row"
                                class="p-6 py-4 max-w-xl font-medium text-gray-400 dark:text-white text-justify group-hover:text-black">
                                {{$supplier->category->name}}
                            </th>
                            <th scope="row"
                                class="p-6 py-4  font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">
                                {{$supplier->supplier->name}}
                            </th>
                            <th scope="row"
                                class="p-6 py-4  font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">
                                R$ {{number_format($supplier->total, 2, ',', '.')}}
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($spendingSuppliers->isEmpty())
                <div class="p-6 text-center text-lg text-gray-400 dark:text-gray-500">
                    Nenhum fornecedor encontrado
                </div>
                @endif
                @if($spendingSuppliers->total() > 5)
                <div class="px-6 py-3">
                    {{ $spendingSuppliers->links() }}
                </div>
                @endif
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white shadow-xl">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <h2
                                    class="px-6 py-3 uppercase text-xl font-semibold text-white bg-[#68DC00]">
                                    Veículos
                                </h2>
                            </th>
                        </tr>
                    </thead>
                    <thead class="text-xs bg-white dark:bg-gray-700 dark:text-gray-400 text-[#3C7034] border-b">
                        <tr class="font-semibold text-lg">
                            <th scope="col" class="px-6 py-3">
                                Categoria
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Veículos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($spendingMeans as $mean)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-lg group cursor-pointer">
                            <th scope="row"
                                class="p-6 py-4 max-w-xl font-medium text-gray-400 dark:text-white text-justify group-hover:text-black">
                                {{$mean->category->name}}
                            </th>
                            <th scope="row"
                                class="p-6 py-4 font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">
                                {{$mean->mean->name}}
                            </th>
                            <th scope="row"
                                class="p-6 py-4 font-medium text-gray-400 whitespace-nowrap dark:text-white group-hover:text-black">
                                R$ {{number_format($mean->total, 2, ',', '.')}}
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($spendingMeans->isEmpty())
                <div class="p-6 text-center text-lg text-gray-400 dark:text-gray-500">
                    Nenhum veículo encontrado
                </div>
                @endif
                @if($spendingMeans->total() > 5)
                <div class="px-6 py-3">
                    {{ $spendingMeans->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>