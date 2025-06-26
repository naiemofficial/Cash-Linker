<x-dashboard.index title="Dashboard">
    <div class="flex h-full min-w-full rounded-lg overflow-hidden">
        <div class="p-6 h-full w-full flex flex-wrap justify-center content-start gap-5 text-gray-500 overflow-y-auto">
            <div class="grid grid-cols-3 w-full gap-5">
                <div>
                    <a href="{{ route('product.index') }}">
                        <div class="rounded-2xl border p-5 md:p-6 border-teal-100 bg-teal-100 transition-all hover:shadow-md hover:shadow-teal-300">
                            <div class="flex items-center">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-teal-100 bg-teal-500 text-white">
                                    <i class="fa-light fa-cubes"></i>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm text-gray-500 font-semibold">Products</span>
                                    <h4 class="text-title-sm font-bold text-gray-800">{{ $products }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('user.index') }}">
                        <div class="rounded-2xl border p-5 md:p-6 border-purple-100 bg-purple-100 transition-all hover:shadow-md hover:shadow-purple-300">
                            <div class="flex items-center">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-purple-100 bg-purple-500 text-white">
                                    <i class="fa-light fa-users"></i>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm text-gray-500 font-semibold">Customers</span>
                                    <h4 class="text-title-sm font-bold text-gray-800">{{ $customers }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('order.index') }}">
                        <div class="rounded-2xl border p-5 md:p-6 border-rose-100 bg-rose-100 transition-all hover:shadow-md hover:shadow-rose-300">
                            <div class="flex items-center">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-rose-100 bg-rose-500 text-white">
                                    <i class="fa-light fa-cart-shopping"></i>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm text-gray-500 font-semibold">Orders</span>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h4 class="text-title-sm font-bold text-gray-800">
                                            {{ (auth()->user()->role() == 'administrator') ? $orders->count() : $userOrders }}
                                        </h4>
                                        @if(auth()->user()->role() == 'administrator')
                                            <span class="text-xs border border-[#fcc8cf] bg-rose-200 text-gray-600 px-1 py-0.5 rounded">Pending: <span class="font-semibold">{{ $pendingOrders }}</span></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 w-full gap-5">
                <div>
                    <a href="{{ route('delivery-method.index') }}">
                        <div class="rounded-2xl border p-5 md:p-6 border-orange-100 bg-orange-100 transition-all hover:shadow-md hover:shadow-orange-300">
                            <div class="flex items-center">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-orange-100 bg-orange-500 text-white">
                                    <i class="fa-light fa-truck"></i>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm text-gray-500 font-semibold">Delivery Methods</span>
                                    <h4 class="text-title-sm font-bold text-gray-800">{{ $deliveryMethods }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('payment-method.index') }}">
                        <div class="rounded-2xl border p-5 md:p-6 border-pink-100 bg-pink-100 transition-all hover:shadow-md hover:shadow-pink-300">
                            <div class="flex items-center">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-pink-100 bg-pink-500 text-white">
                                    <i class="fa-light fa-credit-card-front"></i>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm text-gray-500 font-semibold">Payment Methods</span>
                                    <h4 class="text-title-sm font-bold text-gray-800">{{ $paymentMethods }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <x-dashboard.ordersDateChart :$orders/>
            <x-dashboard.ordersMonthChart :$orders />
        </div>
    </div>
</x-dashboard.index>
