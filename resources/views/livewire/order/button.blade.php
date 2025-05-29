<div class="inline-flex flex-row">
    @if($form == 'edit')
        <form wire:submit.prevent="submit">
            <div class="inline-flex flex-row items-center content-center space-x-1 w-[150px] mr-2">
            </div>
        </form>
    @endif

    <button
        wire:click="submit"
        wire:loading.attr="disabled"
        type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <span class="h-[20px] w-[20px] inline-flex items-center justify-center mr-1">
            {{--<i wire:loading class="fas fa-circle-notch fa-spin"></i>--}}
            <i wire:loading.remove class="fas {{ $form == 'edit' ? 'fa-arrows-rotate' : 'fa-plus-circle' }}"></i>
        </span>

        {{ $form == 'edit' ? 'Update' : 'Submit' }}
    </button>
</div>
