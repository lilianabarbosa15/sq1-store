<div {{ $attributes->merge(['class' => 'bg-white border rounded-[10px] p-4 py-5 box-border hover:shadow transition flex flex-col max-w-[286px] sm:max-w-[340px] lg:max-w-[290px]']) }}>
    <!-- Product Image -->
    <a href="" class="w-full aspect-square bg-neutral-50 block rounded-md overflow-hidden">
        <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-auto aspect-square object-contain rounded-md" loading="lazy" >
    </a>

    <!-- Product Details -->
    <a href="" class="block mt-2 flex-1 font-medium">
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
                ${{ $product->sale_price ?? $product->price }}
            </span>
            @isset($product->sale_price)
                <span class="text-neutral-400 text-sm sm:text-base line-through">
                    ${{ $product->price }}
                </span>
            @endisset
        </div>

        <!-- Product Colors -->
        @if($product->colors)
            <div class="flex flex-wrap gap-x-3.5 gap-y-2 mt-2 sm:mt-4">
                @foreach($product->colors as $color)
                    <div class="w-6 h-6 rounded-full border border-transparent hover:border-rose-700" 
                         style="background-color: {{ $color }};">
                    </div>
                @endforeach
            </div>
        @endif
    </a>

    <!-- Buy Button -->
    <form action="{{ route('show', ['id' => $product->id]) }}" method="GET">
        <button class="btn btn-outlined btn-primary w-full mt-4 py-2 rounded-[10px]"
                type="submit">
            {{ __('Comprar') }}
        </button>
    </form>

</div>
