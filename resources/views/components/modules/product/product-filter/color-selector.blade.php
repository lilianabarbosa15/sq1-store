<div class="grid gap-y-3">
    <h2 class="font-volkhov text-[clamp(15px,3vw,18px)] hover:cursor-default">
        {{ __('Colors') }}
    </h2>

    @php
        $colors = [ '#FF6347', '#FF4500', '#FFFACD', '#7FFF00', '#66CDAA', '#7FFFD4', '#87CEFA',
                    '#00FFFF', '#6495ED', '#7B68EE', '#9370DB', '#BA55D3', '#FF00FF', '#FF69B4', ];
    @endphp
    <div class="flex flex-wrap gap-x-3.5 gap-y-2">
        @foreach ($colors as $color)
            <div style="background-color: {{ $color }};"
                 :class="filters.colors.includes('{{ $color }}') ? 'border-black shadow-inset-white' : ''"
                 class="size-[clamp(26px,5vw,30px)] rounded-full border hover:border-black hover:cursor-pointer"
                 @click="if(filters.colors.includes('{{ $color }}')) 
                        {
                            filters.colors = filters.colors.filter(item => item !== '{{ $color }}');
                        } else {
                            filters.colors.push('{{ $color }}');
                        } search();"
            > </div>
        @endforeach
    </div>
</div>