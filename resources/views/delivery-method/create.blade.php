<x-dashboard.index title="Add Delivery Method">
    <x-slot:headerRight>
        <livewire:delivery-method.button />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:delivery-method.form />
        </div>
    </div>
</x-dashboard.index>
