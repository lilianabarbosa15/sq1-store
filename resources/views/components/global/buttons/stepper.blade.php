<div class="btn-stepper flex items-center justify-between h-auto"
     x-data="{ value: 1 }"
     @input="value = $event.detail">
    <button class="btn hover:border-primary-600 hover:!bg-primary-600/5 hover:!text-primary-600"
            @click="value > 1 ? value-- : value; $dispatch('update-quantity', { value })">
        -
    </button>
    <div class="text-center">
        <span x-text="value"></span>
    </div>
    <button class="btn hover:border-primary-600 hover:!bg-primary-600/5 hover:!text-primary-600"
            @click="value++; $dispatch('update-quantity', { value })">
        +
    </button>
</div>