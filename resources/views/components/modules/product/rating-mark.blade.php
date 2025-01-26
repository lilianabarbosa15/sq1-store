<div class="flex gap-2 items-center" 
     x-data="{ rating: {{ $rating ?? 0 }}, maxStars: {{ $maxStars ?? 5 }} }">
    <div class="flex">
        <template x-for="star in maxStars" :key="star">
            <div class="flex gap-0 space-x-0">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-4 h-4 gap-0 space-x-0"
                    :fill="star <= rating ? '#000000' : 'none'" 
                    stroke="#000000" 
                    stroke-width="" 
                    stroke-linecap="" 
                    stroke-linejoin=""
                    viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                </svg>
            </div>
        </template>
    </div>

    <span class="text-[15px]"> 
        ({{ $rating ?? 0 }}) 
    </span>
</div>


