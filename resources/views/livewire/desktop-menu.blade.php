<div id="desktop_menu">
    <div class="min-h-screen bg-white hidden md:flex transition-all -translate-x-64 z-50 border-r fixed dark:border-black dark:bg-gray-800"
        x-bind:class="{'translate-x-0': open, '-translate-x-64': !open}" x-on:click.away="open = false">
        <div class="w-64 p-4">
            <div class="mb-8">
                <a href="/{{$client->slug}}">
                    <img src="{{Storage::disk('logos')->url('logo.png')}}" alt="" class="w-56">
                </a>
            </div>
            <div class="text-xl flex flex-col gap-4 dark:text-white">
                <a href="{{route('client.mean', ['slug' => $client->slug])}}">
                    <div class="inline-flex gap-x-2">
                        <x-heroicon-o-tv class="w-7 h-7" />
                        Veículos
                    </div>
                </a>
                <a href="{{route('client.supplier', ['slug' => $client->slug])}}">
                    <div class="inline-flex gap-x-2">
                        <x-heroicon-o-user-group class="w-7 h-7" />
                        Fornecedores
                    </div>
                </a>
                <a href="{{route('client.spending', ['slug' => $client->slug])}}">
                    <div class="inline-flex gap-x-2">
                        <x-heroicon-o-document-chart-bar class="w-7 h-7" />
                        Investimentos
                    </div>
                </a>
                <a href="{{route('client.public-session', ['slug' => $client->slug])}}">
                    <div class="inline-flex gap-x-2">
                        <x-heroicon-o-users class="w-7 h-7" />
                        Sessões Públicas
                    </div>
                </a>
            </div>
        </div>
        <div class="p-2 py-4 transition-all"
            x-bind:class="{'bg-white text-black dark:text-white dark:bg-gray-800': open, 'bg-[#93dd00] text-black dark:text-black': !open}" x-cloak>
            <button x-on:click="open = !open" class="w-6 h-6 md:w-8 md:h-8 rounded-lg cursor-pointer flex items-center justify-center">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>