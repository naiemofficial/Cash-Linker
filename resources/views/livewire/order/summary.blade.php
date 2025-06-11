<div class="w-full rounded-lg h-screen flex flex-1 flex-col ">
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
        <livewire:order.item-list wire:key="{{ rand(1, 1000) }}" product-source="cartContent" :products="$cartContent" :quantity="$quantity" :editable="true" :$checkoutPage />
   @endif



    <div class="flex flex-col flex-shrink-0 flex-grow-0 flex-auto border-t border-gray-200 pt-4 space-y-2 mt-auto px-6 py-3 mb-3 proceed-checkout">
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
