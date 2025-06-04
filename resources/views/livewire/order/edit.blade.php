<div class="grid gap-5 sm:grid-cols-4 sm:gap-6">
    @php
        $products = $order->products;
        $products_snapshot = $order->products_snapshot;
    @endphp
    <div class="col-span-2 overflow-y-auto">
        <livewire:order.item-list product-source="order" :products="$products_snapshot" :quantity="$products" :editable="false" />
    </div>
</div>
