<div class="flex gap-2 items-center">
    <span class="font-volkhov font-normal text-2xl">
        ${{ $product->sale_price ?? $product->price }}
    </span>

    @if (isset($product->sale_price))
        <span class="font-normal text-base line-through text-gray-600">
            ${{ $product->price }}
        </span>
        
        @php
            $discount = $product->price - $product->sale_price;
            $percentage = ($discount / $product->price) * 100;
        @endphp
        <div class="flex items-center justify-center font-medium text-[11px] text-white px-3 py-[2px] max-h-5 rounded-xl bg-primary-500">
            SAVE {{ round($percentage) }}%
        </div>
    @endif
</div>
