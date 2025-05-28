@if(method_exists($data, 'hasPages') && $data->hasPages())
    <div class="{{ isset($position) ? $position : 'absolute bottom-0' }} {{ !isset($rounded) || $rounded !== 'false' ? 'rounded-br-md rounded-bl-md' : '' }} border-t-[1px] border-solid border-gray-200 w-full bg-gray-200 px-8 py-[4px] {{ $class }}">
        {{ $data->links('vendor.livewire.tailwind-custom') }}
    </div>
@endif
