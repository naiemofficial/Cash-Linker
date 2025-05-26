<x-dashboard.index title="Add Payment Method">
    <x-slot:headerRight>
        <livewire:payment-method.button />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:payment-method.form />
        </div>
    </div>
</x-dashboard.index>
