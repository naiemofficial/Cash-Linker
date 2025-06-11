<x-dashboard.index title="Edit Order">
    <x-slot:headerRight>
        <livewire:order.button form="edit" :$statuses :$order />
    </x-slot:headerRight>

    <div class="h-full w-full rounded-lg relative">
        <livewire:message.index />

        <div class="h-full">
            <livewire:order.edit :$order class="pb-[180px]" />

            <div class="p-6 py-3 -mt-[180px] min-h-[180px] border-t border-gray-200 text-xs grid grid-cols-2 gap-2">
                <ul class="bg-[#e6f0fe] rounded-md p-3 flex flex-col gap-1.5 items-start justify-center">
                    <li>
                        <span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-calendar-alt"></i> Date: </span> {{ $order->created_at->diffForHumans() }}
                    </li>
                </ul>
                <ul class="bg-[#daffe6] rounded-md p-3 flex flex-col gap-1.5 items-start justify-center">
                    <li>
                        <span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-credit-card"></i> Payment Method: </span> {{ $order->payment_method_snapshot['name'] }}
                    </li>
                    <li>
                        @if($order->payment_method_snapshot['type'] == 'mfs')
                            <span class="flex flex-row gap-5">
                                <span><span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-wallet"></i> Wallet: </span> {{ $order->payment_info['wallet'] }}</span>
                                <span><span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-hashtag"></i> TRX ID: </span> {{ $order->payment_info['transactionId'] }}</span>
                            </span>
                        @elseif($order->payment_method_snapshot['type'] == 'bank')
                            <span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-building-columns"></i> Transaction Info: </span> {{ $order->payment_info['transactionInfo'] }}
                        @endif
                    </li>
                </ul>
                <ul class="bg-[#ffefe5] rounded-md p-3 flex flex-col gap-1.5 items-start justify-center">
                    <li>
                        <span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-user"></i> Name: </span> {{ $order->receiver['name'] }}
                    </li>
                    <li>
                        <span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-phone-volume"></i> Phone: </span> {{ $order->receiver['phone'] }}
                    </li>
                </ul>
                <ul class="bg-[#ffe9ff] rounded-md p-3 flex flex-col gap-1.5 items-start justify-center">
                    <li>
                        <span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-truck"></i> Delivery Method: </span> {{ $order->delivery_method_snapshot['name'] }}
                    </li>
                    @php
                        $address  = $country = $order->delivery_address['country'] ?? '';
                        $city     = $order->delivery_address['city'] ?? '';
                        $address .= strlen($country) > 0 ? ', ' : '';
                        $address .= $city;
                        $address .= strlen($city) > 0    ? ', ' : '';
                        $address .= $order->delivery_address['address'] ?? '';
                    @endphp
                    <li>
                        <span class="font-semibold text-gray-600"><i class="fa-duotone fa-solid fa-map-marker-alt"></i> Address: </span> {{ $address }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-dashboard.index>
