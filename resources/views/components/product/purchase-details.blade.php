<!-- size buttons -->
<div class="grid md:gap-3" x-data="{ selectedSize: '{{ $product->sizes[0] }}' }">
    <p class="font-volkhov font-bold">
        {{ __('Size') }}: <span class="font-normal" x-text="selectedSize"></span>
    </p>
    <div class="flex gap-2">
        @foreach($product->sizes as $size)
            <button @click="selectedSize = '{{ $size }}'"
                    :class="{ 'btn btn-filled btn-black': selectedSize === '{{ $size }}', 'btn btn-outlined btn-black': selectedSize !== '{{ $size }}' }"
                    @class([ 
                            'btn btn-outlined btn-black p-0 aspect-square w-[clamp(30px,9vw,45px)]',
                            'btn btn-filled btn-black' => $product->sizes[0] === $size,
                    ])
                >
                {{ $size }}
            </button>
        @endforeach
    </div>  
</div>

<!-- color buttons -->
<div class="grid md:gap-3" 
     x-data="{ selectedColor: '{{ $product->colors[0] }}', colorName: '', colorNames: @js($colorNames) }" 
     x-init="colorName = colorNames[selectedColor] || ' '">
    <p class="font-volkhov font-bold">
        {{ __('Color') }}: <span class="font-normal capitalize" x-text="colorName"></span>
    </p>
    <div class="flex flex-wrap gap-[2%] gap-y-1.5">
        @foreach($product->colors as $color)
            <div :class="{ 
                    'border aspect-square w-[clamp(25px,5.5vw,40px)] md:w-[clamp(30px,3.5vw,40px)] rounded-full border-black shadow-inset-white': selectedColor === '{{ $color }}',
                    'border aspect-square w-[clamp(25px,5.5vw,40px)] md:w-[clamp(30px,3.5vw,40px)] rounded-full': selectedColor !== '{{ $color }}' 
                }"
                @click="
                    selectedColor = '{{ $color }}';
                    colorName = colorNames[selectedColor] || ' ';
                "
                style="background-color: {{ $color }};"
                @class([ 
                    'border hover:border-black hover:shadow-inset-white',
                    'aspect-square w-[clamp(25px,5.5vw,40px)] md:w-[clamp(30px,3.5vw,40px)] rounded-full',
                    'border-black shadow-inset-white' => $product->colors[0] === $color,
                ])
            >
            </div>
        @endforeach
    </div>
</div>

<!-- quantity buttons -->
<div class="grid md:gap-3" x-data="{ quantity: 1, addToCart(value) { console.log('Added to cart:', value); } }" 
     @update-quantity.window="quantity = $event.detail.value">
    <p class="font-volkhov font-normal">
        {{ __('Quantity') }}
    </p>
    <div class="flex gap-[3%] md:gap-[4%] h-[clamp(36px,6vw,45px)]">
        <x-stepper-button />
        <button class="btn btn-outlined btn-black p-0 w-[80%]"
                @click="addToCart(quantity)">
            {{ __('Add to cart') }}
        </button>
    </div>      
</div>
