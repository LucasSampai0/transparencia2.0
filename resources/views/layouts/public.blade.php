<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>




    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="bg-gray-100">
        <!-- Page Content -->
        <main x-data="{open: false}" class="flex">
            <div class="min-h-screen bg-white flex absolute transition-all -translate-x-64 z-50 border-r"
                x-bind:class="{'translate-x-0': open, '-translate-x-64': !open}" x-on:click.away="open = false">
                <div class="w-64 p-4">
                    <div class="mb-8">
                        <img src="{{Storage::disk('logos')->url('logo.png')}}" alt="" class="w-56">
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
                        <a 
                            href="{{route('client.public-session', ['slug' => $client->slug])}}">
                            <div class="inline-flex gap-x-2">
                                <x-heroicon-o-users class="w-7 h-7" />
                                Sessões Públicas
                            </div>
                        </a>
                </div>
            </div>
            <div class="p-2 transition-all duration-300"
                x-bind:class="{'bg-white text-black': open, 'bg-[#93dd00] text-white': !open}">
                <x-heroicon-o-bars-3-bottom-left x-on:click="open = !open" class="w-12 h-12 border-2 rounded-lg" />
            </div>
    </div>
    <div class="min-h-screen ml-16 flex-grow">
        <div class="class= flex flex-col rounded-lg dark:border-gray-700 min-h-screen">
            <div class="flex items-center justify-start gap-4 p-4 border-b bg-gray-50 dark:bg-gray-800 shadow-md z-10">
                <div>
                    <a href=" /{{$client->slug}} ">
                        <img class="w-32 h-32 rounded-full " src="{{ Storage::disk('logos')->url($client->logo) }}"
                            alt="{{$client->name}}">
                    </a>
                </div>
                <div class="gap-y-2 flex flex-col">
                    <h1 class="text-2xl font-bold">{{$client->name}}</h1>
                    <h2 class="text-xl">{{$client->address}}</h2>
                    <h2><span class="font-bold">CNPJ: </span>{{$client->cnpj}}</h2>
                    <div class="flex gap-5">
                        @if(isset($client->phone))
                        <div class="flex">
                            <x-heroicon-o-phone class="w-5 h-5" />
                            <h2>{{$client->phone}}</h2>
                        </div>
                        @endif
                        @if(isset($client->site))
                        <div>
                            <a class="flex" href="{{$client->site}}">
                                <x-heroicon-o-globe-alt class="w-5 h-5" />
                                <h2>{{$client->site}}</h2>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
    </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>