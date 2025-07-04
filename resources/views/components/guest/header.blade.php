<header>
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="h-[100px] border-gray-200 px-4 lg:px-6 py-2.5 flex flex-row items-center {{ Route::is('home') ? '-mb-[100px]' : '' }}">
            <div class="flex flex-wrap justify-between items-center w-full">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ url('/assets/images/icon/money.png') }}" class="mr-3 h-6 sm:h-9" alt="Money Logo" />
                    <span class="self-center text-3xl font-semibold whitespace-nowrap text-gray-900" style="font-family: 'Rubik Microbe', sans-serif;">{{ config('app.name') }}</span>
                </a>

                <x-guest.navigation />

                <livewire:guest.button />
            </div>
        </nav>
    </div>
</header>
