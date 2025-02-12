<div class="grid grid-cols-4 gap-2 py-4" 
    @update-quantity-{{ $item->id }}.window="$wire.update()"
>   <!--wire:poll.500ms-->
    
    <!-- Image and quantity of the product selected -->
    <div class="relative z-0">
        <div class="z-1 size-4 md:size-6 bg-primary-600 rounded-full absolute right-[-8px] top-[-8px] md:right-[-12px] md:top-[-12px]
                    flex justify-center text-white text-xs md:text-base font-volkhov font-medium">
            {{ $item->quantity }}
        </div>
        <img src="{{ $variant->images[0] }}" alt="" 
             class="w-full top-0 z-[-1] aspect-square bg-[#E8E4E4] object-scale-down object-center col-start-1 col-end-2 row-start-1 row-end-2">
    </div>
    
    <!-- A little description of the item -->
    <div class="col-start-2 col-end-4 capitalize flex flex-col justify-center">
        <!-- Product name styled as a header -->
        <h2 class="text-primary-600 font-volkhov text-[18px]">{{ $product->name }}</h2>
        <!-- Display variant color -->
        <p class="text-gray-700 text-[16px]">{{ $variant->color_name }}</p>
    </div>

    <!-- Display variant unit price -->
    <p class="text-gray-700 grid justify-end items-center">${{ $item->unit_price * $item->quantity }}</p>

</div>
