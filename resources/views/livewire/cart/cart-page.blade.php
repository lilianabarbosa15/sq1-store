<main class="wrapper grid grid-cols-2 py-8 gap-y-2 md:gap-y-10"
      x-data="{ subtotal: @entangle('subtotal') }">
    <!-- 
         Header Section:
         - Spans across both grid columns.
         - Contains the page title and a breadcrumb navigation.
    -->
    <header class="col-start-1 col-end-3 grid justify-center text-center">
        <!-- Main title for the cart page -->
        <h1 class="font-volkhov text-[clamp(30px,6.5vw,42px)]">{{ __('Shopping Cart') }}</h1>
        <!-- Breadcrumb navigation showing "Home" and "Your Shopping Cart" -->
        <div class="flex items-center gap-3 justify-self-center">
            <p>{{ __('Home') }}</p>
            <x-global.svg.caret-right-mark />
            <p>{{ __('Your Shopping Cart') }}</p>
        </div>
    </header>
            
    <!-- 
         Cart Items Section:
         - Spans across both grid columns.
         - Displays a header row for the cart items list.
         - Uses a responsive grid that shows different columns on medium (md) screens.
    -->
    <section class="col-start-1 col-end-3">
        <!-- Header row for the items table -->
        <div class="grid md:grid-cols-7 font-volkhov text-[clamp(18px,1.8vw,22px)] border-b border-black/40 py-5">
            <h2 class="col-start-1 col-end-2">{{ __('Product') }}</h2>
            <h2 class="col-start-3 col-end-4 justify-self-center hidden md:block">{{ __('Price') }}</h2>
            <h2 class="col-start-5 col-end-6 hidden md:block">{{ __('Quantity') }}</h2>
            <h2 class="col-start-7 col-end-8 justify-self-end">{{ __('Total') }}</h2>
        </div>

        <!-- Check if there are any cart items -->
        @if($cartItems->isEmpty())
            <p>Empty.</p>
        @else
            @foreach ($cartItems as $item)
                <!-- Use a unique Livewire key for each item to ensure proper reactivity -->
                <div wire:key="item-{{ $item->id }}">
                    @livewire('global.ui.item-cart', ['item' => $item], key($item->id))
                </div>
            @endforeach
        @endif
    </section>
    
    <!-- 
         Footer Section:
         - This component displays the subtotal, shipping information, and checkout button.
         - The wrapperClass prop is used to control its layout in the grid.
    -->
    <x-modules.cart.footer 
        :subtotal="$subtotal" 
        :shippingPrice="$shippingPrice" 
        wrapperClass="col-start-1 md:col-start-2 col-end-3"
    />
</main>
