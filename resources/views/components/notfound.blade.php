<div class="h-full flex items-center justify-center content-center relative">
    <p class="text-lg text-gray-400">
        @if(!empty($icon)) <i class="{{ $icon }}"></i> @endif {{ $text }} {{ $trashPage ? ' in trash' : '' }}
    </p>
</div>
