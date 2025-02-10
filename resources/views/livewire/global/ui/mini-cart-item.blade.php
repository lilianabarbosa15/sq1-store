<div class="grid grid-cols-4 gap-2 py-4 border-b border-black/40" 
    x-data="{  
        selectedSize: '{{ strtolower($item->size) }}', 
        stockMax: 0, 
        stock: {{ $variant->quantity }}
    }"
    x-effect="stockMax = stock[selectedSize];"
    @update-quantity-{{ $item->id }}.window="value = $event.detail.value; $wire.updateQuantity($event.detail.value)"
>
    <img src="{{ $variant->images[0] }}" alt="" class="col-start-1 col-end-2 h-auto">

    <!-- Container for product details in columns 2 to 4 -->
    <div class="col-start-2 col-end-4 text-[clamp(18px,1.8vw,22px)] capitalize">
        <!-- Product name styled as a header -->
        <h2 class="font-volkhov font-medium">{{ $product->name }}</h2> 
        <!-- Display variant color and size, and the unit price -->
        <p class="text-gray-400">Color: {{ $variant->color_name }}</p>
        <p class="text-gray-400">Size: {{ $item->size }}</p>
        <p>${{ $item->unit_price }}</p>
        
        
        <div class="flex gap-4 my-2" x-data="{ isEditing: false, stepValue: {{ $item->quantity }} }"
            @update-quantity-{{ $item->id }}.window="isEditing = false; stepValue = $event.detail.value"
        >
            <!--  -->
            <x-global.buttons.stepper 
                class="w-[clamp(120px,15vw,160px)] bg-gray-100 border-gray-100 text-[clamp(18px,1.8vw,22px)] font-semibold" 
                x-bind:x-init="value = stepValue" 
                :item-id="$item->id" 
                @click="isEditing = true" 
            />
            <!--  -->
            <x-global.buttons.delete wire:click.prevent="removeItem()" />
        </div>
    </div>

</div>
