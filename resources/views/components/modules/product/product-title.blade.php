@props(['product', 'selectedVariant'])

<div class="flex justify-between items-center">
    <div class="font-normal">
        <p class="uppercase font-volkhov text-gray-600 text-sm">
            {{ $product->brand }}
        </p>
        <p class="capitalize font-volkhov text-black text-[clamp(22px,3vw,30px)]">
            {{ $product->name }}
        </p>
        <x-modules.product.rating-mark :rating="$selectedVariant->rating"/>
    </div>
    <x-global.buttons.star />
</div>