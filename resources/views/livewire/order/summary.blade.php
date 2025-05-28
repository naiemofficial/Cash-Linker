<div class="max-w-md mx-auto bg-white rounded-lg p-6">
    @if(filter_var($heading, FILTER_VALIDATE_BOOLEAN))
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Order Summary </h2>
    @endif


    <ul class="space-y-4 text-sm">
        @foreach($cartContent as $product)
            @php
                $price_total = floatval($product['price'])*intval($product['qty']);
                $commission_total = floatval($product['options']['commission'])*intval($product['qty']);
                $total_cost = ($price_total+$commission_total);
            @endphp
            <li
                wire:key="{{ $product['id'] }}"
                x-data="{ isOpen: false }"
                class="bg-white border-b-[1px] border-gray-200 overflow-hidden">

                <div
                    class="accordion-header flex flex-row gap-x-5 items-center justify-between py-2 transition duration-300">
                    <div class="flex flex-row gap-3 items-center">
                        <button
                            @click="$dispatch('accordion-toggle', { id: '{{ $product['id'] }}', open: !isOpen })"
                            @accordion-toggle.window="isOpen = $event.detail.id === '{{ $product['id'] }}' ? $event.detail.open : false"
                            class="text-lg">
                            <i :class="isOpen ? 'fa-solid fa-circle-caret-up text-blue-600' : 'fa-solid fa-circle-caret-down text-gray-700'"></i>
                        </button>
                        <div class="inline-flex w-12 {{ str_contains($product['options']['type'], 'penny') ? 'h-12' : 'h-auto min-h-6' }} rounded-sm bg-gray-100 border border-gray-200 items-center justify-center">
                            @if(empty($product['options']['image']))
                                <i class="fa-solid fa-image text-gray-400"></i>
                            @else
                                <img class="w-full h-full object-cover" src="{{ $product['options']['image'] }}" alt="{{ $product['name'] }}">
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-700 text-left font-medium cursor-text">{{ $product['name'] }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-1.5">
                        <input type="number" min="1" wire:model="quantity.{{ $product['id'] }}" wire:change="updateQuantity('{{ $product['id'] }}', $event.target.value)" class="w-12 p-[4px] text-center text-sm border border-gray-300 rounded">
                        <span class="text-gray-900 tex-sm min-w-[35px] text-right">{{ $total_cost }}</span>
                        <button wire:click="removeCartItem('{{ $product['rowId'] }}')" class="text-red-500 hover:text-gray-700 transition-all focus:outline-none h-[16px] w-[16px] inline-flex items-center justify-center">
                            <i class="fa-duotone fa-solid fa-trash pointer-events-none"></i>
                        </button>
                    </div>
                </div>

                <div
                    x-show="isOpen"
                    x-collapse {{-- Let x-collapse use its default duration --}}
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300" {{-- Increased duration to 300ms --}}
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="accordion-content py-1 text-gray-600 text-sm leading-5 rounded-md">
                    <div class="w-full">
                        <!-- Cost Table -->
                        <table class="w-full text-xs border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-2 py-1 text-left">Details</th>
                                <th class="border border-gray-300 px-2 py-1 text-right">Amount</th>
                                <th class="border border-gray-300 px-2 py-1 text-center">QTY</th>
                                <th class="border border-gray-300 px-2 py-1 text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="bg-white border border-gray-300 px-2 py-1">
                                    <div class="flex items-center">
                                        <i class="fa-duotone fa-solid fa-money-bill-alt text-blue-500 mr-2"></i> Total money
                                    </div>
                                </td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ floatval($product['price']) }}</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ $product['qty'] }}</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ $price_total }}</td>
                            </tr>
                            <tr>
                                <td class="bg-white border border-gray-300 px-2 py-1">
                                    <div class="flex items-center">
                                        <i class="fa-duotone fa-solid fa-coins text-red-500 mr-2"></i> Extra cost/Charge
                                    </div>
                                </td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ floatval($product['options']['commission']) }}</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ $product['qty'] }}</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ $commission_total }}</td>
                            </tr>
                            <tr class="font-semibold bg-gray-50">
                                <td colspan="3" class="bg-white border border-gray-300 px-2 py-1 text-right">Total Cost</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ $total_cost }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- Attributes Table -->
                        <table class="mt-2 w-full text-xs border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-2 py-1 text-center">Category</th>
                                <th class="border border-gray-300 px-2 py-1 text-center">Type</th>
                                <th class="border border-gray-300 px-2 py-1 text-center">Value</th>
                                <th class="border border-gray-300 px-2 py-1 text-center">Year</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ ucwords(str_replace('-', ' ', $product['options']['category'])) }}</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ ucwords(str_replace('-', ' ', $product['options']['type'])) }}</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ $product['options']['value'] }}</td>
                                <td class="bg-white border border-gray-300 px-2 py-1 text-center"> {{ $product['options']['year'] ?? 'N/A' }} </td>
                            </tr>
                            @if(strlen($product['options']['description']) > 0)
                                <tr>
                                    <td colspan="4" class="bg-white border border-gray-300 px-2 py-1"><span class="font-medium">Description:</span> {{ $product['options']['description'] }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>




    <div class="border-t border-gray-200 pt-4 space-y-2">
        <div class="flex justify-between text-gray-600 text-sm">
            <span class="font-semibold">Subtotal</span>
            <span class="text-gray-700 font-medium">{{ number_format($totalMoney+$extraCost, 2, '.', ',') }}</span>
        </div>
        <div class="flex justify-between text-gray-600 text-sm mt-1">
            <span class="font-semibold">Delivery Charge</span>
            <span class="text-gray-700 font-medium">{{ number_format($deliveryCost, 2, '.', ',') }}</span>
        </div>

        <div class="flex flex-col bg-blue-50 border border-dashed border-blue-200 px-5 py-4 rounded-md">
            <ul>
                @foreach($deliveryMethods as $deliveryMethod)
                    <li class="flex flex-col items-start gap-y-1 py-2">
                        <div class="flex items-center gap-x-3">
                            <label for="delivery-{{ $deliveryMethod->id }}" class="flex items-center cursor-pointer">
                                <span class="relative flex items-center justify-center w-5 h-5 rounded-full border border-gray-300">
                                    <input
                                        type="radio"
                                        id="delivery-{{ $deliveryMethod->id }}"
                                        name="delivery_method"
                                        value="{{ $deliveryMethod->id }}"
                                        wire:model="deliveryMethod"
                                        wire:change="selectDeliveryMethod({{ $deliveryMethod->id }})"
                                        class="absolute w-0 h-0 opacity-0 peer">
                                    <span class="w-3 h-3 rounded-full bg-blue-600 scale-0 peer-checked:scale-100 transition-transform"></span>
                                </span>
                                <span class="ml-3 text-sm"> {{ $deliveryMethod->name }}
                                    @if(!empty($deliveryMethod->cost))
                                        <span class="text-xs text-gray-500">({{ number_format($deliveryMethod->cost, 2) }})</span>
                                    @endif
                                </span>
                            </label>
                        </div>
                        @if(!empty($deliveryMethod->details))
                            <p class="text-xs text-gray-500 ml-7">{{ $deliveryMethod->details }}</p>
                        @endif
                    </li>

                @endforeach
            </ul>
        </div>

        <div class="flex justify-between font-semibold text-lg">
            <span>Total</span>
            @php
                $total_final = $totalMoney+$extraCost+$deliveryCost;
            @endphp
            <span>{{ $total_final }}</span>
        </div>
    </div>

    <button class="mt-6 w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        Proceed to Checkout
    </button>
</div>
