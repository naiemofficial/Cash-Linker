<div id="modalBackdrop"></div>

<div id="rightModalSidebar">
    <div class="p-4 flex justify-between items-center border-b border-gray-900 bg-gray-800">
        <h2 class="font-semibold text-xl leading-tight text-white"> Order Summary </h2>
        <button id="closeRightModalSidebar" class="text-gray-200 hover:text-gray-300 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-full h-[16px] w-[16px] inline-flex items-center justify-center">
            <i class="fa-light fa-circle-xmark"></i>
        </button>
    </div>
    <div>
        <livewire:order.summary heading="false" />
    </div>
</div>
