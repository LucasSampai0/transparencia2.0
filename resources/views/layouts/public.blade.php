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

    <div class="bg-gray-100 dark:bg-gray-900">
        <!-- Page Content -->
        <main x-data="{open: false}" class="flex flex-col md:flex-row">
            <div id="desktop_menu">
                <div class="min-h-screen bg-white hidden md:flex transition-all -translate-x-64 z-50 border-r fixed"
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
                            <a href="{{route('client.public-session', ['slug' => $client->slug])}}">
                                <div class="inline-flex gap-x-2">
                                    <x-heroicon-o-users class="w-7 h-7" />
                                    Sessões Públicas
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="p-2 transition-all"
                        x-bind:class="{'bg-white text-black': open, 'bg-[#93dd00] text-white': !open}" x-cloak>
                        <x-heroicon-o-bars-3-bottom-left x-on:click="open = !open"
                            class="w-6 h-6 md:w-8 md:h-8 border-2 rounded-lg cursor-pointer" />
                    </div>
                </div>
            </div>
            <div id="mobile_menu" class="md:hidden">
                <div class="bg-[#93dd00] p-2 flex justify-end z-30 relative">
                    <x-heroicon-o-bars-3-bottom-left x-on:click="open = !open"
                        class="w-8 h-8 border border-black rounded-lg cursor-pointer" />
                </div>
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform -translate-y-96"
                    x-transition:enter-end="transform "
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="transform"
                    x-transition:leave-end="transform -translate-y-96"
                    class="absolute right-0 w-full bg-white rounded-md shadow-lg z-20">
                    <div class="w-full p-4">
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
            <div class="min-h-screen flex-grow">
                <div class="flex flex-col rounded-lg md:ml-12 dark:border-gray-800 min-h-screen">
                    <div
                        class="flex items-center justify-start gap-4 p-4 py-2 md:p-4 border-b dark:border-gray-950 bg-gray-50 dark:bg-gray-800 shadow-md z-10">
                        <a href=" /{{$client->slug}} ">
                            <img class="min-w-20 h-20 md:w-32 md:h-32 rounded-full "
                                src="{{ Storage::disk('logos')->url($client->logo) }}" alt="{{$client->name}}">
                        </a>
                        <div class="gap-y-2 flex flex-col">
                            <h1 class="dark:text-white text-md md:text-2xl font-bold md:text-start">{{$client->name}}
                            </h1>
                            <h2 class="dark:text-white text-xs md:text-xl">{{$client->address}}</h2>
                            <h2 class="dark:text-white text-xs md:text-lg"><span class="font-bold">CNPJ:
                                </span>{{$client->cnpj}}</h2>
                            <div class="dark:text-white flex gap-x-5 text-xs md:text-lg flex-col md:flex-row">
                                @if(isset($client->phone))
                                <div class="flex">
                                    <x-heroicon-o-phone class="w-3 h-3 md:w-5 md:h-5" />
                                    <h2>{{$client->phone}}</h2>
                                </div>
                                @endif
                                @if(isset($client->site))
                                <div>
                                    <a class="flex" href="{{$client->site}}">
                                        <x-heroicon-o-globe-alt class="w-3 h-3 md:w-5 md:h-5" />
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