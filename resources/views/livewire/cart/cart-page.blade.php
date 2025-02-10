<main class="wrapper grid grid-cols-2 py-8 gap-y-2 md:gap-y-10"
      x-data="{ subtotal: @entangle('subtotal') }">
    <header class="col-start-1 col-end-3 grid justify-center text-center">
        <h1 class="font-volkhov text-[clamp(30px,6.5vw,42px)]">{{__('Shopping Cart')}}</h1>
        <div class="flex items-center gap-3 justify-self-center">
            <p class="">{{__('Home')}}</p>
            <x-global.svg.caret-right-mark />
            <p class="">{{__('Your Shopping Cart')}}</p>
        </div>
    </header>
            
    <section class="col-start-1 col-end-3"> <!--items that are going to be bought-->
        <div class="grid md:grid-cols-7 font-volkhov text-[clamp(18px,1.8vw,22px)] border-b border-black/40 py-5">
            <h2 class="col-start-1 col-end-2">{{__('Product')}}</h2>
            <h2 class="col-start-3 col-end-4 justify-self-center hidden md:block">{{__('Price')}}</h2>
            <h2 class="col-start-5 col-end-6 hidden md:block">{{__('Quantity')}}</h2>
            <h2 class="col-start-7 col-end-8 justify-self-end">{{__('Total')}}</h2>
        </div>

        @if($cartItems->isEmpty())
            <p>Empty.</p>
        @else
            @foreach ($cartItems as $item)
                <div wire:key="item-{{ $item->id }}">
                    @livewire('global.ui.item-cart', ['item' => $item], key($item->id))
                </div>
            @endforeach
        @endif
    </section>
    

    <footer class="col-start-1 md:col-start-2 col-end-3 grid place-items-center text-[clamp(15px,1.8vw,22px)] gap-2 md:gap-3 pt-2" 
            x-data="{ wrap: false }">
        <aside class="flex items-center justify-self-start gap-4 pb-4 w-full border-b border-black/40">
            <!-- Checkbox bound to the Alpine variable 'wrap' On change, it calls the Livewire method 
                'wrapCart' with the current value of wrap -->
            <input type="checkbox" x-model="wrap" @change="$wire.call('wrapCart', wrap)"
                   class="w-6 h-6 border-[3px] border-black bg-white 
                          checked:bg-gray-400 checked:border-gray-400 focus:outline-none focus:ring-0 active:bg-gray-400">
            <label class="text-gray-400">
                {{ __('For') }} <span class="text-black">$10.00</span> {{ __('Please Wrap The Product') }}
            </label>
        </aside>
            
        <!-- Display the subtotal value (formatted to two decimals) -->
        <div class="flex justify-between w-full">
            <p>{{ __('Subtotal') }}</p>
            <p>$<span x-text="(parseFloat(subtotal)).toFixed(2)"></span></p>
        </div>

        <!-- Display the shipping value -->
        <div class="flex justify-between w-full">
            <p>{{ __('Shipping') }}</p>
            <p><span>{{ $shippingPrice }}</span></p>
        </div>

        <!-- Checkout button that opens the checkout route in the top window -->
        <button class="btn btn-filled btn-primary capitalize text-[clamp(14px,5vw,16px)] shadow-xl shadow-black/15 w-full p-2 md:p-5"
                onclick="window.open('{{ route('checkout') }}', '_top')">
            {{ __('Checkout') }}
        </button>
    </footer>
</main>
