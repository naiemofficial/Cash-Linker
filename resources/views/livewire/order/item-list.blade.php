<div class="flex flex-col itemlist-wrapper">
    <div class="bg-gray-500 text-white px-6 sticky top-0 py-1 {{ $checkoutPage ? 'pr-0' : '' }} rounded-b-md h-[30px] list-header">
        <div class="flex flex-row gap-x-5 items-center justify-between text-sm font-semibold">
            <div class="flex flex-row gap-3 items-center">
                <span class="w-[18px]"></span>
                <span class="text-left">Product Name</span>
            </div>
            <div class="flex items-center gap-x-2 text-center">
                <span class="w-[45px]">QTY</span>
                <span class="w-[70px] text-right">Total</span>
                @if($editable) <span class="w-[18px]"></span> @endif
            </div>
        </div>
    </div>
    <div class="w-full overflow-y-auto {{ !$checkoutPage ? 'px-6' : '' }}">
        <ul class="space-y-4 text-sm w-full">
            @foreach($products as $index => $product)
                @php
                    if($productSource == 'cartContent' || $productSource == 'cartContent'){
                        $rowId              = $product['rowId'];
                        $product_image      = $product['options']['image'];
                        $product_category   = $product['options']['category'];
                        $product_type       = $product['options']['type'];
                        $commission         = $product['options']['commission'];
                        $qty                = $product['qty'];
                        $value              = $product['options']['value'];
                        $year               = $product['options']['year'];
                        $description        = $product['options']['description'];
                    } else if($productSource == 'order'){
                        $product_image      = $product['image'];
                        $product_category   = $product['category'];
                        $product_type       = $product['type'];
                        $commission         = $product['commission'];
                        $qty                = $quantity[$index]['qty'];
                        $value              = $product['value'];
                        $year               = $product['year'];
                        $description        = $product['description'];
                    }

                    $price_total        = floatval($product['price'])*intval($qty);
                    $commission_total   = floatval($commission)*intval($qty);
                    $total_cost         = ($price_total+$commission_total);

                    $price_total_formatted      = number_format($price_total,       2, '.', ',');
                    $commission_total_formatted = number_format($commission_total,  2, '.', ',');
                    $total_cost_formatted       = number_format($total_cost,        2, '.', ',');
                @endphp
                <li
                    wire:key="{{ $product['id'] }}"
                    x-data="{ isOpen: false }"
                    class="border-b-[1px] border-gray-200 overflow-hidden last:border-b-0 text-xs" style="margin-top: 0;">

                    <div
                        class="accordion-header flex flex-row gap-x-5 items-center justify-between py-2 transition duration-300">
                        <div class="flex flex-row gap-3 items-center">
                            <button
                                @click="$dispatch('accordion-toggle', { id: '{{ $product['id'] }}', open: !isOpen })"
                                @accordion-toggle.window="isOpen = $event.detail.id === '{{ $product['id'] }}' ? $event.detail.open : false"
                                class="text-lg w-[18px] inline-flex items-center justify-center">
                                <i :class="isOpen ? 'fa-solid fa-circle-caret-up text-blue-600' : 'fa-solid fa-circle-caret-down text-gray-700'" class="pointer-events-none"></i>
                            </button>
                            <div class="inline-flex w-12 {{ str_contains($product_type, 'penny') ? 'h-12' : 'h-auto min-h-6' }} rounded-sm bg-gray-100 border border-gray-200 items-center justify-center">
                                @if(empty($product_image))
                                    <i class="fa-solid fa-image text-gray-400"></i>
                                @else
                                    <img class="w-full h-full object-cover" src="{{ $product_image }}" alt="{{ $product['name'] }}">
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <span class="text-gray-700 text-left font-medium cursor-text">{{ $product['name'] }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-x-2 text-center">
                            @if($editable)
                                <input type="number" min="1" wire:model="quantity.{{ $product['id'] }}" wire:change="updateQuantity('{{ $product['id'] }}', $event.target.value)" class="w-[45px] p-[2px] text-center text-xs border border-gray-300 rounded">
                            @else
                                <span class="w-[45px] p-[2px]">{{ $qty }}</span>
                            @endif
                            <span class="text-gray-900 tex-sm w-[70px] text-right font-medium">{{ $total_cost_formatted }}৳</span>
                            @if($editable)
                                <button wire:click="removeCartItem('{{ $rowId }}')" class="text-red-500 hover:text-gray-700 transition-all focus:outline-none h-[16px] w-[16px] inline-flex items-center justify-center">
                                    <i class="fa-duotone fa-solid fa-trash pointer-events-none"></i>
                                </button>
                            @endif
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
                                    <td rowspan="2" class="bg-white border border-gray-300 px-2 py-1 text-center">{{ $qty }}</td>
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ $price_total_formatted }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-white border border-gray-300 px-2 py-1">
                                        <div class="flex items-center">
                                            <i class="fa-duotone fa-solid fa-coins text-red-500 mr-2"></i> Extra cost/Charge
                                        </div>
                                    </td>
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ floatval($commission) }}</td>
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ $commission_total_formatted }}</td>
                                </tr>
                                <tr class="font-semibold bg-gray-50">
                                    <td colspan="3" class="bg-white border border-gray-300 px-2 py-1 text-right">Total Cost</td>
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-right">{{ $total_cost_formatted }}</td>
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
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ ucwords(str_replace('-', ' ', $product_category)) }}</td>
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ ucwords(str_replace('-', ' ', $product_type)) }}</td>
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-center">{{ $value }}</td>
                                    <td class="bg-white border border-gray-300 px-2 py-1 text-center"> {{ $year ?? 'N/A' }} </td>
                                </tr>
                                @if(strlen($description) > 0)
                                    <tr>
                                        <td colspan="4" class="bg-white border border-gray-300 px-2 py-1"><span class="font-medium">Description:</span> {{ $description }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
