<div class="flex flex-row h-full">
    @php
        $products = $order->products;
        $products_snapshot = $order->products_snapshot;
    @endphp
    <div class="overflow-y-auto h-full w-1/2 relative ordered-products">
        <livewire:order.item-list product-source="order" :products="$products_snapshot" :quantity="$products" :editable="false" />
    </div>
    <div class="overflow-y-auto h-full w-1/2 border-r border-[#f0f1f4] px-6 py-4 pl-1 relative order-timeline">
        <livewire:order.timeline :order="$order" />
    </div>
</div>
