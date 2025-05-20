<!-- Sidebar -->
<div class="bg-white shadow-sm sm:rounded-lg w-[200px]">
    <ul class="p-4 space-y-2 text-sm font-medium">
        <li>
            <a href="{{ route('dashboard') }}"
               class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                <i class="fa-regular fa-grid-horizontal w-[24px]"></i> Dashboard
            </a>
        </li>



        @if(auth()->user()->role() === 'administrator')
            <li>
                <a href="{{ route('users.index') }}"
                   class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                    <i class="fa-regular fa-users w-[24px]"></i> Users
                </a>
            </li>
        @endif


    </ul>
</div>
