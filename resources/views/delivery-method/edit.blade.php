<x-dashboard.index title="Edit Delivery Method">
    <x-slot:headerRight>
        <livewire:delivery-method.button form="edit" :$statuses status="{{ $deliveryMethod->status }}" />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:delivery-method.form form="edit" :$deliveryMethod />
        </div>
    </div>
</x-dashboard.index>
