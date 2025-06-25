<!-- Sidebar -->
<div class="w-1/4 max-w-[250px] bg-white shadow-sm sm:rounded-lg overflow-y-auto">
    <ul class="p-4 space-y-2 text-sm font-medium">
        <li>
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded transition-colors duration-200
               {{ request()->is('dashboard') ? 'bg-blue-500 text-white' : 'bg-blue-50 text-gray-700 hover:bg-blue-100 hover:text-gray-900' }}">
                <i class="fa-regular fa-grid-horizontal w-[24px]"></i> Dashboard
            </a>
        </li>

        @if(auth()->user()->role() === 'administrator')
            <li>
                <a href="{{ route('filemanager') }}"
                   class="block px-4 py-2 rounded transition-colors duration-200
                   {{ request()->is('dashboard/filemanagers*') || request()->is('dashboard/filemanager*') ? 'bg-green-500 text-white' : 'bg-green-50 text-gray-700 hover:bg-green-100 hover:text-gray-900' }}">
                    <i class="fa-regular fa-folder w-[24px]"></i> File Manager
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}"
                   class="block px-4 py-2 rounded transition-colors duration-200
                   {{ request()->is('dashboard/user*') ? 'bg-purple-500 text-white' : 'bg-purple-50 text-gray-700 hover:bg-purple-100 hover:text-gray-900' }}">
                    <i class="fa-regular fa-users w-[24px]"></i> Users
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}"
                   class="block px-4 py-2 rounded transition-colors duration-200
                   {{ request()->is('dashboard/product*') ? 'bg-yellow-500 text-white' : 'bg-yellow-50 text-gray-700 hover:bg-yellow-100 hover:text-gray-900' }}">
                    <i class="fa-light fa-cubes w-[24px]"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('delivery-method.index') }}"
                   class="block px-4 py-2 rounded transition-colors duration-200
                   {{ request()->is('dashboard/delivery-methods*') || request()->is('dashboard/delivery-method*') ? 'bg-orange-500 text-white' : 'bg-orange-50 text-gray-700 hover:bg-orange-100 hover:text-gray-900' }}">
                    <i class="fa-light fa-truck w-[24px]"></i> Delivery Methods
                </a>
            </li>
            <li>
                <a href="{{ route('payment-method.index') }}"
                   class="block px-4 py-2 rounded transition-colors duration-200
                   {{ request()->is('dashboard/payment-method*') ? 'bg-pink-500 text-white' : 'bg-pink-50 text-gray-700 hover:bg-pink-100 hover:text-gray-900' }}">
                    <i class="fa-light fa-credit-card-front w-[24px]"></i> Payment Methods
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('order.index') }}"
               class="block px-4 py-2 rounded transition-colors duration-200
                {{ request()->is('dashboard/order*') ? 'bg-rose-500 text-white' : 'bg-rose-50 text-gray-700 hover:bg-amber-100 hover:text-gray-900' }}">
                <i class="fa-light fa-cart-shopping w-[24px]"></i> Orders
            </a>
        </li>

    </ul>
</div>
