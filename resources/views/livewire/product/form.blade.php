<form wire:submit.prevent="submit">
    <div class="grid gap-5 sm:grid-cols-4 sm:gap-6">
        <div class="sm:col-span-4">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 required">Product Name</label>
            <input wire:model="name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type product name" required="">
        </div>
        <div class="w-full">
            <label for="value" class="block mb-2 text-sm font-medium text-gray-900 required">Value</label>
            <select wire:model="value" id="value" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                <option value="">Select value</option>
                @foreach($values as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 required">Category</label>
            <select wire:model="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ ucwords(str_replace('-', ' ', $category)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full">
            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 required">Type</label>
            <select wire:model="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                <option value="">Select type</option>
                @foreach($types as $type)
                    <option value="{{ $type }}">{{ ucwords(str_replace('-', ' ', $type)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full">
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
            <select wire:model="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                <option value="">Select year</option>
                @for($year = now()->year; $year >= 1972; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
        <div class="sm:col-span-2">
            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 required">Amount</label>
            <input wire:model="amount" type="number" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="৳10" required="">
        </div>
        <div class="sm:col-span-2">
            <label for="commission" class="block mb-2 text-sm font-medium text-gray-900 required">Commission</label>
            <input wire:model="commission" type="number" id="commission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="৳5" required="">
        </div>
        <div class="sm:col-span-2 h-[300px]">
            <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900">Image URL</label>
            <input wire:model.live="image" type="url" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="https://" required="">
            <div class="border-[2px] border-dashed rounded-xl w-full h-[230px] mt-2 p-5 flex items-center justify-center bg-gray-50">
                @if(filter_var($image, FILTER_VALIDATE_URL) && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $image))
                    <img src="{{ $image }}" class="max-h-[300px] rounded-lg" />
                @else
                    <i class="fa-duotone fa-solid fa-money-bill text-9xl text-gray-300"></i>
                @endif
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
            <textarea wire:model="description" id="description" rows="8" class="h-[280px] block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Product description"></textarea>
        </div>
    </div>
</form>
