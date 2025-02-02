@php
    $sizes = array_keys($selectedVariant->quantity);
    $defaultSize = $sizes[0];
    $stockData = json_encode($selectedVariant->quantity);
@endphp

<main class="wrapper grid grid-cols-1 md:grid-cols-2 py-6 gap-[clamp(20px,3vw,45px)]">
    <!-- Product Images -->
    <x-modules.product.product-images :images="$selectedVariant->images" :product="$product" />
    
    <!-- Features -->
    <section class="max-md:wrapper max-w-[585px] flex flex-col gap-3">

        <!-- title -->
        <x-modules.product.product-title :product="$product" :selectedVariant="$selectedVariant" />

        <!-- other details -->
        <div class="flex flex-col gap-5" x-data="{ selectedSize: '{{ $defaultSize }}', stockMax: 0, stock: @entangle('stockData') }"
             x-effect="stockMax = stock[selectedSize];" >

            <!-- product price -->
            <x-modules.product.product-detail.price :selectedVariant="$selectedVariant" :product="$product" />
            <!-- product views -->
            <x-modules.product.product-detail.view-counter :selectedVariant="$selectedVariant" />
            <!-- product sale countdown -->
            <x-modules.product.product-detail.countdown :selectedVariant="$selectedVariant" />
            <!-- products left -->
            <x-modules.product.product-detail.progress-bar />
            <!-- product size -->
            <x-modules.product.product-detail.size-selector :sizes="$sizes" />
            <!-- product color -->
            <x-modules.product.product-detail.color-selector :selectedVariant="$selectedVariant" :product="$product" :stockData="$stockData" />
            <!-- product quantity -->
            <x-modules.product.product-detail.quantity-selector :selectedVariant="$selectedVariant" />

        </div>

        <!-- delivery and payment information-->
        <x-modules.product-delivery-payment-details />

    </section>
</main>
