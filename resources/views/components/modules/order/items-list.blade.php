<div x-show="modalOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80"
    style="display: none;">
    <div class="bg-white rounded-lg p-6 max-w-5xl w-full">
        <h2 class="text-xl font-bold mb-4 text-primary-550">{{ __('Order Details') }}</h2>
        <div class="flex flex-col max-h-[50vh] overflow-auto no-visibility-scrollbar">
            <span class="flex justify-start" >Order # {{ $order->id }}</span>

            @if($order->order_items->isNotEmpty())
                <ul class="mt-2 space-y-2">
                @foreach($order->order_items as $item)
                        <li class="border p-2 rounded">
                            <span class="font-semibold">{{ __('Item ID') }}:</span> {{ $item->id }} <br>
                            <span class="font-semibold">{{ __('Product Variant') }}:</span> {{ $item->product_variant_id }} <br>
                            <span class="font-semibold">{{ __('Quantity') }}:</span> {{ $item->quantity }} <br>
                            <span class="font-semibold">{{ __('Unit Price') }}:</span> {{ $item->unit_price }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">{{ __('No items found for this order.') }}</p>
            @endif
        
        </div>
        
        <button type="button" 
            class="mt-4 px-4 py-2 bg-primary-600 text-white rounded"
            x-on:click="modalOpen = false">
            {{ __('Close') }}
        </button>
    </div>
</div>