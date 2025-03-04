<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Xero Fanzone</title>
        <link rel="icon" type="image/png" href="/assets/img/logo_icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="/assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="/assets/fontawesome/css/solid.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/script.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://www.google.com/recaptcha/api.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased cursor-default">
        <div class="min-h-screen bg-stone-800 flex flex-col">
            <div>
                <!-- Banner -->
                <img src="/assets/img/banner.png" alt="{{ __('Xero Fanzone Banner') }}">

                <!-- Navigation menu -->
                @include('layouts.navigation')
            </div>
            <!-- Page content -->
            <main class="flex flex-col grow lg:px-5 text-stone-50 lg:p-6 space-x-6">
                <!-- Sub navigation -->
                @if(isset($subnav))
                    <div class="w-full flex flex-col grow">
                        {{ $slot }}
                    </div>
                @else
                    <div class="bg-stone-500 lg:w-5/6 w-full m-auto my-6 p-8 md:rounded-md grow">
                        {{ $slot }}
                    </div>
                @endisset
            </main>
        </div>
        @livewireScripts
        @stack('scripts')
    </body>
    <footer class="flex items-center flex-col bg-stone-950 text-teal-500 px-4 py-2 space-y-1">
        <div class="uppercase space-x-3 text-center">
            <a class="hover:text-stone-50" href="{{ route('home') }}">Home</a>
            <a class="hover:text-stone-50" href="{{ route('terms') }}">Terms</a>
            <a class="hover:text-stone-50" href="{{ route('privacy') }}">Privacy</a>
            <a class="hover:text-stone-50" href="mailto:xfz@chimerasite.com">Contact</a>
            <a class="hover:text-stone-50" href="{{ route('credits') }}">Credits</a>
        </div>
        <div class="text-stone-50 text-sm">
            &copy; <a href="https://chimerasite.com/">Chimerasite</a> <?php echo date("Y"); ?> - V2.0.5
        </div>
    </footer>
</html>
