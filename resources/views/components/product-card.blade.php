<div {{ $attributes->merge(['class' => 'bg-white border rounded-[10px] p-4 py-5 box-border hover:shadow transition flex flex-col max-w-[290px]']) }}>
    <a href="" class="w-full aspect-square bg-neutral-50 block rounded-md">
    <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-auto aspect-square object-contain rounded-md">
    </a>
    <a href="" class="block mt-2 flex-1 font-poppins font-medium">
        <h3 class="text-xl text-gray-900 first-letter:uppercase">{{ $product->name }}</h3>
            @isset($product->brand)
                <p class="text-xs text-gray-400 capitalize">{{ $product->brand }}</p>
            @endisset

        <div class="flex justify-start items-baseline mt-2 gap-3">
            <span class="text-gray-900 text-2xl">${{ $product->sale_price ?? $product->price }}</span>
            @isset($product->sale_price)
            <span class="text-neutral-400 text-base line-through">${{ $product->price }}</span>
            @endisset
        </div>

        <div class="flex justify-start items-start flex-wrap gap-x-3.5 gap-y-2 mt-4">
            @foreach($product->colors as $color)
                <div class="w-6 h-6 rounded-full border border-transparent hover:border-rose-700"
                    style="background-color: {{ $color }};"
                >
                </div>
            @endforeach
        </div>
    </a>
    <button class="btn btn-outlined btn-primary w-full mt-4 py-2 font-poppins rounded-[10px]">
        {{__('Comprar')}}
    </button>
</div>
