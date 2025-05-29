<section class="bg-white py-8 antialiased md:py-16">
    <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <ol class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 sm:text-base">
            <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                    <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] sm:after:hidden gap-2 text-blue-600">
                      <i class="fa-regular fa-check-circle"></i> Cart
                    </span>
            </li>
            <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                    <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] sm:after:hidden gap-2 text-blue-600">
                        <i class="fa-regular fa-check-circle"></i> Checkout
                    </span>
            </li>
            <li class="flex shrink-0 items-center gap-2">
                <i class="fa-regular fa-check-circle"></i>  Order summary
            </li>
        </ol>
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
            <div class="min-w-0 flex-1 space-y-8">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900">Delivery Details</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-900 required"> Your name </label>
                            <input type="text" wire:model="name" id="name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="" />
                        </div>
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 required"> Your email </label>
                            <input type="email" wire:model="email" id="email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="" />
                        </div>
                        <div class="group">
                            <label for="mobile" class="mb-2 block text-sm font-medium text-gray-900 required">
                                Phone Number
                            </label>
                            <div class="flex items-center">
                                <span class="z-10 inline-flex shrink-0 items-center rounded-s-lg border border-gray-300 bg-gray-100 px-4 py-2.5 text-center text-sm font-medium text-gray-900 gap-1 group-hover:border-primary-500">
                                    <img src="{{ url('/assets/images/icon/BD-Flag.svg') }}" alt="BD" class="h-[12px] w-auto rounded-sm"/> +88
                                </span>
                                <div class="relative w-full">
                                    <input
                                        type="text"
                                        wire:model="mobile"
                                        id="mobile"
                                        class="block w-full rounded-e-lg border border-s-0 border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 group-hover:border-primary-500"
                                        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                        placeholder="01"
                                        />
                                </div>
                            </div>
                        </div>

                        @if(true)
                            <p class="col-span-2 text-xs font-normal text-orange-500 text-center">You're logged in! To continue sign up during order confirmation, please enter a password.</p>
                            <div>
                                <label for="password" class="mb-2 block text-sm font-medium text-gray-900 required"> Password </label>
                                <input type="password" wire:model="password" id="password" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="" />
                            </div>
                            <div>
                                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-900 required"> Confirm Password </label>
                                <input type="password" wire:model=password_confirmation" id="password_confirmation" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="" />
                            </div>
                        @endif


                        @if($hideCountryCity)
                            <div>
                                <div class="mb-2 flex items-center gap-2">
                                    <label for="country" class="block text-sm font-medium text-gray-900 required"> Country </label>
                                </div>
                                <select wire:model="country" id="country" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                                    <option value="Bangladesh">Bangladesh</option>
                                </select>
                            </div>
                            <div>
                                <div class="mb-2 flex items-center gap-2">
                                    <label for="city" class="block text-sm font-medium text-gray-900 required"> City </label>
                                </div>
                                <select id="city" wire:model="city" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                                    <option selected>Select City</option>
                                </select>
                            </div>
                        @endif
                        <div class="col-span-2">
                            <div class="mb-2 flex items-center gap-2">
                                <label for="address" class="block text-sm font-medium text-gray-900 required"> Delivery Address </label>
                            </div>
                            <textarea wire:model="address" placeholder="City, Area, Street/Road No., Street name, House number, (Apartment, suite, unit, etc are optional)" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 min-h-[100px]"></textarea>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900">Delivery Methods</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        @foreach($deliveryMethods as $DM)
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input wire:change="updateDeliveryMethod($event.target.value)" id="delivery-method-{{ $DM->id }}" aria-describedby="{{ $DM->details }}" type="radio" name="delivery-method" value="{{ $DM->id }}" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600" />
                                    </div>
                                    <div class="ms-4 text-sm">
                                        <label for="delivery-method-{{ $DM->id }}" class="font-medium leading-none text-gray-900">
                                            {{ $DM->name }} </label>
                                        <p class="mt-1 text-xs font-normal text-gray-500">{{ $DM->cost }}৳</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900">Payment method</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        @foreach($paymentMethods as $PM)
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 relative">
                                @if(!empty($PM->logo))<span class="absolute top-0 left-[50%] -translate-x-[50%] -translate-y-[50%] px-2 py-0.5 rounded-full bg-gray-200 text-xs font-medium m">{{ $PM->name }}</span>@endif
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input wire:change="updatePaymentMethod($event.target.value)" id="payment-method-{{ $PM->id }}" aria-describedby="{{ $PM->description }}" type="radio" name="payment-method" value="{{ $PM->id }}" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 {{ !empty($PM->logo) ? 'mt-[5px]' : '' }}" />
                                    </div>
                                    <div class="ms-4 text-sm">
                                        <label for="payment-method-{{ $PM->id }}" class="font-medium leading-none text-gray-900">
                                            @if(!empty($PM->logo))
                                                <img src="{{ $PM->logo }}" alt="{{ $PM->name }}" class="h-[24px] w-auto" />
                                            @else
                                                {{ $PM->name }}
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
                <div class="flow-root {{ $checkoutPage ? 'checkout-order-review' : '' }}">
                    <livewire:order.summary heading="false" :$checkoutPage :show-delivery-method="true"  />
                </div>
            </div>
        </div>
    </form>
</section>
