<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ url('/assets/images/icon/money.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css'])

        <link href="{{ url('/assets/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script type="text/javascript" src="{{ url('/assets/js/custom.js') }}"></script>
    </head>
    <body class="dashboard font-sans antialiased min-h-screen">
        <div class="flex flex-col h-screen bg-gray-100">
            <div>
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
            </div>
            <!-- Page Content -->
            <main class="flex-1 overflow-auto">
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
    </body>
</html>
