@props([
    // The subtotal to display (as a string or numeric value)
    'subtotal' => '0',
    // The shipping price to display
    'shippingPrice' => '0',
    // Whether to display the shipping section and the link to the cart Page (default: true)
    'show' => true,
    // The checkout link URL (default: route('checkout'))
    'link1' => route('checkout'),
    // Wrapper classes to control the layout
    'wrapperClass' => 'col-start-1 md:col-start-2 col-end-3'
])

<footer class="{{ $wrapperClass }} grid place-items-center text-[clamp(15px,1.8vw,22px)] gap-2 md:gap-3 pt-2">
    <!-- Wrap Checkbox and Label -->
    <aside class="flex items-center justify-self-start gap-4 pb-4 w-full border-b border-black/40">
        <!-- 
             Bind the checkbox to the global store's "wrap" property.
             On change, call the Livewire method "wrapCart" passing the global value.
        -->
        <input type="checkbox"
               x-model="$store.wrapState.wrap"
               @change="$wire.call('wrapCart', $store.wrapState.wrap)"
               class="w-6 h-6 border-[3px] border-black bg-white 
                      checked:bg-gray-400 checked:border-gray-400 focus:outline-none focus:ring-0 active:bg-gray-400">
        <label class="text-gray-400">
            {{ __('For') }} <span class="text-black">$10.00</span> {{ __('Please Wrap The Product') }}
        </label>
    </aside>
    
    <!-- Subtotal Display -->
    <div class="flex justify-between w-full font-volkhov">
        <p>{{ __('Subtotal') }}</p>
        <p>$<span x-text="(parseFloat({{ $subtotal }}) || 0).toFixed(2)"></span></p>
    </div>

    <!-- Optionally display Shipping Information -->
    @if ($show)
    <div class="flex justify-between w-full font-volkhov">
        <p>{{ __('Shipping') }}</p>
        <p><span>{{ $shippingPrice }}</span></p>
    </div>
    @endif

    <!-- Checkout Button -->
    <button class="btn btn-filled btn-primary capitalize text-[clamp(14px,5vw,16px)] shadow-xl shadow-black/15 w-full p-2 md:p-5"
            onclick="window.open('{{ $link1 }}', '_top')">
        {{ __('Checkout') }}
    </button>

    <!-- Optionally display the Cart Link (only used on the mini-cart) -->
    @if (!$show)
    <a class="font-volkhov underline" href="{{ route('cart') }}" target="_top">{{ __('View Cart') }}</a>
    @endif

</footer>
