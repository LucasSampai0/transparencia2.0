@section('title', $client->name)

<div class="flex flex-row flex-grow">
    <div class="p-8">
        <div class="grid p-4 mb-8 rounded-lg bg-gray-50 dark:bg-gray-800 grid-cols-6 overflow-hidden">
            <div class="col-span-5 gap-3">
                <h1 class="text-3xl font-bold mb-5">Bem vindo ao transparencia.ppg</h1>
                <p class="text-lg max-w-4xl mb-5">
                    Este portal é dirigido à administração pública e está em acordo com as diretrizes da Lei 12.232 de 29 de abril de 2010, em cumprimento do ao artigo 16.
                </p>
                <button class="px-5 py-2 bg-[#93DD00] rounded-tr-xl translate-x-[-9rem] translate-y-4 relative hover:translate-x-[-1rem] transition">
                    <a class="text-2xl text-white flex gap-x-6" href="">
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
            <a class="group flex flex-col items-center justify-between rounded bg-gray-50 dark:bg-gray-800 rounded-lg pt-8 gap-12 overflow-hidden" href="{{route('client.mean', ['slug' => $client->slug])}}">
                    <div class="flex flex-col items-center gap-y-6">
                        <x-heroicon-o-tv class="w-32 h-32 text-[#93dd00]"/>
                        <h4 class="text-center text-xl font-bold text-[#3C7034]  px-6">Relação de Veículos</h4>
                    </div>
                    <button class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                        Ver mais
                    </button>
            </a>
            <a class="group flex flex-col items-center justify-between rounded bg-gray-50 dark:bg-gray-800 rounded-lg pt-8 gap-12 overflow-hidden" href="{{route('client.supplier', ['slug' => $client->slug])}}">
                <div class="flex flex-col items-center gap-y-6">
                    <x-heroicon-o-user-group class="w-32 h-32 text-[#93dd00]"/>
                    <h4 class="text-center text-xl font-bold text-[#3C7034]  px-6">Relação de Fornecedores de Serviços Complementares</h4>
                </div>
                <button class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                    Ver mais
                </button>
            </a>
            <a class="group flex flex-col items-center justify-between rounded bg-gray-50 dark:bg-gray-800 rounded-lg pt-8 gap-12 overflow-hidden" href="{{route('client.spending', ['slug' => $client->slug])}}">
                <div class="flex flex-col items-center gap-y-6">
                    <x-heroicon-o-document-chart-bar class="w-32 h-32 text-[#93dd00]"/>
                    <h4 class="text-center text-xl font-bold text-[#3C7034] px-6">Relatório de Investimentos em Publicidade</h4>
                </div>
                <button class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                        Ver mais
                </button>
            </a>
            <a class="group flex flex-col items-center justify-between rounded bg-gray-50 dark:bg-gray-800 rounded-lg pt-8 gap-12 overflow-hidden" href="{{route('client.public-session', ['slug' => $client->slug])}}">
                <div class="flex flex-col items-center gap-y-6">
                    <x-heroicon-o-megaphone class="w-32 h-32 text-[#93dd00]"/>
                    <h4 class="text-center text-xl font-bold text-[#3C7034]  px-6">Sessão Pública</h4>
                </div>
                <button class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                        Ver mais
                </button>
            </a>
        </div>
        {{--        <div class="grid grid-cols-2 gap-4">--}}
        {{--            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">--}}

        {{--            </div>--}}
        {{--            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">--}}

        {{--            </div>--}}
        {{--        </div>--}}
    </div>
    <div class="py-4 px-12 min-w-[24rem] border-l  bg-gray-50">
        <h1>Teste</h1>
    </div>
</div>


