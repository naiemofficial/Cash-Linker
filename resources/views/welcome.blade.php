<x-guest-layout>
    <x-slot:hero><x-guest.hero/></x-slot:hero>
    <div class="mx-auto">
        <div class="flex gap-4 max-h-[680px]" id="order">
            <!-- Content -->
            <div class="w-[70%] flex-1 flex bg-white shadow-sm sm:rounded-lg relative">
                <livewire:message.index />
                <div class="overflow-auto">
                    <livewire:order.form :style="'height: auto'" />
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-[30%] bg-white shadow-sm sm:rounded-lg flex flex-col flex-1 overflow-hidden summary-homepage">
                <livewire:order.summary heading="false" />
            </div>
        </div>
    </div>
</x-guest-layout>
