@section('title', $client->name)

<div class="flex flex-row w-screen">
    <div>

        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
                class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                      d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>

        <aside id="logo-sidebar" class="border-r fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo"/>
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                </a>
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>

    <div class="sm:ml-64 w-full min-h-screen">
        <div class="grid rounded-lg dark:border-gray-700">
            <div class="flex items-center justify-start gap-4 p-4 border-b bg-gray-50 dark:bg-gray-800">
                <div>
                    <a href="{{$client->slug}}">
                        <img class="w-32 h-32 rounded-full " src="{{ Storage::disk('logos')->url($client->logo) }}" alt="{{$client->name}}">
                    </a>
                </div>
                <div class="gap-y-2 flex flex-col">
                    <h1 class="text-2xl font-bold">{{$client->name}}</h1>
                    <h2 class="text-xl">{{$client->address}}</h2>
                    <h2>{{$client->cnpj}}</h2>
                    <div class="flex gap-5">
                        @if(isset($client->phone))
                            <div class="flex">
                                <x-heroicon-o-phone class="w-5 h-5"/>
                                <h2>{{$client->phone}}</h2>
                            </div>
                        @endif
                        @if(isset($client->site))
                            <div>
                                <a class="flex" href="{{$client->site}}">
                                    <x-heroicon-o-globe-alt class="w-5 h-5"/>
                                    <h2>{{$client->site}}</h2>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="p-4 grow bg-blue-200">
                    <div class="grid p-4 mb-4 rounded-lg bg-gray-50 dark:bg-gray-800 grid-cols-6">
                        <div class="col-span-5 gap-3">
                            <h1 class="text-3xl font-bold mb-5">Bem vindo ao transparencia.ppg</h1>
                            <p class="text-lg max-w-4xl mb-5">
                                Este portal é dirigido à administração pública e está em acordo com as diretrizes da Lei 12.232 de 29 de abril de 2010, em cumprimento do ao artigo 16.
                            </p>
                            <button class="px-5 py-2 bg-[#93DD00] rounded-full">
                                <a class="text-2xl text-white flex gap-x-5" href="">
                                    Ver mais
                                    <x-heroicon-c-chevron-right class="w-8 h-8"/>
                                </a>
                            </button>
                        </div>
                        <div class="col-span-1 content-center">
                            <img src="{{ asset('storage/logos/logo.png') }}" alt="Logo">
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-8 mb-4">
                        <div class="flex flex-col items-center justify-center rounded bg-gray-50 dark:bg-gray-800 rounded-lg py-8 px-6 gap-12">
                            <x-heroicon-o-tv class="w-32 h-32 text-[#93dd00]"/>
                            <h4 class="text-center text-xl font-bold text-[#3C7034]">Relação de Veículos</h4>
                            <button class="px-4 py-1 bg-[#93DD00] rounded-full">
                                <a class="text-xl text-white flex gap-x-5" href="">
                                    Ver mais
                                    <x-heroicon-c-chevron-right class="w-8 h-8"/>
                                </a>
                            </button>
                        </div>
                        <div class="flex flex-col items-center justify-center rounded bg-gray-50 dark:bg-gray-800 rounded-lg py-8 px-6 gap-12">
                            <x-heroicon-o-tv class="w-32 h-32 text-[#93dd00]"/>
                            <h4 class="text-center text-xl font-bold text-[#3C7034]">Relação de Fornecedores de Serviços Complementares
                            </h4>
                            <button class="px-4 py-1 bg-[#93DD00] rounded-full">
                                <a class="text-xl text-white flex gap-x-5" href="">
                                    Ver mais
                                    <x-heroicon-c-chevron-right class="w-8 h-8"/>
                                </a>
                            </button>
                        </div>
                        <div class="flex flex-col items-center justify-center rounded bg-gray-50 dark:bg-gray-800 rounded-lg py-8 px-6 gap-12">
                            <x-heroicon-o-tv class="w-32 h-32 text-[#93dd00]"/>
                            <h4 class="text-center text-xl font-bold text-[#3C7034]">Relatório de Investimentos em Publicidade</h4>
                            <button class="px-4 py-1 bg-[#93DD00] rounded-full">
                                <a class="text-xl text-white flex gap-x-5" href="">
                                    Ver mais
                                    <x-heroicon-c-chevron-right class="w-8 h-8"/>
                                </a>
                            </button>
                        </div>
                        <div class="flex flex-col items-center justify-center rounded bg-gray-50 dark:bg-gray-800 rounded-lg py-8 px-6 gap-12">
                            <x-heroicon-o-tv class="w-32 h-32 text-[#93dd00]"/>
                            <h4 class="text-center text-xl font-bold text-[#3C7034]">Sessão Pública</h4>
                            <button class="px-4 py-1 bg-[#93DD00] rounded-full">
                                <a class="text-xl text-white flex gap-x-5" href="">
                                    Ver mais
                                    <x-heroicon-c-chevron-right class="w-8 h-8"/>
                                </a>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">

                        </div>
                        <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">

                        </div>
                    </div>
                </div>
                <div class="p-4 grow min-w-[16rem] border-l bg-red-200">
                    <h1>Teste</h1>
                </div>
            </div>
        </div>
    </div>
</div>
