<form wire:submit.prevent="submit">
    <div class="grid gap-5 sm:grid-cols-4 sm:gap-6">
        <div class="sm:col-span-3">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 required">Method Name</label>
            <input wire:model="name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type delivery method name" required="">
        </div>
        <div class="sm:col-span-1">
            <label for="cost" class="block mb-2 text-sm font-medium text-gray-900 required">Cost</label>
            <input wire:model="cost" type="number" id="cost" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="৳10" required="">
        </div>
        <div class="sm:col-span-4">
            <label for="details" class="block mb-2 text-sm font-medium text-gray-900">Details</label>
            <textarea wire:model="details" id="details" rows="8" class="h-[280px] block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Delivery method details"></textarea>
        </div>
    </div>
</form>
