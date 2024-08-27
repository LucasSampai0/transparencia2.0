<div id="mobile_menu" class="md:hidden">
    <div class="bg-[#93dd00] p-2 flex justify-end z-30 relative">
        <x-heroicon-o-bars-3-bottom-left x-on:click="open = !open"
            class="w-8 h-8 border border-black rounded-lg cursor-pointer" />
    </div>
    <div x-show="open" on:click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform -translate-y-96" x-transition:enter-end="transform "
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="transform"
        x-transition:leave-end="transform -translate-y-96"
        class="absolute right-0 w-full bg-white rounded-md shadow-lg z-20">
        <div class="w-full p-4">
            <div class="mb-8">
                <a href="/{{$client->slug}}">
                    <img src="{{Storage::disk('logos')->url('logo.png')}}" alt="" class="w-56">
                </a>
            </div>
            <div class="text-xl flex flex-col gap-4">
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
    </div>

</div>