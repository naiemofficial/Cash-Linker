<x-dashboard.index title="Products">
    <x-slot:headerRight>
        <a href="{{ route('product.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    </x-slot:headerRight>

    <div class="inline-block min-w-full rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead class="sticky top-0">
            <tr>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Image
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">
                    Product Name
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Value
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Category
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Type
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Amount
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Commission
                </th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">
                    Action
                </th>
            </tr>
            </thead>
            <tbody class="overflow-y-auto">
            @foreach($products as $product)
                <tr>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="inline-flex w-16 {{ str_contains($product->type, 'penny') ? 'h-16' : 'h-auto min-h-8'  }} rounded-sm bg-gray-100 border border-gray-200 items-center justify-center">
                            @if(empty($product->image))
                                <i class="fa-solid fa-image text-gray-400"></i>
                            @else
                                <img class="w-full h-full object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                            @endif
                        </div>
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                        {{ $product->name }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $product->value }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        {{ ucwords(str_replace('-', ' ', $product->category)) }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        {{ ucwords(str_replace('-', ' ', $product->type)) }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $product->amount }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $product->commission }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-right">
                        <livewire:product.actions :$product wire:key="{{ $product->id }}" />
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

        <!-- Pagination -->
    </div>
</x-dashboard.index>
