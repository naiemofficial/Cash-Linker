<div class="flex flex-row h-full {{ $class }}">
    @php
        $quantities = $order->products;
        $products_snapshot = $order->products_snapshot;
    @endphp
    <div class="flex flex-col h-full w-1/2 relative ordered-products"><!-- overflow-y-auto -->
        <livewire:order.item-list product-source="order" :products="$products_snapshot" :quantity="$quantities" :editable="false" />

        <div class="px-6 py-2 border-t border-dashed mt-auto bg-gray-50">
            @php
                $subtotal = 0;
                foreach($products_snapshot as $index => $product){
                    $price      = floatval($product['price']);
                    $commission = floatval($product['commission']);
                    $qty        = intval($quantities[$index]['qty']);
                    $price_total        = $price*$qty;
                    $commission_total   = $commission*$qty;
                    $total_cost         = ($price_total+$commission_total);
                    $subtotal          += $total_cost;
                }

                $deliveryCost   = floatval($order?->delivery_method_snapshot['cost'] ?? 0);
                $total          = $subtotal+$deliveryCost;

                $subtotal_formatted     = number_format($subtotal,      2, '.', ',');
                $deliveryCost_formatted = number_format($deliveryCost,  2, '.', ',');
                $total_formatted        = number_format($total,         2, '.', ',');
            @endphp
            <div class="flex justify-between text-gray-600 text-xs">
                <span class="font-semibold">Subtotal</span>
                <span class="text-gray-700 font-semibold">{{ $subtotal_formatted }}৳</span>
            </div>
            <div class="flex justify-between text-gray-600 text-xs mt-1">
                <span class="font-semibold">Delivery Charge</span>
                <span class="text-gray-700 font-semibold">{{ $deliveryCost_formatted }}৳</span>
            </div>
            <div class="flex justify-between font-semibold text-sm">
                <span class="text-gray-900">Total</span>
                <span class="text-blue-600">{{ $total_formatted }}৳</span>
            </div>
        </div>
    </div>
    <div class="overflow-y-auto h-full w-1/2 border-r border-[#f0f1f4] px-6 py-4 pl-1 relative order-timeline">
        <livewire:order.timeline :order="$order" />
    </div>
</div>
