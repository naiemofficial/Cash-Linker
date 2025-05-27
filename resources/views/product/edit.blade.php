<x-dashboard.index title="Edit Product">
    <x-slot:headerRight>
        <livewire:product.button form="edit" :$statuses status="{{ $product->status }}" />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:product.form form="edit" :$default :$origins :$values :$categories :$types :$product />
        </div>
    </div>
</x-dashboard.index>
