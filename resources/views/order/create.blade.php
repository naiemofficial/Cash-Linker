<x-dashboard.index title="Add Order">
    <x-slot:headerRight>
        <livewire:order.total />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="h-full rounded-lg relative">
            <livewire:order.form :$statuses />
        </div>
    </div>

    @include('order.cart-modal')

</x-dashboard.index>
