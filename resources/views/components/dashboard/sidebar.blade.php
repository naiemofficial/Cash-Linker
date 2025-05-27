<!-- Sidebar -->
<div class="bg-white shadow-sm sm:rounded-lg w-[250px] min-w-[250px] overflow-y-auto">
    <ul class="p-4 space-y-2 text-sm font-medium">
        <li>
            <a href="{{ route('dashboard') }}"
               class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                <i class="fa-regular fa-grid-horizontal w-[24px]"></i> Dashboard
            </a>
        </li>



        @if(auth()->user()->role() === 'administrator')
            <li>
                <a href="{{ route('filemanager') }}"
                   class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                    <i class="fa-regular fa-folder w-[24px]"></i> File Manager
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}"
                   class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                    <i class="fa-regular fa-users w-[24px]"></i> Users
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}"
                   class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                    <i class="fa-light fa-cubes w-[24px]"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('delivery-method.index') }}"
                   class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                    <i class="fa-light fa-truck w-[24px]"></i> Delivery Methods
                </a>
            </li>
            <li>
                <a href="{{ route('payment-method.index') }}"
                   class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                    <i class="fa-light fa-credit-card-front w-[24px]"></i> Payment Methods
                </a>
            </li>
            <li>
                <a href="{{ route('order.index') }}"
                   class="block bg-blue-50 text-gray-700 hover:bg-blue-100 px-4 py-2 rounded transition-colors duration-200">
                    <i class="fa-light fa-cart-shopping w-[24px]"></i> Orders
                </a>
            </li>
        @endif


    </ul>
</div>
