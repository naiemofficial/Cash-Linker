<div class="flex items-center lg:order-2">
    <a href="{{ $authorized ? route('dashboard') : route('login') }}" class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none border border-dashed border-gray-700">{{ $authorized ? 'Dashboard' : 'Log in' }}</a>
</div>
