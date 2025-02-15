<div class="grid gap-y-3" x-data="{ open: false }">
    <div class="flex justify-between  items-center hover:text-primary-600 text-black hover:cursor-pointer" @click="open = !open">
        <h2 class="font-volkhov text-[clamp(15px,3vw,18px)]" >
            {{ __('Collections') }}
        </h2>
        <div class="hidden 2xs:flex">
            <x-global.svg.caret-updown-mark />
        </div>
    </div>

    @php
        $collections = [ 'All products', 'Best sellers', 'New arrivals', 'Accessories', ];
    @endphp
    <div class="text-gray-400 text-[clamp(12px,3vw,16px)] grid gap-y-2" :class="{ 'hidden': open, 'block': !open }">
        @foreach ($collections as $collection)
            <button 
                :class="filters.collection === '{{ $collection }}' ? 'text-primary-600 underline' : 'text-gray-400'"
                class="flex justify-start hover:text-primary-600 hover:underline hover:cursor-pointer"
                @click="filters.collection = '{{ $collection }}'; search();">
                {{ $collection }}
            </button>
        @endforeach
    </div>
</div>