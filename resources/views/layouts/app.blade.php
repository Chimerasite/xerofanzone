<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="/assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="/assets/fontawesome/css/solid.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-stone-800 dark:bg-stone-500">
            <!-- Banner -->
            <img src="/assets/img/banner.png" alt="{{ __('Xero Fanzone Banner') }}">

            <!-- Navigation menu -->
            @include('layouts.navigation')

            <!-- Page content -->
            <main class="flex flex-row h-full px-5 text-stone-50 p-6 space-x-6">
                <!-- Sub navigation -->
                @isset($subnav)
                    <div class="bg-stone-600 w-80 h-full p-6 rounded-md ">
                        {{ $subnav }}
                    </div>
                @endisset
                <!-- main content -->
                <div class="bg-stone-500 w-full p-6 rounded-md">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
