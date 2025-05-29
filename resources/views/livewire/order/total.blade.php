<div class="flex flex-row flex-row justify-between items-center gap-5"> <!-- bg-gray-100 px-6 py-3  -->
    <div class="flex flex-col">
        <!-- Order Summary -->
        <div class="flex flex-row items-end gap-5">
            <div class="flex flex-row items-center gap-5">
                <div class="flex items-center gap-1">
                    <span class="text-sm text-gray-600">Total money:</span>
                    <span class="text-sm font-medium text-gray-900">{{ $totalMoney }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="text-sm text-gray-600">Extra Cost:</span>
                    <span class="text-sm font-medium text-gray-900">{{ $extraCost }}</span>
                </div>
            </div>
            @if($showDeliveryMethod)
                <div class="flex items-center gap-1">
                    <span class="text-sm text-gray-600">Delivery charge:</span>
                    <span class="text-sm font-medium text-gray-900">{{ number_format($deliveryCost, 2, '.', ',') }}</span>
                </div>
            @endif
        </div>
    </div>
    <div class="flex flex-row gap-4 items-center">
        <!-- Total -->
        <div class="inline-flex items-center gap-1">
            <span class="text-lg font-semibold text-gray-900">Total: </span>
            <span class="text-lg font-bold text-blue-600">{{ $total }}</span>
        </div>
        <!-- Checkout -->
        <a href="{{ route('order.checkout') }}" {{ ($cartItemsCount < 1 || ($showDeliveryMethod && empty($deliveryMethod))) ? 'disabled' : '' }} class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:bg-gray-500">
            <i class="fa-light fa-cart-shopping-fast mr-2"></i> Checkout
        </a>
        <!-- Cart -->
        <button id="openRightModalSidebar" class="min-h-[34px] min-w-[40px] relative inline-flex items-center justify-center bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fa-light fa-cart-shopping-fast"></i>
            <span class="{{ $cartItemsCount >= 10 ? 'rounded-sm px-[5px]' : 'rounded-full' }} inline-flex items-center justify-center bg-red-600 text-white h-[18px] min-w-[18px] transition-colors duration-200 absolute -top-[1px] -right-[50%] -translate-x-[50%] -translate-y-[50%]">
                {{ $cartItemsCount }}
            </span>
        </button>
    </div>
</div>
