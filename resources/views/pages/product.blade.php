<x-guest-layout :navBackground="'bg-white'">
    <main class="wrapper grid grid-cols-1 md:grid-cols-2 py-6 gap-9">
        <!-- Product Images -->
        <section class="flex justify-evenly items-start 
                max-w-[600px] aspect-[3/3.45] col-span-1 justify-self-end">
            <div class="no-visibility-scrollbar flex flex-col justify-between gap-4 overflow-y-auto flex-nowrap h-full">       <!--other pictures of the product-->
                @foreach($product->images as $image)
                    <img class="border border-transparent w-[70px] h-auto p-1.5 hover:border-black hover:cursor-pointer"
                        src="{{ $image }}"
                        alt="{{ $product->name }}" > <!-- loading="lazy"???-->
                @endforeach
            </div>
            <img class="w-4/5 h-auto object-contain" src="{{ $product->images[0] }}" alt="{{ $product->name }}">
        </section>

        <!-- Product Details -->
        <section class="max-w-[585px]">
            <div class="flex justify-between">
                <div>
                    <p class="uppercase">
                        {{ $product->brand }} </p>
                    <p class="capitalize">
                    {{ $product->name }} </p>
                    <x-rating-mark :rating="$product->rating"/>
                </div>
                <x-star-button />
            </div>

            <div>
                <span class="">
                    {{ $product->price }}
                </span>
                
                <span class="">
                    {{ $product->sale_price }}
                </span>

                @if ($product->sale_price !== null)
                    @php
                        $discount = $product->price - $product->sale_price;
                        $percentage = ($discount / $product->price) * 100;
                    @endphp
                    <button class="">
                        SAVE {{ round($percentage) }}%
                    </button>
                @endif
            </div>

            <div class="flex">
                <x-svg-views />
                <p> {{ $product->review_count }} people are viewing this right now </p>
            </div>

            <div class="flex">
                <p>Hurry up! Sale ends in:</p>
                <div class="flex">
                    <!--<p><strong>00</strong></p>:<p><strong>05</strong></p>:<p><strong>59</strong></p>:<p><strong>47</strong></p>-->
                </div>
            </div>

            <div class="">
                <p>Only <strong> {{ $product->stock }} </strong> item(s) left in stock!</p>
                <div class="" width="585px" height="5px">
                    <div class=""> </div>
                </div>
            </div>

            <div class="">
                <!--<p>Size: M</p>
                <div class="">
                    <button class="">S</button>
                    <button class="">M</button>
                    <button class="">L</button>
                    <button class="">XL</button>
                </div>-->  
            </div>
            
            <div class="">
                <!--<p>Color: </p>
                <div class="flex">
                    @foreach($product->colors as $color)
                        <div class="w-6 h-6 rounded-full border border-transparent hover:border-rose-700" 
                            style="background-color: {{ $color }};">
                        </div>
                    @endforeach
                </div>-->
            </div>

            <div class="">
                <p>Quantity</p>
                <div class="">
                    <div class="">
                        <button class=""> - </button>
                        <button class=""> 1 </button>
                        <button class=""> + </button>
                    </div>
                    <button class="">Add to cart</button>
                </div>
            </div>

        </section>
    </main>
</x-guest-layout>