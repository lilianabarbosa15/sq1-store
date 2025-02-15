<div class="grid gap-y-3 w-full">
    <h2 class="font-volkhov text-[clamp(15px,3vw,18px)] font-medium hover:cursor-default">
        {{ __('Size') }}
    </h2>

    @php
        $sizes = ['s', 'm', 'l', 'xl'];
    @endphp
    <div class="2md:w-[60%]">
        @foreach($sizes as $size)
            <button 
                :class="filters.sizes.includes('{{ $size }}') 
                    ? 'btn btn-filled btn-gray-filter' 
                    : 'btn btn-outlined btn-gray-filter'"
                class="p-0 aspect-square w-[clamp(30px,5vw,45px)] m-[2px] 2md:mr-2 2md:mb-2 uppercase"
                @click="if(filters.sizes.includes('{{ $size }}')) {
                        filters.sizes = filters.sizes.filter(item => item !== '{{ $size }}');
                    } else {
                        filters.sizes.push('{{ $size }}');
                    } search();">
                {{ $size }}
            </button>
        @endforeach
    </div>
</div>