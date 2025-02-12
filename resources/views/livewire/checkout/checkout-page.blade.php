<main class="wrapper flex flex-col md:grid md:grid-cols-2 md:gap-x-[clamp(12px,3.5vw,48px)]">
    <h1 class="col-start-1 md:col-end-3 text-center font-volkhov font-normal text-[clamp(35px,3.4vw,42px)] p-5">{{ __('Checkout') }}</h1>
    <article class="md:col-start-2 md:col-end-3 row-start-2 md:min-h-[617px] md:h-[50vh] bg-gray-25 p-6">
        <section class="no-visibility-scrollbar flex flex-col grow overflow-y-auto flex-nowrap md:min-h-[250px] md:max-h-[80%]">
            @if($cartItems->isEmpty())
                <p>Empty.</p>
            @else
                @foreach ($cartItems->filter(fn($item) => $item->exists) as $item)
                    <div wire:key="item-{{ $item->id }}">
                        @livewire('global.ui.checkout-cart-item', ['item' => $item], key($item->id))
                    </div>
                @endforeach
            @endif
        </section>
        <section class="text-gray-700">
            <div class="flex justify-between"> 
                <p>Subtotal</p> <p>${{ $subtotal }}</p>
            </div>
            <div class="flex justify-between"> 
                <p>Shipping</p> <p>{{ $shippingPrice }}</p>
            </div>
            <div class="flex justify-between">
                <p>Total</p> <p class="text-primary-600">${{ $total }}</p>
            </div>
        </section>
    </article>

    <article class="md:col-start-1 md:col-end-2 row-start-2 grid gap-6 my-12">
        @include('components.modules.checkout.order-detail.contact-section')
        @include('components.modules.checkout.order-detail.delivery-section')
        @include('components.modules.checkout.order-detail.payment-section')
        @include('components.modules.checkout.order-detail.footer')
    </article>

</main>
