<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
{{--            @livewire('')--}}

            <!-- Page Content -->
            <main>
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
                            <a href="{{ url($client->slug) }}" class="flex items-center mb-5">
                                <img src="{{ asset('storage/logos/logo_text.png') }}" alt="Logo">
                                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"></span>
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
                <div class="sm:ml-64  min-h-screen">
                    <div class="grid rounded-lg dark:border-gray-700 "  >
                        <div class="flex items-center justify-start gap-4 p-4 border-b bg-gray-50 dark:bg-gray-800">
                            <div>
                                <a href="{{$client->slug}}">
                                    <img class="w-32 h-32 rounded-full " src="{{ Storage::disk('logos')->url($client->logo) }}" alt="{{$client->name}}">
                                </a>
                            </div>
                            <div class="gap-y-2 flex flex-col">
                                <h1 class="text-2xl font-bold">{{$client->name}}</h1>
                                <h2 class="text-xl">{{$client->address}}</h2>
                                <h2><span class="font-bold">CNPJ: </span>{{$client->cnpj}}</h2>
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
                {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
