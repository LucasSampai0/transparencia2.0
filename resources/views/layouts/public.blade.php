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
            <livewire:desktop-menu :slug="$client->slug"/>  
            <livewire:mobile-menu :slug="$client->slug"/>
            <div class="min-h-screen flex-grow">
                <div class="flex flex-col rounded-lg md:ml-12 dark:border-gray-800 min-h-screen">
                    <div
                        class="flex items-center justify-start gap-4 p-4 py-2 md:p-4 border-b dark:border-gray-950 bg-gray-50 dark:bg-gray-800 shadow-md z-10">
                        <a href=" /{{$client->slug}} ">
                            @if($client->logo)
                            <img class="min-w-20 h-20 md:w-32 md:h-32 rounded-full "
                                src="{{ Storage::disk('logos')->url($client->logo) }}" alt="{{$client->name}}">
                            
                            @else
                            <img class="min-w-20 h-20 md:w-32 md:h-32 rounded-full "
                                src="/storage/logos/placeholder.png" alt="{{$client->name}}">
                            @endif
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