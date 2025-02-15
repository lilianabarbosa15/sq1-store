<form action="{{ route('show', ['id' =>  $selectedVariant['product_id'] ] ) }}" method="GET" class="flex justify-center">
    <div class = 'bg-white px-2 pb-3 box-border flex flex-col mb-2 sm:mb-3 max-w-[150px] sm:max-w-[270px] max-h-[420px] border border-transparent hover:border-black' >
        <!-- Product Image -->
        @php
            // Decode the JSON string into an associative array.
            $quantities = json_decode($selectedVariant['quantity'], true);
            // Assume the product is sold out unless we find a positive quantity.
            $soldOut = true;
            // Loop through each size quantity.
            foreach ($quantities as $size => $qty) {
                if ($qty > 0) {
                    $soldOut = false;
                    break;
                }
            }
        @endphp
        <button class="w-full aspect-[3/4] bg-neutral-50 block overflow-hidden relative hover:cursor-pointer" type="submit">
            <img src="{{ $selectedVariant['images'][0] }}" alt="{{ $product['name'] }}" class="w-full h-auto aspect-[3/4] object-contain">
            @if($soldOut)
                <!-- If sold out, show the overlay $soldOut-->
                <div class="absolute inset-0 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 size-[54px] rounded-full bg-[#B1B1B1]
                    flex items-center justify-center text-center p-4 z-2 text-[10px] text-white font-black">
                    {{ __('SOLD OUT') }}
                </div>
            @endif
        </button>

        <!-- Product Details -->
        <div class="block mt-2 flex-1 font-medium">
            <!-- Product Name -->
            <h3 class="font-volkhov text-[12px] first-letter:uppercase">
                {{ $product['name'] }}
            </h3>

            <!-- Product Price -->
            <div class="flex items-baseline text-base mt-2 gap-3 font-jost">
                <span class="">
                    ${{ $selectedVariant['sale_price'] ?? $product['price'] }}
                </span>
                @isset( $selectedVariant['sale_price'] )
                    <span class="text-gray-600 line-through">
                        ${{ $product['price'] }}
                    </span>
                @endisset
            </div>

            <!-- Product Colors -->
            <div class="flex flex-wrap gap-x-3.5 gap-y-2 mt-2 sm:mt-4">
                @foreach($variants as $variant)
                    <div wire:click="selectVariant('{{ $variant['id'] }}')"
                        style="background-color: {{ $variant['color'] }};"
                        @class([
                            'size-[26px] rounded-full border hover:border-black hover:cursor-pointer hover:shadow-inset-white',
                            'border-black shadow-inset-white' => $selectedVariant['id'] == $variant['id'],
                            'border-transparent' => $selectedVariant['id'] != $variant['id'],
                    ]) >
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</form>