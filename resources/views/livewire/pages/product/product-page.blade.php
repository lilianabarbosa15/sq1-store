@php
    $defaultImage = $selectedVariant->images[0];
@endphp

<main class="wrapper grid grid-cols-1 md:grid-cols-2 py-6 gap-[clamp(20px,3vw,45px)]">
    <!-- Product Images -->
    <section x-data="{ updateImage(image) { this.selectedImage = image; } }" 
             x-init="updateImage('{{ $defaultImage }}')"
             class="flex justify-evenly items-start max-w-[600px] md:w-[clamp(320px,45vw,600px)] aspect-[3/3.45] justify-self-center md:justify-self-end" >
        
        <div class="no-visibility-scrollbar flex flex-col gap-4 overflow-y-auto flex-nowrap h-full"
             x-data="{ updateMinImage(image) { this.selectedMinImage = image; } }" >
            @foreach($selectedVariant->images as $image)
                <img src="{{ $image }}"
                    alt="{{ $product->name }}"
                    x-on:click="updateImage('{{ $image }}'), updateMinImage('{{ $image }}')"
                    :class="selectedMinImage === '{{ $image }}' ? 'border border-black' : 'border border-transparent'"
                    class="w-[70px] h-auto p-1.5 hover:border-black hover:cursor-pointer " >
            @endforeach
        </div>
        
        <img :src="selectedImage" class="w-[80%] h-auto object-contain" alt="{{ $product->name }}">
    </section>
    
    <!-- Features -->
    <section class="max-md:wrapper max-w-[585px] flex flex-col gap-3">

        <!-- Name -->
        <div class="flex justify-between items-center">
            <div class="font-normal">
                <p class="uppercase font-volkhov text-gray-600 text-sm">
                    {{ $product->brand }} </p>
                <p class="capitalize font-volkhov text-black text-[clamp(22px,3vw,30px)]">
                    {{ $product->name }}</p>
                <x-modules.product.rating-mark :rating="$selectedVariant->rating"/>
            </div>
            <x-global.buttons.star />
        </div>

        <!-- Other Details -->
        <x-modules.product.product-details :selectedVariant="$selectedVariant" :product="$product" />

        <!-- Delivery and Payment Information-->
        <x-modules.product-delivery-payment-details />

    </section>
</main>
