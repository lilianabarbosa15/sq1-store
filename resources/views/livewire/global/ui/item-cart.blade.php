<div class="grid grid-cols-7 gap-2 py-4 border-b border-black/40" 
     x-data="{  
         selectedSize: '{{ strtolower($item->size) }}', 
         stockMax: 0,
         stock: {{ $variant->quantity }}
     }"
     x-effect="stockMax = stock[selectedSize];"
     @update-quantity-{{ $item->id }}.window="value = $event.detail.value; $wire.updateQuantity($event.detail.value)"
>
    <!-- Column 1 to 3 (on small screens) for the product image (and unit price for mobile) -->
    <div class="col-start-1 col-end-3 md:col-end-2">
        <img src="{{ $variant->images[0] }}" alt="" class="h-auto">
        <p class="md:hidden justify-self-center font-volkhov text-[clamp(18px,1.8vw,22px)]">
            ${{ $item->unit_price }}
        </p>
    </div>
    
    <!-- Container for product details -->
    <div class="col-start-3 col-end-5 md:col-start-2 md:col-end-3 text-[clamp(15px,1.8vw,22px)] capitalize">
        <h2 class="font-volkhov font-medium">{{ $product->name }}</h2>
        <p class="text-gray-400">Color: {{ $variant->color_name }}</p>
        <p class="text-gray-400">Size: {{ $item->size }}</p>
        <!-- Button to remove this cart item. Calls the removeItem method on click. -->
        <button class="underline" wire:click.prevent="removeItem()">Remove</button>
    </div>

    <!-- On medium screens, show the unit price in a separate column (columns 3 to 4) -->
    <p class="hidden md:block col-start-3 col-end-4 justify-self-center font-volkhov text-[clamp(18px,1.8vw,22px)]">
        ${{ $item->unit_price }}
    </p>

    <!-- Container for the quantity stepper -->
    <div class="justify-self-end md:justify-self-start col-start-6 col-end-8 md:col-start-5 md:col-end-6 flex gap-4 my-2"
         x-data="{ 
             isEditing: false, 
             stepValue: {{ $item->quantity }}
         }"
         @update-quantity-{{ $item->id }}.window="isEditing = false; stepValue = $event.detail.value"
    >
        <!-- Stepper button component:
             - Uses a width defined by clamp() for responsiveness.
             - Initializes its internal value with stepValue.
             - When clicked, sets isEditing to true.
        -->
        <x-global.buttons.stepper 
            class="w-[clamp(70px,22vw,120px)] bg-white border-gray-400 text-[clamp(16px,5vw,25px)] font-semibold" 
            x-bind:x-init="value = stepValue" 
            :item-id="$item->id" 
            @click="isEditing = true" 
        />
    </div>

    <!-- Display the subtotal for this individual cart item:
         - On small screens, it's shown in column 6 to 8; on medium screens, in column 7 to 8.
         - Uses a background color on small screens (bg-primary-200) and transparent on md.
    -->
    <p class="col-start-6 md:col-start-7 col-end-8 bg-primary-200 md:bg-transparent justify-self-end font-volkhov text-[clamp(18px,1.8vw,22px)]">
        ${{ $subtotal_item }}
    </p>
</div>
