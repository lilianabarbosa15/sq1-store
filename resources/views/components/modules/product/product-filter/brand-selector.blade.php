<div class="grid gap-y-3 w-full" x-data="{ open: false }">
    <div class="flex justify-between items-center hover:text-primary-600 text-black hover:cursor-pointer" @click="open = !open">
        <h2 class="font-volkhov text-[clamp(15px,3vw,18px)]">
            {{ __('Brands') }}
        </h2>
        <div class="hidden 2xs:flex">
            <x-global.svg.caret-updown-mark />
        </div>
    </div>
            
    @php
        $brands = ['Minimog', 'Retolie', 'Brook', 'Learts', 'Vagabond', 'Abby'];
    @endphp
    <div class="text-[clamp(12px,3vw,16px)] flex flex-wrap gap-x-4 gap-y-2 w-[70%]" :class="{ 'hidden': open, 'block': !open }">
        @foreach($brands as $brand)
            <button 
                :class="filters.brand === '{{ $brand }}' ? 'text-primary-600 underline' : 'text-gray-400'"
                class="hover:text-primary-600 hover:underline hover:cursor-pointer"
                @click="filters.brand = '{{ $brand }}'; search();">
                {{ $brand }}
            </button>
        @endforeach
    </div>
</div>