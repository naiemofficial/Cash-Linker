<x-dashboard.index title="Add Order">
    <x-slot:headerRight>
        <livewire:order.button />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:order.form :$statuses />
        </div>
    </div>
</x-dashboard.index>
