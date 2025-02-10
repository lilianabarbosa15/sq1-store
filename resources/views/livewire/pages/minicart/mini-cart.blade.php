<div class="w-full h-full relative flex flex-col min-h-[95vh]"
     x-data="{ 
         subtotal: @entangle('subtotal'),               // Bind Livewire subtotal to Alpine
         cartItemsCount: @entangle('cartItemsCount')    // Bind Livewire cartItemsCount to Alpine
     }"
     x-init="
         // Dispatch a custom event 'cart-updated' on window when the component initializes.
         window.dispatchEvent(new CustomEvent('cart-updated', {
             detail: { cartItemsCount: cartItemsCount }
         }));
         
         // Set up a watcher on 'cartItemsCount' to dispatch an event every time it changes.
         $watch('cartItemsCount', value => {
             window.dispatchEvent(new CustomEvent('cart-updated', {
                 detail: { cartItemsCount: value }
             }));
         });
     ">
     
    <!-- HEADER SECTION -->
    <!--
         The header shows the title and a message regarding free shipping.
         It uses Alpine data to determine if free shipping is active (free = true)
         based on the difference between the minimum subtotal and the current subtotal.
    -->
    <header x-data="{ 
                      free: false,
                      minSubtotal: @entangle('minSubtotal'),
                      remainAmount: 0,
                      updateRemain() {
                          this.remainAmount = this.minSubtotal - this.subtotal;
                          if(this.remainAmount > 0) { 
                              this.free = false; 
                          } else { 
                              this.free = true;
                          }
                      }
                   }"
        x-init="
            // Initialize free shipping calculation on component load
            updateRemain();
            // Watch changes on subtotal and recalculate the remaining amount
            $watch('subtotal', value => updateRemain())
        ">
        <h1 class="text-[clamp(35px,4vw,42px)] font-volkhov">{{ __('Shopping Cart') }}</h1>
        <!-- This paragraph is only shown when free shipping is not reached -->
        <p x-show="!free" x-cloak class="text-[clamp(20px,2vw,26px)] text-gray-400">
            {{ __('Buy') }} <strong class="text-black">$<span x-text="(parseFloat(remainAmount)).toFixed(2)"></span></strong>
            {{ __('More And Get') }} <strong class="text-black">{{ __('Free Shipping') }}</strong>
        </p>
    </header>

    <!-- MAIN SECTION -->
    <!--
         The main area displays the list of cart items.
         If there are no items, it displays "Empty.".
         Otherwise, it loops through each item and includes a Livewire component
         to render that item.
    -->
    <main class="no-visibility-scrollbar flex flex-col grow overflow-y-auto flex-nowrap">
        @if($cartItems->isEmpty())
            <p>Empty.</p>
        @else
            @foreach ($cartItems as $item)
                <div wire:key="item-{{ $item->id }}">
                    @livewire('global.ui.mini-cart-item', ['item' => $item], key($item->id))
                </div>
            @endforeach
        @endif
    </main>

    <!-- FOOTER SECTION -->
    <!--
         The footer displays a checkbox for the wrapping option,
         the updated subtotal (which may include extra wrap price),
         checkout button, and cart button.
         It uses Alpine to manage the state of the checkbox.
    -->
    <footer class="grid place-items-center text-[clamp(18px,1.8vw,22px)] gap-3 pt-2" x-data="{ wrap: false }">
        <aside class="flex items-center justify-self-start gap-4 pb-4 w-full border-b border-black/40">
            <!-- Checkbox bound to the Alpine variable 'wrap'
                 On change, it calls the Livewire method 'wrapCart' with the current value of wrap -->
            <input type="checkbox" 
                   class="w-6 h-6 border-[3px] border-black bg-white 
                          checked:bg-gray-400 checked:border-gray-400 focus:outline-none focus:ring-0 active:bg-gray-400"
                   x-model="wrap"
                   @change="$wire.call('wrapCart', wrap)">
            <label class="text-gray-400">
                {{ __('For') }} <span class="text-black">$10.00</span> {{ __('Please Wrap The Product') }}
            </label>
        </aside>
            
        <!-- Display the subtotal value (formatted to two decimals) -->
        <div class="flex justify-between w-full">
            <p>{{ __('Subtotal') }}</p>
            <p>$<span x-text="(parseFloat(subtotal)).toFixed(2)"></span></p>
        </div>

        <!-- Checkout button that opens the checkout route in the top window -->
        <button class="btn btn-filled btn-primary capitalize text-[clamp(14px,5vw,16px)] shadow-xl shadow-black/15 w-full p-5"
                onclick="window.open('{{ route('checkout') }}', '_top')">
            {{ __('Checkout') }}
        </button>
        <!-- Link to view the cart -->
        <a class="font-volkhov underline" href="{{ route('cart') }}" target="_top">{{ __('View Cart') }}</a>
    </footer>
</div>
