<div class="inline-flex flex-row">
    @if($form == 'edit')
        <form wire:submit.prevent="submit" class="inline-flex items-center">
            <div class="text-sm inline-flex flex-row items-center content-center space-x-3 min-w-[150px] mr-2">
                <div class="inline-flex flex-row items-center space-x-1">
                    @php
                        if($order->status === 'pending'){
                            $color = 'gray-600';
                        } else if(in_array($order->status, ['completed', 'delivered'])){
                            $color = 'green-500';
                        } else if($order->status === 'cancelled'){
                            $color = '[red]';
                        }  else {
                            $color = 'blue-600';
                        }
                    @endphp
                    @if(!in_array($order?->status, ['cancelled', 'delivered']))
                        <select wire:model="status" id="status" class="min-w-[120px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}">{{ ucwords(str_replace('-', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    @else
                        <span class="inline-block px-2 py-0.5 bg-{{ $color }} text-white border border-{{ $color }} rounded-full">
                            {{ ucwords(str_replace('-', ' ', $order->status)) }}
                        </span>
                    @endif
                </div>
                <div>
                    <input type="text" wire:model="note" placeholder="Note" class="min-w-[300px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" />
                </div>
            </div>
        </form>
    @endif

    <button
        wire:click="update"
        wire:loading.attr="disabled"
        type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <span class="h-[20px] w-[20px] inline-flex items-center justify-center mr-1">
            {{--<i wire:loading class="fas fa-circle-notch fa-spin"></i>--}}
            <i wire:loading.remove class="fas {{ $form == 'edit' ? (in_array($order->status, ['cancelled', 'delivered']) ? 'fa-circle-plus' : 'fa-arrows-rotate') : 'fa-plus-circle' }}"></i>
        </span>

        {{ $form == 'edit' ? (in_array($order->status, ['cancelled', 'delivered']) ? 'Add note' : 'Update') : 'Submit' }}
    </button>
</div>
