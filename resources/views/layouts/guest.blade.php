<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth min-w-[1265px]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ url('/assets/images/icon/money.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&family=Rubik+Microbe&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css'])

        <link href="{{ url('/assets/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script type="text/javascript" src="{{ url('/assets/js/custom.js') }}"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 min-h-screen flex flex-col">
        <x-guest.header />
        <section section="hero">{{ $hero ?? '' }}</section>
        <div class="max-w-[1400px] w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 min-h-full min-w-[500px] flex flex-col flex-1 justify-center">
            <div class="content-main w-full">
                {{ $slot }}
            </div>
        </div>
        <x-guest.footer />
    </body>
</html>
