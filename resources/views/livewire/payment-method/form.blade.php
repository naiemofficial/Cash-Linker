<form wire:submit.prevent="submit">
    <div class="grid gap-5 sm:grid-cols-4 sm:gap-6">
        <div class="sm:col-span-2 h-[340px]">
            <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 required">Logo URL</label>
            <input wire:model.live="logo" type="url" id="logo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="https://" required="">
            <div class="border-[2px] border-dashed rounded-xl w-full h-[262px] mt-2 p-5 flex items-center justify-center bg-gray-50">
                @if(filter_var($logo, FILTER_VALIDATE_URL) && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $logo))
                    <img src="{{ $logo }}" class="max-h-[100%] rounded-lg" />
                @else
                    <i class="fa-duotone fa-solid fa-money-bill text-9xl text-gray-300"></i>
                @endif
            </div>
        </div>
        <div class="sm:col-span-2 flex flex-col justify-between h-[340px]">
            <div class="w-full">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 required">Payment Method Name</label>
                <input wire:model="name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type payment method name" required="">
            </div>
            <div class="grid gap-5 sm:grid-cols-2 mt-5">
                <div class="">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 required">Account Type</label>
                    <select wire:model="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        <option value="">Select account type</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ ucwords(str_replace('-', ' ', $type)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 required">Account Category</label>
                    <select wire:model="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        <option value="">Select account category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ ucwords(str_replace('-', ' ', $category)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 mt-5">
                <div class="">
                    <label for="account_no" class="block mb-2 text-sm font-medium text-gray-900 required">Account number</label>
                    <input wire:model="account_no" type="number" id="account_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="" required="">
                </div>
                <div class="">
                    <label for="account_name" class="block mb-2 text-sm font-medium text-gray-900 required">Account name</label>
                    <input wire:model="account_name" type="text" id="account_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="" required="">
                </div>
            </div>

            <div class="sm:col-span-2 mt-5">
                <label for="swift_code" class="block mb-2 text-sm font-medium text-gray-900">SWIFT Code</label>
                <input wire:model="swift_code" type="text" id="swift_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="" required="">
            </div>
        </div>
        <div class="sm:col-span-4">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
            <textarea wire:model="description" id="description" rows="8" class="h-[200px] block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Payment method description"></textarea>
        </div>
    </div>
</form>
