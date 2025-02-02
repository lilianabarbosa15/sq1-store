@props(['selectedVariant', 'product', 'stockData'])

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