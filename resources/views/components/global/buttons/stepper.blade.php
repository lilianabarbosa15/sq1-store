@props(['value' => 1, 'itemId'])

<div {{ $attributes->merge(['class' => 'btn-stepper']) }}
     x-data="{
         value: {{ $value }},
         min: 1,
         timeout: null,
         
         updateValue() { $dispatch('update-quantity-{{ $itemId }}', { value: this.value }); }
     }"
     x-init="$watch('value', value => updateValue())" 
     x-effect="if (value > stockMax) { value = stockMax; } if (value < min) { value = min; }">
    
    <!-- increment button -->
    <button class="btn-stepper-btn btn hover:border-primary-600 hover:!bg-primary-600/5 hover:!text-primary-600 font-bold"
        :disabled="value === min"
        @click=" if (value > min) { value--; } ">
        -
    </button>
    
    <!-- value display-->
    <div class="text-center">
        <span x-text="value"></span>
    </div>
    
    <!-- decrement button -->
    <button class="btn-stepper-btn btn hover:border-primary-600 hover:!bg-primary-600/5 hover:!text-primary-600 font-bold"
            :disabled="value === stockMax"
            @click=" if (value < stockMax) { value++; } ">
        +
    </button>
</div>
