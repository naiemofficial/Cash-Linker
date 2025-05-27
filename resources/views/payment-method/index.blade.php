<x-dashboard.index title="Payment Methods">
    <x-slot:headerRight>
        @if($trash_count > 0 || $trashPage)
            <a
                href="{{ route('payment-method.index.trash') }}"
                class="mr-2 group {{ $trashPage ? 'bg-red-600 text-white hover:bg-red-600 hover:text-white' : '' }} w-[110px] border border-red-600 text-red-600 px-4 h-[32px] hover:bg-[#ffeef5] focus:outline-none focus:ring-2 focus:ring-red-500 text-xs cursor-pointer disabled:cursor-not-allowed transition-all duration-200 relative rounded-md inline-flex items-center justify-center gap-1"
            >
                <i class="fas fa-trash-alt"></i> Trash
                <span class="{{ $trash_count >= 10 ? 'rounded-sm px-[5px]' : 'rounded-full' }} top-[-5px] right-[-5px] inline-flex items-center justify-center bg-[#ffd3e5] text-red-600 h-[18px] min-w-[18px] transition-colors duration-200">
                {{ $trash_count }}
            </span>
            </a>
        @endif


        <a href="{{ route('payment-method.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Add Payment Method
        </a>
    </x-slot:headerRight>

    <div class="flex-1 w-full relative overflow-auto  {{ $paymentMethods->hasPages() ? 'pb-[38px]' : '' }}">
        @if($paymentMethods->count() < 1)
            <x-notfound icon="fa-light fa-credit-card-front" text="Payment methods not found" :$trashPage />
        @else
            <table class="min-w-full leading-normal">
                <thead class="sticky top-0">
                <tr>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Logo
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">
                        Name
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Account no.
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Type
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Category
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Status
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody class="overflow-y-auto">
                    @foreach($paymentMethods as $paymentMethod)
                        <tr>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="p-1 inline-flex w-14 h-auto min-h-7 rounded-sm bg-gray-100 border border-gray-200 items-center justify-center">
                                    @if(empty($paymentMethod->logo))
                                        <i class="fa-solid fa-image text-gray-400"></i>
                                    @else
                                        <img class="w-full h-full object-cover" src="{{ $paymentMethod->logo }}" alt="{{ $paymentMethod->logo }}">
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                                {{ $paymentMethod->name }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $paymentMethod->account_no }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                {{ ucwords(str_replace('-', ' ', $paymentMethod->type)) }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                {{ ucwords(str_replace('-', ' ', $paymentMethod->category)) }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-xs text-center">
                                @if ($paymentMethod->status === 'active')
                                    <span class="inline-block px-2 py-0.5 text-green-500 border border-green-500 rounded-full">
                                        Active
                                    </span>
                                @elseif ($paymentMethod->status === 'inactive')
                                    <span class="inline-block px-2 py-0.5 text-[red] border border-[red] rounded-full">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-right">
                                <livewire:payment-method.actions :$paymentMethod wire:key="{{ $paymentMethod->id }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Pagination -->
    <x-pagination :data="$paymentMethods" class="inner-col-pagination"/>
</x-dashboard.index>
