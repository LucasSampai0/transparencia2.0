@section('title', $client->name)

<div class="flex flex-row flex-grow overflow-x-hidden" x-data="{ open: false }">
    <div class="p-8 dark:bg-gray-900">
        <div class="flex justify-end mb-8">
            <x-button class="!bg-[#93DD00] dark:text-gray-950" x-on:click="open = !open">
                Resumo de investimentos
            </x-button>
        </div>
        <div
            class=" dark:text-white flex flex-col-reverse gap-y-8 justify-between md:flex-row p-4 mb-8 gap-x-8 rounded-lg bg-gray-50 dark:bg-gray-700 overflow-hidden">
            <div class="gap-3">
                <h1 class="text-3xl font-bold mb-5">Bem vindo ao transparencia.ppg</h1>
                <p class="text-lg max-w-4xl mb-5">
                    Este portal é dirigido à administração pública e está em acordo com as diretrizes da Lei 12.232 de
                    29 de abril de 2010, em cumprimento do ao artigo 16.
                </p>
                <button
                    class="px-5 py-2 bg-[#93DD00] rounded-tr-xl translate-x-[-9rem] translate-y-4 relative hover:translate-x-[-1rem] transition">
                    <a class="text-2xl text-white flex gap-x-6" href="">
                        Ver mais
                        <x-heroicon-c-chevron-right class="w-8 h-8" />
                    </a>
                </button>
            </div>
            <div class="content-center">
                <img class="w-full max-w-80" src="{{ asset('storage/logos/logo.png') }}" alt="Logo">
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-4 gap-8 mb-4">
            <a class="group flex flex-col items-center justify-between bg-gray-50 dark:bg-gray-700 rounded-lg pt-8 gap-12 overflow-hidden"
                href="{{route('client.mean', ['slug' => $client->slug])}}">
                <div class="flex flex-col items-center gap-y-6">
                    <x-heroicon-o-tv class="w-32 h-32 text-[#93dd00]" />
                    <h4 class="text-center text-xl font-bold text-[#3C7034] dark:text-white px-6">Relação de Veículos
                    </h4>
                </div>
                <button
                    class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                    Ver mais
                </button>
            </a>
            <a class="group flex flex-col items-center justify-between bg-gray-50 dark:bg-gray-700 rounded-lg pt-8 gap-12 overflow-hidden"
                href="{{route('client.supplier', ['slug' => $client->slug])}}">
                <div class="flex flex-col items-center gap-y-6">
                    <x-heroicon-o-user-group class="w-32 h-32 text-[#93dd00]" />
                    <h4 class="text-center text-xl font-bold text-[#3C7034] dark:text-white px-6">Relação de
                        Fornecedores de Serviços
                        Complementares</h4>
                </div>
                <button
                    class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                    Ver mais
                </button>
            </a>
            <a class="group flex flex-col items-center justify-between bg-gray-50 dark:bg-gray-700 rounded-lg pt-8 gap-12 overflow-hidden"
                href="{{route('client.spending', ['slug' => $client->slug])}}">
                <div class="flex flex-col items-center gap-y-6">
                    <x-heroicon-o-document-chart-bar class="w-32 h-32 text-[#93dd00]" />
                    <h4 class="text-center text-xl font-bold text-[#3C7034] dark:text-white px-6">Relatório de
                        Investimentos em
                        Publicidade</h4>
                </div>
                <button
                    class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                    Ver mais
                </button>
            </a>
            <a class="group flex flex-col items-center justify-between bg-gray-50 dark:bg-gray-700 rounded-lg pt-8 gap-12 overflow-hidden"
                href="{{route('client.public-session', ['slug' => $client->slug])}}">
                <div class="flex flex-col items-center gap-y-6">
                    <x-heroicon-o-megaphone class="w-32 h-32 text-[#93dd00]" />
                    <h4 class="text-center text-xl font-bold text-[#3C7034] dark:text-white  px-6">Sessão Pública</h4>
                </div>
                <button
                    class="w-full px-4 py-1 bg-[#93DD00] relative translate-y-full group-hover:translate-y-0 transition text-xl text-white flex justify-center">
                    Ver mais
                </button>
            </a>
        </div>
    </div>
    <div x-show="open" x-cloak x-on:click.away="open = false"
        class="bg-white dark:bg-gray-700 border-l p-3 min-w-96 right-0 h-dvh sticky lg:h-auto">
        <div>
            <livewire:date-picker></livewire:date-picker>
            @foreach($spendings as $spending)
            <div class="flex justify-between items-center border-b p-2">
                <h1 class="font-bold">{{$spending->category->name}}</h1>
                <h1>R$ {{number_format($spending->total, 2, ',', '.')}}</h1>
            </div>
            @endforeach
            <div class="flex justify-between items-center border-b p-2">
                <h1 class="font-bold">Total</h1>
                <h1>R$ {{number_format($totalSpendings, 2, ',', '.')}}</h1>
            </div>
        </div>
    </div>
</div>