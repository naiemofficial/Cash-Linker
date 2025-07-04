<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-5">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($title ?? 'Dashboard') }}
            </h2>
            <div class="header-right inline-flex items-center flex-1 justify-end">
                {{ $headerRight ?? '' }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 h-full">
        <div class="h-full max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="h-full flex gap-4">
                @include('components.dashboard.sidebar')

                <!-- Content -->
                <div class="w-3/4 flex-1 flex bg-white shadow-sm sm:rounded-lg relative">
                    <x-message />

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
