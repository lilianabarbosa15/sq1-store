<div {{ $attributes->merge(['class' => 'flex flex-col md:gap-2']) }} >
    <p class="text-gray-600">
        {{ __('Only') }} <strong x-text="stockMax"></strong> {{ __('item(s) left in stock!') }}
    </p>
    <div class="h-[5px] w-full bg-gray-150 rounded-full">
        <div x-bind:style="`width: ${(stockMax / 100) * 100}%`"
             class="h-full bg-primary-550 rounded-full transition-all duration-300">
        </div>
    </div>
</div>