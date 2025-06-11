<div class="flex flex-row h-full {{ $class }}">
    @php
        $products = $order->products;
        $products_snapshot = $order->products_snapshot;
    @endphp
    <div class="h-full w-1/2 relative ordered-products"><!-- overflow-y-auto -->
        <livewire:order.item-list product-source="order" :products="$products_snapshot" :quantity="$products" :editable="false" />

        <div class="px-6 py-2 border-t border-dashed">
            <<livewire:order.total />
        </div>
    </div>
    <div class="overflow-y-auto h-full w-1/2 border-r border-[#f0f1f4] px-6 py-4 pl-1 relative order-timeline">
        <livewire:order.timeline :order="$order" />
    </div>
</div>
