<x-guest-layout :navBackground="'bg-white'">
    <main class="wrapper grid grid-cols-1 md:grid-cols-2 py-6 gap-9">

        <!-- Product Images -->
        <section class="flex justify-evenly items-start 
                max-w-[600px] aspect-[3/3.45] col-span-1 justify-self-center md:justify-self-end">
            <div class="no-visibility-scrollbar flex flex-col gap-4 overflow-y-auto flex-nowrap h-full">       <!--other pictures of the product-->
                @foreach($product->images as $image)
                    <img class="border border-transparent w-[70px] h-auto p-1.5 hover:border-black hover:cursor-pointer"
                        src="{{ $image }}"
                        alt="{{ $product->name }}" > <!-- loading="lazy"???-->
                @endforeach
            </div>
            <img class="w-[80%] h-auto object-contain" src="{{ $product->images[0] }}" alt="{{ $product->name }}">
        </section>

        <!-- Product Details -->
        <section class="sm:wrapper max-w-[585px]">
            <div class="flex justify-between items-center">
                <div class="font-normal">
                    <p class="uppercase font-volkhov text-gray-600 text-sm">
                        {{ $product->brand }} </p>
                    <p class="capitalize font-volkhov text-black text-[clamp(24px,3vw,30px)]">
                        {{ $product->name }}</p>
                    <x-rating-mark :rating="$product->rating"/>
                </div>
                <x-star-button />
            </div>

            <div class="flex gap-2 items-center">
                <span class="font-volkhov font-normal text-2xl">
                    ${{ $product->sale_price }}
                </span>
                
                <span class="font-normal text-base line-through text-gray-600">
                    ${{ $product->price }}
                </span>

                @if ($product->sale_price !== null)
                    @php
                        $discount = $product->price - $product->sale_price;
                        $percentage = ($discount / $product->price) * 100;
                    @endphp
                    <div class="flex items-center justify-center font-medium text-[11px] text-white px-3 py-[2px] max-h-5 rounded-xl bg-primary-500">
                        SAVE {{ round($percentage) }}%
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <x-svg-views />
                <p class="text-[15px] xs:text-base text-gray-400 font-normal"> 
                    {{ $product->review_count }} people are viewing this right now
                </p>
            </div>

            <div class="flex justify-between py-3 px-1 sm:p-3 lg:pr-6 rounded bg-primary-50 border border-primary-100 text-primary-400">
                <p class="flex items-center font-volkhov 2md:text-[18px]">
                    Hurry up! Sale ends in:
                </p>
                <div class="flex items-center gap-[clamp(2px,0.8vw,12px)] 2md:text-[20px]">
                    <strong>00</strong> :
                    <strong>05</strong> :
                    <strong>59</strong> :
                    <strong>47</strong>
                </div>
            </div>

            <div class="">
                <p class="text-gray-600">
                    Only <strong> {{ $product->stock }} </strong> item(s) left in stock!
                </p>
                <div class="h-[5px] w-full bg-gray-150 rounded-full">
                    <div class="h-full bg-primary-550 rounded-full"
                        style="width: {{ $product->stock }}%;"></div>
                </div>
            </div>

            <div class="">
                <p class="font-volkhov font-bold">
                    Size: 
                    <span class="font-normal">M</span>
                </p>
                <div class="">
                    @foreach($product->sizes as $size)
                        <button class="btn btn-outlined btn-black p-0 aspect-square w-[clamp(30px,9vw,45px)]" >
                            {{ $size }}
                        </button>
                    @endforeach
                </div>  
            </div>
            
            <div class="">
                <p class="font-volkhov font-bold">
                    Color: 
                    <span class="font-normal">Blue</span>
                </p>
                <div class="flex flex-wrap gap-[2%] gap-y-1.5">
                    @foreach($product->colors as $color)
                        <div class="aspect-square w-[clamp(25px,5.5vw,40px)] md:w-[clamp(30px,3.5vw,40px)] 
                                    rounded-full border border-transparent hover:border-black hover:shadow-inset-white"
                            style="background-color: {{ $color }};">
                        </div>
                    @endforeach
                </div>
            </div>
        
            <div class="" x-data="{ quantity: 1, addToCart(value) { console.log('Added to cart:', value); } }" 
                @update-quantity.window="quantity = $event.detail.value">
                <p class="font-volkhov font-normal">
                    Quantity
                </p>
                <div class="flex gap-[3%] h-[clamp(36px,6vw,45px)]">
                    <x-stepper-button />
                    <button class="btn btn-outlined btn-black p-0 w-[80%]"
                            @click="addToCart(quantity)">
                        Add to cart
                    </button>
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>