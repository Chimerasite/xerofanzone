<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Xero Fanzone') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="/assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="/assets/fontawesome/css/solid.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/script.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased cursor-default">
        <div class="min-h-screen bg-stone-800">
            <!-- Banner -->
            <img src="/assets/img/banner.png" alt="{{ __('Xero Fanzone Banner') }}">

            <!-- Navigation menu -->
            @include('layouts.navigation')

            <!-- Page content -->
            <main class="flex flex-row h-full lg:px-5 text-stone-50 lg:p-6 space-x-6">
                <!-- Sub navigation -->
                @if(isset($subnav))
                    <div class="w-full">
                        {{ $slot }}
                    </div>
                @else
                    <div class="bg-stone-500 lg:w-5/6 w-full lg:m-auto mx-5 my-6 p-8 rounded-md">
                        {{ $slot }}
                    </div>
                @endisset
            </main>
        </div>
        @livewireScripts
    </body>
    <footer class="flex justify-center bg-stone-950 text-teal-500 px-4 py-2">
       <i class="fa-solid fa-arrow-down mr-2 mt-1"></i> This is the footer, credits and stuff should go here  ;p
    </footer>
</html>
