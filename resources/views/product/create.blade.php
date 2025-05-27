<x-dashboard.index title="Add Product">
    <x-slot:headerRight>
        <livewire:product.button :$statuses :$default />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:product.form :$default :$origins :$values :$categories :$types />
        </div>
    </div>
</x-dashboard.index>
