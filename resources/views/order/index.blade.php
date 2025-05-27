<x-dashboard.index title="Orders">
    <x-slot:headerRight>
        @if($trash_count > 0 || $trashPage)
            <a
                href="{{ route('order.index.trash') }}"
                class="mr-2 group {{ $trashPage ? 'bg-red-600 text-white hover:bg-red-600 hover:text-white' : '' }} w-[110px] border border-red-600 text-red-600 px-4 h-[32px] hover:bg-[#ffeef5] focus:outline-none focus:ring-2 focus:ring-red-500 text-xs cursor-pointer disabled:cursor-not-allowed transition-all duration-200 relative rounded-md inline-flex items-center justify-center gap-1"
            >
                <i class="fas fa-trash-alt"></i> Trash
                <span class="{{ $trash_count >= 10 ? 'rounded-sm px-[5px]' : 'rounded-full' }} top-[-5px] right-[-5px] inline-flex items-center justify-center bg-[#ffd3e5] text-red-600 h-[18px] min-w-[18px] transition-colors duration-200">
                {{ $trash_count }}
            </span>
            </a>
        @endif

        <a href="{{ route('order.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Add Order
        </a>
    </x-slot:headerRight>

    <div class="flex-1 w-full relative overflow-auto  {{ $orders->hasPages() ? 'pb-[38px]' : '' }}">
        @if($orders->count() < 1)
            <x-notfound icon="fa-light fa-cart-shopping" text="Orders not found" :$trashPage />
        @else
            <table class="min-w-full leading-normal">
                <thead class="sticky top-0">
                    <tr>
                        <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            ID
                        </th>
                        <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">
                            Delivery Method
                        </th>
                        <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Address
                        </th>
                        <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Payment Method
                        </th>
                        <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Status
                        </th>
                        <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="overflow-y-auto">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $order->id }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                                {{ $order->delivery_method }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center truncate">
                                {{ $order->address }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $order->payment_method }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-xs text-center">
                                <span class="inline-block px-2 py-0.5 text-gray-700 border border-gray-700 rounded-full">
                                    {{ ucwords(str_replace('-', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-right">
                                <livewire:order.actions :$order wire:key="{{ $order->id }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Pagination -->
    <x-pagination :data="$orders" class="inner-col-pagination"/>
</x-dashboard.index>
