@php
    $sizes = array_keys($selectedVariant->quantity);
    $defaultSize = $sizes[0];
    $stockData = json_encode($selectedVariant->quantity);
@endphp

<div class="flex flex-col gap-5" x-data="{ selectedSize: '{{ $defaultSize }}', stockMax: 0, stock: @entangle('stockData') }"
     x-effect="stockMax = stock[selectedSize];" >

    <!-- product price -->
    <div class="flex gap-2 items-center">
        <span class="font-volkhov font-normal text-2xl">
            ${{ $selectedVariant->sale_price ?? $product->price }}
        </span>
        @if (isset($selectedVariant->sale_price))
            <span class="font-normal text-base line-through text-gray-600">
                ${{ $product->price }}
            </span>
            @php
                $discount = $product->price - $selectedVariant->sale_price;
                $percentage = ($discount / $product->price) * 100;
            @endphp
            <div class="flex items-center justify-center font-medium text-[11px] text-white px-3 py-[2px] max-h-5 rounded-xl bg-primary-500">
                {{__('SAVE')}} {{ round($percentage) }}%
            </div>
        @endif
    </div>
    
    <!-- product currently viewed -->
    <div class="flex items-center gap-1 xs:gap-3">
        <x-global.svg.views />
        <p class="text-[14px] xs:text-base text-gray-400 font-normal"> 
            {{ $selectedVariant->review_count }} {{ __('people are viewing this right now') }}
        </p>
    </div>

    <!-- product sale countdown -->
    @if (isset($selectedVariant->sale_price))
        <div class="flex justify-between py-3 px-1 sm:p-3 lg:pr-6 rounded bg-primary-100 border border-primary-200 text-primary-400">
            <p class="flex items-center font-volkhov text-[15px] 2md:text-[18px]">
                {{ __('Hurry up! Sale ends in:') }}
            </p>
            <div class="flex items-center gap-[clamp(2px,0.8vw,12px)] 2md:text-[20px]"
                x-data="{ endDate: null, days: 0, hours: 0, minutes: 0, seconds: 0 }"
                x-init="
                endDate = new Date('{{ $selectedVariant->sale_end_time }}'.replace('T', ' ').replace('Z', ''));
                () => {
                    const diff = endDate.getTime() - new Date().getTime();
                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    hours = Math.floor(diff / (1000 * 60 * 60)) - (days * 24);
                    minutes = Math.floor(diff / (1000 * 60)) - (days * 24 * 60) - (hours * 60);
                    seconds = Math.floor(diff / 1000) - (days * 24 * 60 * 60) - (hours * 60 * 60) - (minutes * 60);
                };
                setInterval(() => {
                    const diff = endDate.getTime() - new Date().getTime();
                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    hours = Math.floor(diff / (1000 * 60 * 60)) - (days * 24);
                    minutes = Math.floor(diff / (1000 * 60)) - (days * 24 * 60) - (hours * 60);
                    seconds = Math.floor(diff / 1000) - (days * 24 * 60 * 60) - (hours * 60 * 60) - (minutes * 60);
                }, 1000)"
                class="flex flex-row justify-end items-center gap-2 text-red-400">
                <span class="font-semibold tabular-nums" x-text="days.toString().padStart(2, '0')">00</span>        <!--days-->
                <span>:</span>
                <span class="font-semibold tabular-nums" x-text="hours.toString().padStart(2, '0')">00</span>       <!--hours-->
                <span>:</span>
                <span class="font-semibold tabular-nums" x-text="minutes.toString().padStart(2, '0')">00</span>     <!--minutes-->
                <span>:</span>
                <span class="font-semibold tabular-nums" x-text="seconds.toString().padStart(2, '0')">00</span>     <!--seconds-->
            </div>
        </div>
    @endif


    <!-- progress bar -->
    <div class="flex flex-col md:gap-2" >
        <p class="text-gray-600">
            {{ __('Only') }} <strong x-text="stockMax"></strong> {{ __('item(s) left in stock!') }}
        </p>
        <div class="h-[5px] w-full bg-gray-150 rounded-full">
            <div x-bind:style="`width: ${(stockMax / 100) * 100}%`"
                class="h-full bg-primary-550 rounded-full transition-all duration-300"></div>
        </div>
    </div>

    <!-- size buttons -->
    <div class="grid md:gap-3">
        <p class="font-volkhov font-bold">
            {{ __('Size') }}: <span class="font-normal uppercase" x-text="selectedSize"></span>
        </p>
        <div class="flex gap-2" >
            @foreach($sizes as $size)
                <button x-on:click="selectedSize = '{{ $size }}';" 
                        :class="selectedSize === '{{ $size }}' ? 'btn btn-filled btn-black' : 'btn btn-outlined btn-black'"
                        class="btn btn-outlined p-0 aspect-square w-[clamp(30px,9vw,45px)] uppercase"
                >
                    {{ $size }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- color buttons -->
    <div class="grid md:gap-3" x-data="{ selectedColor: '{{ $selectedVariant->color }}' }"  x-init="stock = {{ $stockData }};"  >
        <p class="font-volkhov font-bold">
            {{ __('Color') }}: <span class="font-normal capitalize">{{ $selectedVariant->color_name }}</span> <!--{{ $selectedVariant->color }}-->
        </p>
        <div class="flex flex-wrap gap-[2%] gap-y-1.5">
            @foreach($product->product_variants as $variant)
                <div wire:click="selectVariant('{{$variant->id}}')"
                :click="selectedColor = '{{ $variant->color }}'"
                style="background-color: {{ $variant->color }};"
                    @class([ 
                        'border hover:border-black hover:shadow-inset-white aspect-square w-[clamp(25px,5.5vw,40px)] md:w-[clamp(30px,3.5vw,40px)] rounded-full',
                        'border-black shadow-inset-white' =>  $selectedVariant->id === $variant->id,
                    ])
                >
                </div>
            @endforeach
        </div>
    </div>

    <!-- quantity buttons -->
    <div class="grid md:gap-3" x-data="{ quantity: 1 }" 
        @update-quantity.window="quantity = $event.detail.value">
        <p class="font-volkhov font-normal">
            {{ __('Quantity') }}
        </p>
        <div class="flex gap-[3%] md:gap-[4%] h-[clamp(36px,6vw,45px)]">
            <x-global.buttons.stepper />                                        <!--<p>quantity: <span x-text="quantity"></span> </p>-->
            <button class="btn btn-outlined btn-black p-0 w-[80%]"
                    wire:click="addToCart(quantity,{{$selectedVariant->id}},selectedSize)">
                {{ __('Add to cart') }}
            </button>
        </div>      
    </div>
    
</div>


