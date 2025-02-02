<div {{ $attributes->merge(['class' => 'btn-stepper flex items-center justify-between h-auto']) }} 
    x-data="{ value: 1, 
            min: 1,
            updateValue() {
                if (this.value > this.stockMax) {
                    this.value = this.stockMax;         //adjust the maximum value in case it exceeds the new limit
                }
                $dispatch('update-quantity', { value: this.value });
            }
        }"
     x-init="$watch('stockMax', () => updateValue())" >             <!-- <p>Max: <span x-text="stockMax"></span></p> -->
    
    <button class="btn hover:border-primary-600 hover:!bg-primary-600/5 hover:!text-primary-600"
            @click="value > min ? value-- : value; $dispatch('update-quantity', { value })">
        -
    </button>
    
    <div class="text-center">
        <span x-text="value"></span>
    </div>
    
    <button class="btn hover:border-primary-600 hover:!bg-primary-600/5 hover:!text-primary-600"
            @click="value < stockMax ? value++ : value; $dispatch('update-quantity', { value })">
        +
    </button>
</div>
