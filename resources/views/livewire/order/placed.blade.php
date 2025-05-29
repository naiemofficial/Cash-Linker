<section class="bg-white antialiased">
    @if(!empty($order))
        <div class="mx-auto max-w-2xl px-4 2xl:px-0 py-8 md:py-16">
            <h2 class="text-md font-semibold text-gray-900 mb-2">Thanks for your order!</h2>
            <p class="text-gray-500 mb-6 md:mb-8 text-sm">Your order <a href="#" class="font-medium text-gray-900 hover:underline" href="{{ route('order.edit', $order->id) }}">#{{ $order->id }}</a> will be processed within 24 hours during working days. We will notify you by email once your order has been shipped.</p>
            <div class="space-y-4 sm:space-y-2 rounded-lg border border-dashed border-gray-200 bg-gray-50 p-6 mb-6 md:mb-8">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 text-sm">Date</dt>
                    <dd class="font-medium text-gray-700 sm:text-end text-sm">{{ $order->created_at->diffForHumans() }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 text-sm">Payment Method</dt>
                    <dd class="font-medium text-gray-700 text-sm">{{ $order->delivery_method_snapshot['name'] }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Name</dt>
                    <dd class="font-medium text-gray-700 text-sm">{{ $order->receiver['name'] }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 text-sm">Address</dt>
                    @php
                        $address = $order->delivery_address['country'];
                        $address = strlen($address) > 0 ? ',' : '';
                        $address = $order->delivery_address['city'];
                        $address = strlen($address) > 0 ? ',' : '';
                        $address = $order->delivery_address['address'];
                    @endphp
                    <dd class="font-medium text-gray-700 sm:text-end text-sm">{{ $address }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 text-sm">Phone</dt>
                    <dd class="font-medium text-gray-700 sm:text-end text-sm">{{ $order->receiver['phone'] }}</dd>
                </dl>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('order.edit', $order->id) }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Track your order</a>
                <a href="{{ route('home') }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Return to shopping</a>
            </div>
        </div>
   @endif
</section>
