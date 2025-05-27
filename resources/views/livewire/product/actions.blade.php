<div class="inline-flex items-center">
    {{--<span wire:loading wire:target="delete, restore" class="inline-flex mr-2">
        <i class="inline-flex fas fa-circle-notch fa-spin"></i>
    </span>--}}
    <div class="inline-flex rounded-md">
        @if(!$product->trashed())
            <a title="Edit" href="{{ route('product.edit', $product->id) }}" class="inline-flex items-center justify-center h-[24px] w-[24px] text-[12px] border border-gray-300 rounded-l-sm text-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-edit"></i>
            </a>
            <a title="Delete" href="{{ route('product.delete', $product->id) }}/redirect" class="inline-flex items-center justify-center h-[24px] w-[24px] text-[12px] border border-gray-300 rounded-r-sm text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-trash"></i>
            </a>
        @else
            <a href="{{ route('product.restore', $product->id) }}/redirect" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-l-sm text-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                <i class="fas fa-trash-restore mr-2"></i> Restore
            </a>
            <a href="{{ route('product.deletePermanent', $product->id) }}/redirect" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-r-sm text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer text-nowrap">
                <i class="fas fa-trash mr-2"></i> Delete Permanently
            </a>
        @endif
    </div>
</div>

