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

        <!-- Scripts -->
        @vite(['resources/css/app.css'])

        <link href="{{ url('/assets/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script type="text/javascript" src="{{ url('/assets/js/custom.js') }}"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </body>
</html>
