<!-- Initialize the Alpine store for cart data -->
<script>
    // When Alpine initializes, create a store named 'cartData'
    // with an initial cartItemsCount of 0.
    document.addEventListener('alpine:init', () => {
        Alpine.store('cartData', { cartItemsCount: 0 });
    });

    // Listen for the custom event 'cart-updated'
    // and update the Alpine store with the new cartItemsCount.
    window.addEventListener('cart-updated', event => {
        if (event.detail && typeof event.detail.cartItemsCount !== 'undefined') {
            Alpine.store('cartData').cartItemsCount = event.detail.cartItemsCount;
        }
    });
</script>

<!-- Main container with Alpine state for the modal open/close -->
<div {{ $attributes }} x-data="{ open: false }" class="relative flex">
    <!-- Shopping cart button -->
    <button @click="open = true" class="group border border-transparent p-1 box-border transition-all">
        <!-- Badge that displays the cart item count using Alpine store data -->
        <div class="z-1 size-4 bg-primary-600 rounded-full absolute -right-[-16%] -top-[-56%]
                    flex justify-center items-center align-middle text-white font-roboto font-bold text-xs">
            <span x-text="$store.cartData.cartItemsCount"></span>
        </div>    
        <!-- Shopping cart SVG icon component -->
        <x-global.svg.shopping-cart class="min-size-6 text-gray-900 hover:text-primary-600" />
    </button>

    <!-- Modal: Shows when 'open' is true -->
    <div x-bind:class="open ? 'flex' : 'hidden'" class="fixed right-0 top-0 flex justify-end z-10 w-screen h-screen bg-black bg-opacity-50">
        <div class="bg-white w-[65vw] xl:w-[40vw] max-w-[740px] p-8 pr-[55px] relative">
            <!-- Close button for the modal -->
            <button @click="open = false" class="absolute z-10 top-8 right-8 rounded-md text-gray-900 p-2 hover:text-primary-600 hover:bg-gray-100">
                <x-global.svg.x-mark class="size-7 m-auto" />
            </button>
            
            <!-- Livewire component that renders the mini-cart -->
            @livewire('minicart.mini-cart')
        </div>
    </div>
</div>
