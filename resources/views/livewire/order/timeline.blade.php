<ol class="relative border-s border-gray-200">
    <li class="mb-10 ms-4">
        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border-[2px] border-white"></div>
        <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $order->created_at->diffForHumans() }} <span class="text-xs text-gray-400">({{ $order->created_at }})</span></time>
        <h4 class="text-sm font-medium text-gray-700">Order created successfully!</h4>
{{--        <p class="mb-4 text-sm font-normal text-gray-500">Get access to over 20+ pages including a dashboard layout, charts, kanban board, calendar, and pre-order E-commerce & Marketing pages.</p>--}}
    </li>
    <li class="mb-10 ms-4">
        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border-[2px] border-white"></div>
        <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $order->updated_at->diffForHumans() }} <span class="text-xs text-gray-400">({{ $order->created_at }})</span></time>
        <h4 class="text-sm font-medium text-gray-700">Status updated to <span class="inline-block px-2 py-0.5 bg-gray-600 text-white border border-gray-600 rounded-full text-xs">Pending</span>
    </li>
</ol>
