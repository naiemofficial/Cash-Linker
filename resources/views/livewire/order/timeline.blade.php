<ol class="relative border-s border-gray-200">
    @foreach($logs as $index => $log)
        @php
            if($log->status === 'pending'){
                $color = 'gray-600';
            } else if(in_array($log->status, ['completed', 'delivered'])){
                $color = 'green-500';
            } else if($log->status === 'cancelled'){
                $color = '[red]';
            }  else {
                $color = 'blue-600';
            }
        @endphp
        <li class="mb-10 ms-4">
            <div class="absolute w-3 h-3 bg-{{ $index == 0 ? $color : 'gray-200' }} rounded-full mt-1.5 -start-1.5 border-[2px] border-white"></div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $log->created_at->diffForHumans() }} <span class="text-xs text-gray-400">({{ $log->created_at }})</span></time>
            @if(!empty($log->status))
                <h4 class="text-sm font-medium text-gray-700">Status updated to <span class="inline-block px-2 py-0.5 bg-{{ $color }} text-white border border-{{ $color }} rounded-full text-xs">{{ ucwords(str_replace('-', ' ', $log->status)) }}</span></h4>
            @endif
            @if(!empty($log->note))
                <p class="{{ !empty($log->status) ? 'mb-4' : '' }} text-xs font-normal text-gray-500">{{ $log->note }}</p>
            @endif
        </li>
    @endforeach
    <li class="mb-10 ms-4">
        <div class="absolute w-3 h-3 bg-{{ $logs->count() == 0 ? 'gray-600' : 'white' }} rounded-full mt-1.5 -start-1.5 border-[2px] border-white"></div>
        <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $order->created_at->diffForHumans() }} <span class="text-xs text-gray-400">({{ $order->created_at }})</span></time>
        <h4 class="text-sm font-medium text-gray-700">Status updated to <span class="inline-block px-2 py-0.5 bg-gray-600 text-white border border-gray-600 rounded-full text-xs">Pending</span></h4>
    </li>
    <li class="ms-4">
        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border-[2px] border-white"></div>
        <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $order->created_at->diffForHumans() }} <span class="text-xs text-gray-400">({{ $order->created_at }})</span></time>
        <h4 class="text-sm font-medium text-gray-700">Order created successfully!</h4>
    </li>
</ol>
