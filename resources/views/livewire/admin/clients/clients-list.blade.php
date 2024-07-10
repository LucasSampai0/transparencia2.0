<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Clientes' )}}
        </h2>
    </x-slot>

    <div class="container mx-auto max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="relative shadow-md sm:rounded-lg">
            <table class="w-full overflow-x-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('ID')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Foto')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Nome')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('CNPJ')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Endereço')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
                </thead>
                <tbody>
                @if ($clients->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            Nenhum registro encontrado
                        </td>
                    </tr>
                @endif
                @foreach($clients as $client)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center me-4">
                                <input
                                    type="checkbox"
                                    value="{{$client->id}}"
                                    x-model="checked"
                                    wire:model="selected"
                                    class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ $client->id}}
                        </td>
                        <td class="px-6 py-4">
                            <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}">
                        </td>
                        <td class="px-6 py-4">
                            {{$client->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$client->cnpj}}
                        </td>
                        <td class="px-6 py-4">
                            {{$client->address}}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button class="text-white px-4 py-2 dark:text-gray-300 dark:hover:text-gray-100 bg-blue-500 hover:bg-blue-600 rounded-md">
                                        Opções
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('admin.clients.create', $client->slug) }}" class="inline-flex">
                                        <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        {{ __('Editar') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.clients.create', $client->slug) }}" class="inline-flex">
                                        <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>
                                        {{ __('Visualizar') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.clients.create', $client->slug) }}" class="inline-flex">
                                        <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 9H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6m0-6v6m0-6 5.419-3.87A1 1 0 0 1 18 5.942v12.114a1 1 0 0 1-1.581.814L11 15m7 0a3 3 0 0 0 0-6M6 15h3v5H6v-5Z"/>
                                        </svg>
                                        {{ __('Veículos')}}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.clients.create', $client->slug) }}" class="inline-flex">
                                        <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                  d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                                        </svg>
                                        {{ __('Sessões Públicas')}}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.clients.create', $client->slug) }}" class="inline-flex">
                                        <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2"
                                                  d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"/>
                                        </svg>

                                        {{ __('Fornecedores')}}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.clients.create', $client->slug) }}" class="inline-flex">
                                        <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                             viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                  d="M9 15a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm3.845-1.855a2.4 2.4 0 0 1 1.2-1.226 1 1 0 0 1 1.992-.026c.426.15.809.408 1.111.749a1 1 0 1 1-1.496 1.327.682.682 0 0 0-.36-.213.997.997 0 0 1-.113-.032.4.4 0 0 0-.394.074.93.93 0 0 0 .455.254 2.914 2.914 0 0 1 1.504.9c.373.433.669 1.092.464 1.823a.996.996 0 0 1-.046.129c-.226.519-.627.94-1.132 1.192a1 1 0 0 1-1.956.093 2.68 2.68 0 0 1-1.227-.798 1 1 0 1 1 1.506-1.315.682.682 0 0 0 .363.216c.038.009.075.02.111.032a.4.4 0 0 0 .395-.074.93.93 0 0 0-.455-.254 2.91 2.91 0 0 1-1.503-.9c-.375-.433-.666-1.089-.466-1.817a.994.994 0 0 1 .047-.134Zm1.884.573.003.008c-.003-.005-.003-.008-.003-.008Zm.55 2.613s-.002-.002-.003-.007a.032.032 0 0 1 .003.007ZM4 14a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0v-4a1 1 0 0 1 1-1Zm3-2a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm6.5-8a1 1 0 0 1 1-1H18a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-.796l-2.341 2.049a1 1 0 0 1-1.24.06l-2.894-2.066L6.614 9.29a1 1 0 1 1-1.228-1.578l4.5-3.5a1 1 0 0 1 1.195-.025l2.856 2.04L15.34 5h-.84a1 1 0 0 1-1-1Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Investimentos')}}sa
                                    </x-dropdown-link>
                                    <x-dropdown-link class="cursor-pointer inline-flex" x-data x-on:click="$dispatch('open-modal', {id:'{{$client->id}}'})">
                                        <svg class="w-[18px] h-[18px] text-grey-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>
                                        {{ __('Excluir') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>


    </div>
