<x-dashboard.index title="Products">
    <x-slot:headerRight>
        @if($trash_count > 0 || $trashPage)
            <a
                href="{{ route('product.index.trash') }}"
                class="mr-2 group {{ $trashPage ? 'bg-red-600 text-white hover:bg-red-600 hover:text-white' : '' }} w-[110px] border border-red-600 text-red-600 px-4 h-[32px] hover:bg-[#ffeef5] focus:outline-none focus:ring-2 focus:ring-red-500 text-xs cursor-pointer disabled:cursor-not-allowed transition-all duration-200 relative rounded-md inline-flex items-center justify-center gap-1"
            >
                <i class="fas fa-trash-alt"></i> Trash
                <span class="{{ $trash_count >= 10 ? 'rounded-sm px-[5px]' : 'rounded-full' }} top-[-5px] right-[-5px] inline-flex items-center justify-center bg-[#ffd3e5] text-red-600 h-[18px] min-w-[18px] transition-colors duration-200">
                {{ $trash_count }}
            </span>
            </a>
        @endif

        <a href="{{ route('product.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    </x-slot:headerRight>

    <div class="flex-1 w-full relative overflow-auto  {{ $products->hasPages() ? 'pb-[38px]' : '' }}">
        @if($products->count() < 1)
            <x-notfound icon="fa-light fa-cubes" text="Products not found" :$trashPage />
        @else
            <table class="min-w-full leading-normal">
                <thead class="sticky top-0">
                    <tr>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Image
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left min-w-[150px]">
                            Product Name
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Value
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Category
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Type
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Amount
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Com.
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            Status
                        </th>
                        <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">
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
                                {{ $product->price }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $product->commission }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-xs text-center">
                                @if ($product->status === 'publish')
                                    <span class="inline-block px-2 py-0.5 text-green-500 border border-green-500 rounded-full">
                                        Published
                                    </span>
                                @elseif ($product->status === 'draft')
                                    <span class="inline-block px-2 py-0.5 text-yellow-500 border border-yellow-500 rounded-full">
                                        Draft
                                    </span>
                                @elseif ($product->status === 'private')
                                    <span class="inline-block px-2 py-0.5 text-gray-500 border border-gray-500 rounded-full">
                                        Private
                                    </span>
                                @elseif ($product->status === 'NA')
                                    <span class="inline-block px-2 py-0.5 text-[red] border border-[red] rounded-full text-nowrap">
                                        Not Available
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-right">
                                <livewire:product.actions :$product wire:key="{{ $product->id }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Pagination -->
    <x-pagination :data="$products" class="inner-col-pagination"/>
</x-dashboard.index>
