<form wire:submit.prevent="submit">
    <div class="grid gap-5 sm:grid-cols-4 sm:gap-6">
        <div class="sm:col-span-4">
            <label for="note" class="block mb-2 text-sm font-medium text-gray-900">Note</label>
            <textarea wire:model="note" id="note" rows="8" class="h-[280px] block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Product description"></textarea>
        </div>
    </div>
</form>
