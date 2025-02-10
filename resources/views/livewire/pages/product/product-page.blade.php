<main class="wrapper grid grid-cols-1 md:grid-cols-2 py-6 gap-[clamp(20px,3vw,45px)]">
    <!-- Product Images -->
    <x-modules.product.product-images :images="$selectedVariant->images" :product="$product" />
    
    <!-- Features -->
    <section class="max-md:wrapper max-w-[585px] flex flex-col gap-3">

        <!-- Title -->
        <x-modules.product.product-title :product="$product" :selectedVariant="$selectedVariant" />

        <!-- Other Details -->
        <div class="flex flex-col gap-5" 
            x-data="{
                selectedSize: '{{ $defaultSize }}',
                stock: @entangle('stockData'),
                get stockMax() {
                    return this.stock[this.selectedSize] || 0;
                }
            }" 
        >
            <!-- Product Price -->
            <x-modules.product.product-detail.price :selectedVariant="$selectedVariant" :product="$product" />
            <!-- Product Views -->
            <x-modules.product.product-detail.view-counter :selectedVariant="$selectedVariant" />
            <!-- Product Sale Countdown -->
            <x-modules.product.product-detail.countdown :selectedVariant="$selectedVariant" />
            <!-- Products Left / Progress Bar -->
            <x-modules.product.product-detail.progress-bar />
            <!-- Product Size Selector -->
            <x-modules.product.product-detail.size-selector :sizes="$sizes" />
            <!-- Product Color Selector -->
            <x-modules.product.product-detail.color-selector :selectedVariant="$selectedVariant" :product="$product" :stockData="$stockData" />
            <!-- Product Quantity Selector -->
            <x-modules.product.product-detail.quantity-selector :selectedVariant="$selectedVariant" />
        </div>

        <!-- Delivery and Payment Information -->
        <x-modules.product.product-delivery-payment-details />
    </section>
</main>
