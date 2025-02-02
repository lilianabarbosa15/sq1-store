<div class = 'bg-white border rounded-[10px] p-4 py-5 box-border hover:shadow transition flex flex-col max-w-[286px] sm:max-w-[340px] lg:max-w-[290px]' >
    <!-- Product Image -->  <!--  $product->product_variants[0]->images[0]  -->
    <div class="w-full aspect-square bg-neutral-50 block rounded-md overflow-hidden">
        <img src="{{ $selectedVariant->images[0] }}" alt="{{ $product->name }}" class="w-full h-auto aspect-square object-contain rounded-md" loading="lazy" >
    </div>

    <!-- Product Details -->
    <div class="block mt-2 flex-1 font-medium">
        <h3 class="text-gray-900 text-lg sm:text-xl first-letter:uppercase">
            {{ $product->name }}
        </h3>
        @isset($product->brand)
            <p class="text-gray-400 text-[10px] sm:text-xs capitalize">
                {{ $product->brand }}
            </p>
        @endisset

        <!-- Product Price -->
        <div class="flex items-baseline mt-2 gap-3">
            <span class="text-gray-900 text-xl sm:text-2xl">
                ${{ $selectedVariant->sale_price ?? $product->price }}
            </span>
            @isset($selectedVariant->sale_price)
                <span class="text-neutral-400 text-sm sm:text-base line-through">
                    ${{ $product->price }}
                </span>
            @endisset
        </div>

        <!-- Product Colors -->
        <div class="flex flex-wrap gap-x-3.5 gap-y-2 mt-2 sm:mt-4">
            @foreach($product->product_variants as $variant)
                <div 
                     wire:click="selectVariant('{{$variant->id}}')"
                     style="background-color: {{ $variant->color }};"
                     @class([
                        'w-6 h-6 rounded-full border hover:border-rose-700',
                        'border-rose-700' => $selectedVariant->id === $variant->id,
                        'border-transparent' =>  $selectedVariant->id !== $variant->id,
                ]) >
                     </div>
            @endforeach
        </div>
    </div>

    <!-- Buy Button -->
    <form action="{{ route('show', ['id' => $selectedVariant->product_id]) }}" method="GET">
        <button class="btn btn-outlined btn-primary w-full mt-4 py-2 rounded-[10px]"
                type="submit">
            {{ __('Comprar') }}
        </button>
    </form>

</div>
