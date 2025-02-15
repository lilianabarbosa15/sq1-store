@props(['sizes'])

<div class="grid md:gap-3">
    <p class="font-volkhov font-bold">
        {{ __('Size') }}: <span class="font-normal uppercase" x-text="selectedSize"></span>
    </p>
    
    <div class="flex gap-2" >
        @foreach($sizes as $size)
            <button x-on:click="selectedSize = '{{ $size }}';"
                    :class="stock['{{ strtolower($size) }}'] > 0 
                                ? (selectedSize === '{{ $size }}' 
                                        ? 'btn btn-filled btn-black' 
                                        : 'btn btn-outlined btn-black')
                                : 'cursor-not-none opacity-50'"
                        :disabled="stock['{{ strtolower($size) }}'] <= 0"
                    class="btn btn-outlined p-0 aspect-square w-[clamp(30px,9vw,45px)] uppercase"
            >
                {{ $size }}
            </button>
        @endforeach
    </div>
</div>