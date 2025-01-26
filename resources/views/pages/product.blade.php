<x-guest-layout :navBackground="'bg-white'">
    <main class="wrapper grid grid-cols-1 md:grid-cols-2 py-6 gap-[clamp(20px,3vw,45px)]">

        <!-- Product Images -->
        <section class="flex justify-evenly items-start 
                        max-w-[600px] md:w-[clamp(320px,45vw,600px)] aspect-[3/3.45] justify-self-center md:justify-self-end"
                 x-data="{ selectedImage: '{{ $product->images[0] }}' }">
            
            <!-- Thumbnail Images -->
            <div class="no-visibility-scrollbar flex flex-col gap-4 overflow-y-auto flex-nowrap h-full">
                @foreach($product->images as $image)
                    <img 
                        src="{{ $image }}"
                        alt="{{ $product->name }}"
                        :class="{ 'border-black': selectedImage === '{{ $image }}', 'border-transparent': selectedImage !== '{{ $image }}' }"
                        @click="selectedImage = '{{ $image }}'"
                        @class([ 
                            'border w-[70px] h-auto p-1.5 hover:border-black hover:cursor-pointer',
                            'border-black' => $product->images[0] === $image,
                            'border border-transparent' => $product->images[0] !== $image,
                        ])
                         
                    />
                @endforeach
            </div>

            <!-- Selected Image -->
            <img :src="selectedImage" class="w-[80%] h-auto object-contain" alt="{{ $product->name }}">
        </section>

        <!-- Product Details -->
        <section class="max-md:wrapper max-w-[585px] flex flex-col gap-5">
            <!-- Product Title -->
            <div class="flex justify-between items-center">
                <div class="font-normal">
                    <p class="uppercase font-volkhov text-gray-600 text-sm">
                        {{ $product->brand }} </p>
                    <p class="capitalize font-volkhov text-black text-[clamp(24px,3vw,30px)]">
                        {{ $product->name }}</p>
                    <x-modules.product.rating-mark :rating="$product->rating"/>
                </div>
                <x-global.buttons.star />
            </div>

            <!-- Product Price -->
            <x-modules.product.prices-information :product="$product" />

            <!-- Product Currently Viewed -->
            <div class="flex items-center gap-1 xs:gap-3">
                <x-global.svg.views />
                <p class="text-[14px] xs:text-base text-gray-400 font-normal"> 
                    {{ $product->review_count }} {{ __('people are viewing this right now') }}
                </p>
            </div>

            <!-- Product Sale Countdown -->
            <x-modules.product.countdown-sale :product="$product" />

            <!-- Product Availability in Stock -->
            <div class="flex flex-col md:gap-2">
                <p class="text-gray-600">
                    {{ __('Only') }} <strong> {{ $product->stock }} </strong> {{ __('item(s) left in stock!') }}
                </p>
                <x-global.ui.progress-bar :progress="$product->stock" />
            </div>

            <!-- Product Purchase Details -->
            <x-modules.product.purchase-details :product="$product" :colorNames="$colorNames" />
            
        </section>
    </main>
</x-guest-layout>