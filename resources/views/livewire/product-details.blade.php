<div class="flex flex-col gap-5">
    <!-- Product Price -->
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
                {{__('SAVE')}} {{ round($percentage) }}%
            </div>
        @endif
    </div>


    <!-- Product Currently Viewed -->
    <div class="flex items-center gap-1 xs:gap-3">
        <x-global.svg.views />
        <p class="text-[14px] xs:text-base text-gray-400 font-normal"> 
            {{ $product->review_count }} {{ __('people are viewing this right now') }}
        </p>
    </div>

    <!-- Product Sale Countdown -->
    @if (isset($product->sale_price))
        <div class="flex justify-between py-3 px-1 sm:p-3 lg:pr-6 rounded bg-primary-100 border border-primary-200 text-primary-400">
            <p class="flex items-center font-volkhov text-[15px] 2md:text-[18px]">
                {{ __('Hurry up! Sale ends in:') }}
            </p>
            <div class="flex items-center gap-[clamp(2px,0.8vw,12px)] 2md:text-[20px]">
                <strong>00</strong> :
                <strong>05</strong> :
                <strong>59</strong> :
                <strong>47</strong>
            </div>
        </div>
    @endif

    <!-- Product Availability in Stock -->
    <div class="flex flex-col md:gap-2">
        <p class="text-gray-600">
            {{ __('Only') }} <strong>{{ $product->stock }}</strong> {{ __('item(s) left in stock!') }}
        </p>
        <x-global.ui.progress-bar :progress="$product->stock" />
    </div>

    <!-- Product Purchase Details -->
    <x-modules.product.purchase-details :product="$product" :colorNames="$colorNames" />
</div>
