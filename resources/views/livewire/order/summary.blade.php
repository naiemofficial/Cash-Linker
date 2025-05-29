<div class="w-full rounded-lg {{ ($checkoutPage || Route::is('home')) ? '' : 'h-screen' }} flex flex-col ">
    @if($checkoutPage)
        <h3 class="order_review_heading"> Your Order </h3>
    @else
        @if(filter_var($heading, FILTER_VALIDATE_BOOLEAN))
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Order Summary </h2>
        @endif
    @endif



    @if(count($cartContent) < 1)
        <div class="flex flex-col flex-1 items-center justify-center py-8 text-gray-600">
            <i class="fa-solid fa-cart-arrow-down text-4xl text-gray-400 mb-4"></i>
            <p class="text-lg font-medium text-gray-500">Your cart is empty</p>
        </div>
    @else
        <div class="{{ !$checkoutPage ? 'bg-gray-500 text-white px-6 sticky top-0' : '' }} py-1 rounded-b-md h-[30px]">
            <div class="flex flex-row gap-x-5 items-center justify-between text-sm font-semibold">
                <div class="flex flex-row gap-3 items-center">
                    <span class="w-[18px]"></span>
                    <span class="text-left">Product Name</span>
                </div>
                <div class="flex items-center gap-x-2 text-center">
                    <span class="w-[45px]">QTY</span>
                    <span class="w-[70px] text-right">Total</span>
                    @if(!$checkoutPage) <span class="w-[18px]"></span> @endif
                </div>
            </div>
        </div>
        <div class="w-full {{ !$checkoutPage ? 'px-6' : '' }} overflow-y-auto {{ Route::is('home') ? 'max-h-[495px]' : '' }}">
                <ul class="space-y-4 text-sm w-full">
                    @foreach($cartContent as $product)
                        @php
                            $price_total = floatval($product['price'])*intval($product['qty']);
                            $commission_total = floatval($product['options']['commission'])*intval($product['qty']);
                            $total_cost = ($price_total+$commission_total);
                        @endphp
                        <li
                            wire:key="{{ $product['id'] }}"
                            x-data="{ isOpen: false }"
                            class="border-b-[1px] border-gray-200 overflow-hidden last:border-b-0" style="margin-top: 0;">

                            <div
                                class="accordion-header flex flex-row gap-x-5 items-center justify-between py-2 transition duration-300">
                                <div class="flex flex-row gap-3 items-center">
                                    <button
                                        @click="$dispatch('accordion-toggle', { id: '{{ $product['id'] }}', open: !isOpen })"
                                        @accordion-toggle.window="isOpen = $event.detail.id === '{{ $product['id'] }}' ? $event.detail.open : false"
                                        class="text-lg w-[18px] inline-flex items-center justify-center">
                                        <i :class="isOpen ? 'fa-solid fa-circle-caret-up text-blue-600' : 'fa-solid fa-circle-caret-down text-gray-700'" class="pointer-events-none"></i>
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
                                <div class="flex items-center gap-x-2 text-center">
                                    <input type="number" min="1" wire:model="quantity.{{ $product['id'] }}" wire:change="updateQuantity('{{ $product['id'] }}', $event.target.value)" class="w-[45px] p-[2px] text-center text-xs border border-gray-300 rounded">
                                    <span class="text-gray-900 tex-sm w-[70px] text-right">{{ $total_cost }}৳</span>
                                    @if(!$checkoutPage)
                                        <button wire:click="removeCartItem('{{ $product['rowId'] }}')" class="text-red-500 hover:text-gray-700 transition-all focus:outline-none h-[16px] w-[16px] inline-flex items-center justify-center">
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
        </div>
   @endif



    <div class="flex flex-col border-t border-gray-200 pt-4 space-y-2 mt-auto {{ !$checkoutPage ? 'px-6' : '' }} py-3 {{ ($checkoutPage || Route::is('home')) ? '' : 'mb-[60px]'  }} mb-3">
        <div class="flex justify-between text-gray-600 text-sm">
            <span class="font-semibold">Subtotal</span>
            @php
                $subtotal = floatval(str_replace(',', '', $totalMoney))+floatval(str_replace(',', '', $extraCost));
                $subtotal_formatted = number_format($subtotal, 2, '.', ',');
            @endphp
            <span class="text-gray-700 font-medium">{{ $subtotal_formatted }}৳</span>
        </div>

        @php
            $deliveryCost = floatval(str_replace(',', '', $deliveryCost));
            $deliveryCost_formatted = number_format($deliveryCost, 2, '.', ',');
        @endphp
        @if($showDeliveryMethod)
            <div class="flex justify-between text-gray-600 text-sm mt-1">
                <span class="font-semibold">Delivery Charge</span>
                <span class="text-gray-700 font-medium">{{ $deliveryCost_formatted }}৳</span>
            </div>


            @if(!$checkoutPage)
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
                                                <span class="text-xs text-gray-500">({{ number_format($deliveryMethod->cost, 2, '.', ',') }})৳</span>
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
            @endif
        @endif
        <div class="flex justify-between font-semibold text-lg">
            <span>Total</span>
            @php
                $total_final = $subtotal+$deliveryCost;
            @endphp
            <span>{{ number_format($total_final, 2, '.', ',') }}৳</span>
        </div>

        @if(!$checkoutPage)
            <a href="{{ route('order.checkout') }}" {{ (count($cartContent) < 1 || ($showDeliveryMethod && empty($deliveryMethod))) ? 'disabled' : '' }} class="mt-6 w-full bg-blue-600 text-white text-center py-3 px-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-500 disabled:cursor-not-allowed">
                Proceed to Checkout
            </a>
        @endif
    </div>

    @if($checkoutPage)
        <div class="flex flex-col gap-5">
            @if(!empty($paymentMethod))
                <div class="bg-white border-[1px] border-dashed border-gray-400 p-4 rounded-md flex flex-col gap-3">
                    <div class="inline-flex gap-1.5">
                        You're paying with
                        @if(!empty($paymentMethod->logo))
                            <img src="{{ $paymentMethod->logo }}" alt="{{ $paymentMethod->name }}" class="h-[24px] w-auto" />
                        @else
                            <span class="font-semibold inline-block">{{ $paymentMethod->name }}</span>
                        @endif
                    </div>
                    <ul class="flex flex-wrap list-none gap-2.5 text-xs">
                        @if(!empty($paymentMethod->type))<li class="inline-flex items-center gap-1 bg-gray-200 px-1.5 py-0.5 rounded-md"><span class="font-medium">Type:</span> {{ $paymentMethod->type === 'mfs' ? 'MFS' : ucwords(str_replace('-', ' ', $paymentMethod->type)) }}</li>@endif
                        @if(!empty($paymentMethod->category))<li class="inline-flex items-center gap-1 bg-gray-200 px-1.5 py-0.5 rounded-md"><span class="font-medium">Category:</span> {{ ucwords(str_replace('-', ' ', $paymentMethod->category)) }}</li>@endif
                        @if(!empty($paymentMethod->account_no))<li class="inline-flex items-center gap-1 bg-gray-200 px-1.5 py-0.5 rounded-md"><span class="font-medium">Account No.:</span> {{ $paymentMethod->account_no }}</li>@endif
                        @if(!empty($paymentMethod->account_name))<li class="inline-flex items-center gap-1 bg-gray-200 px-1.5 py-0.5 rounded-md"><span class="font-medium">Account name:</span> {{ $paymentMethod->account_name }}</li>@endif
                        @if(!empty($paymentMethod->swift_code))<li class="inline-flex items-center gap-1 bg-gray-200 px-1.5 py-0.5 rounded-md"><span class="font-medium">SWIFT Code:</span> {{ $paymentMethod->swift_code }}</li>@endif
                    </ul>
                    @if(!empty($paymentMethod->description))
                        <p class="mt-1 text-xs font-normal text-gray-500">{{ $paymentMethod->description }}</p>
                    @endif
                    <div class="grid grid-cols-2 gap-5">
                        @if($paymentMethod->type === 'mfs')
                            <div>
                                <label for="wallet" class="mb-2 block text-sm font-medium text-gray-900 required"> Sender Account No. </label>
                                <input type="number" wire:model="wallet" id="wallet" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="" />
                            </div>
                            <div>
                                <label for="transactionId" class="mb-2 block text-sm font-medium text-gray-900 required"> Transaction ID </label>
                                <input type="text" wire:model="transactionId" id="transactionId" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="" />
                            </div>
                        @else
                            <div class="col-span-2">
                                <div class="mb-2 flex items-center gap-2">
                                    <label for="transactionInfo" class="block text-sm font-medium text-gray-900 required"> Transaction Information </label>
                                </div>
                                <textarea wire:model="transactionInfo" placeholder="All the necessary information to verify your transaction" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 min-h-[100px]"></textarea>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <button
                wire:click="confirmOrder"
                type="button"
                @if(
                count($cartContent) < 1 ||
                ($showDeliveryMethod && empty($deliveryMethod)) ||
                empty($paymentMethod)
                )
                    disabled
                @endif
                class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-500 disabled:cursor-not-allowed font-bold">
                Confirm Order
            </button>
        </div>
    @endif
</div>
