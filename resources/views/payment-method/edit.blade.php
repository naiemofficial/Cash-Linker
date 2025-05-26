<x-dashboard.index title="Edit Payment Method">
    <x-slot:headerRight>
        <livewire:payment-method.button form="edit" :$statuses status="{{ $paymentMethod->status }}" />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="p-5 h-full overflow-auto">
            <livewire:payment-method.form form="edit" :$paymentMethod />
        </div>
    </div>
</x-dashboard.index>
