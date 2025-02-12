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
    <x-modules.cart.footer 
        :wrapStatus="$wrapStatus"
        :subtotal="$subtotal"
        :show="false"
    />
    
</div>
