<div class="inline-flex items-center mt-2">
    {{--<span wire:loading wire:target="delete, restore" class="inline-flex mr-2">
        <i class="inline-flex fas fa-circle-notch fa-spin"></i>
    </span>--}}
    <div class="inline-flex rounded-md">
        @if(!$deliveryMethod->trashed())
            <a title="Edit" href="{{ route('delivery-method.edit', $deliveryMethod->id) }}" class="inline-flex items-center justify-center h-[24px] w-[24px] text-[12px] border border-gray-300 rounded-l-sm text-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-edit"></i>
            </a>
            <button title="Delete" type="button" wire:click="delete({{ $deliveryMethod->id }})" class="inline-flex items-center justify-center h-[24px] w-[24px] text-[12px] border border-gray-300 rounded-r-sm text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-trash"></i>
            </button>
        @else
            <button type="button" wire:click="restore({{ $deliveryMethod->id }})" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-l-sm text-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                <i class="fas fa-trash-restore mr-2"></i> Restore
            </button>
            <button type="button" wire:click="delete({{ $deliveryMethod->id }}, 'trash')" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-r-sm text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-trash mr-2"></i> Delete Permanently
            </button>
        @endif
    </div>
</div>

