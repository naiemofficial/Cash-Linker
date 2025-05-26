<x-dashboard.index title="Delivery Methods">
    <x-slot:headerRight>
        <a href="{{ route('delivery-method.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Add Delivery Method
        </a>
    </x-slot:headerRight>

    <div class="inline-block min-w-full rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead class="sticky top-0">
            <tr>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">
                    Name
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Cost
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
            @foreach($deliveryMethods as $deliveryMethod)
                <tr>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                        {{ $deliveryMethod->name }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $deliveryMethod->cost }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        @if ($deliveryMethod->status === 'active')
                            <span class="inline-block px-2 py-0.5 text-green-500 border border-green-500 rounded-full">
                                Active
                            </span>
                        @elseif ($deliveryMethod->status === 'inactive')
                            <span class="inline-block px-2 py-0.5 text-[red] border border-[red] rounded-full">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-right">
                        <livewire:delivery-method.actions :$deliveryMethod wire:key="{{ $deliveryMethod->id }}" />
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

        <!-- Pagination -->
    </div>
</x-dashboard.index>
