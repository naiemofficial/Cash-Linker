<div class="h-full flex flex-col {{ $products->hasPages() ? 'pb-[38px]' : '' }}">
    <div class="overflow-auto rounded-lg">
        <table class="min-w-full leading-normal">
            <thead class="sticky top-0">
            <tr>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center rounded-tl-lg">
                    Image
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left min-w-[150px]">
                    Product Name
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Category
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Type
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Value
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Amount
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    Extra
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                    QTY
                </th>
                <th class="bg-white px-5 py-4 border-b-2 border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right rounded-tr-lg">

                </th>
            </tr>
            </thead>
            <tbody class="">
            @foreach($products as $index => $product)
                @php
                    $last_row       = ($index === $products->count()-1);
                    $rounded_bottom = (!$products->hasPages() && $last_row) ? true : false;
                @endphp
                <tr wire:key="{{ $product->id }}">
                    <td class="px-5 py-2  {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-center leading-none min-h-[53px] h-[53px] {{ $rounded_bottom ? 'rounded-bl-lg' : '' }}">
                        @if($product->type == 'coin')
                            <div class="inline-flex h-8 w-8 rounded-full bg-gray-100 border border-gray-200 items-center justify-center p-[1px]">
                                @if(empty($product->image))
                                    <i class="fa-solid fa-image text-gray-400"></i>
                                @else
                                    <img class="w-full h-auto object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                                @endif
                            </div>
                        @else
                            <div class="inline-flex w-16 min-h-8 rounded-sm bg-gray-100 border border-gray-200 items-center justify-center">
                                @if(empty($product->image))
                                    <i class="fa-solid fa-image text-gray-400"></i>
                                @else
                                    <img class="w-auto h-auto object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="px-5 py-2 {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-left">
                        {{ $product->name }}
                    </td>
                    <td class="px-5 py-2 {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-center">
                        {{ ucwords(str_replace('-', ' ', $product->category)) }}
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                        {{ ucwords(str_replace('-', ' ', $product->type)) }}
                    </td>
                    <td class="px-5 py-2 {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-center">
                        {{ $product->value }}
                    </td>
                    <td class="px-5 py-2 {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-center">
                        {{ $product->price }}
                    </td>
                    <td class="px-5 py-2 {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-center">
                        {{ $product->commission }}
                    </td>
                    <td class="px-5 py-2 {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-center">
                        <input type="number" min="1" wire:model="quantity.{{ $product->id }}" wire:change="updateQuantity('{{ $product->id }}', $event.target.value)" class="w-12 p-[4px] text-center text-sm border border-gray-300 rounded">
                    </td>
                    <td class="px-5 py-2 {{ !$last_row ? 'border-b' : 'border-b-0' }} border-gray-200 bg-white text-sm text-right {{ $rounded_bottom ? 'rounded-br-lg' : '' }}">
                        <button wire:click="addToCart({{ $product->id }})" class="px-2 py-[5px] text-white text-xs font-medium bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md text-nowrap">
                            Add to Cart
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <x-pagination-livewire class="inner-col-pagination" :data="$products" />
</div>
