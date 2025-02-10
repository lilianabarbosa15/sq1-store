@props(['selectedVariant'])

<div {{ $attributes->merge(['class' => 'grid md:gap-3']) }} 
     wire:key="quantity-selector-{{ $selectedVariant->id }}"
     x-data="{ quantity: 1 }" data-item-id="{{ $selectedVariant->id }}"
     @update-quantity-{{ $selectedVariant->id }}.window="quantity = $event.detail.value">

    <p class="font-volkhov font-normal">{{ __('Quantity') }}</p>

    <div class="flex gap-[3%] md:gap-[4%] h-[clamp(36px,6vw,45px)]">
        
        <x-global.buttons.stepper wire:key="stepper-{{ $selectedVariant->id }}" :value="1" :item-id="$selectedVariant->id" />

        <button class="btn btn-outlined btn-black p-0 w-[80%]"
                wire:click="addToCart(quantity, {{ $selectedVariant->id }}, selectedSize)">
            {{ __('Add to cart') }}
        </button>
    </div>      
</div>
