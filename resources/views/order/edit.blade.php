<x-dashboard.index title="Edit Order">
    <x-slot:headerRight>
        <livewire:order.button form="edit" :$statuses />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:order.edit :$order />
        </div>
    </div>
</x-dashboard.index>
