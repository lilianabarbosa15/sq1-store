@props(['images', 'product'])

@php
    $defaultImage = $images[0] ?? '';
@endphp

<section x-data="{ updateImage(image) { this.selectedImage = image; } }" 
         x-init="updateImage('{{ $defaultImage }}')"
         class="flex justify-evenly items-start max-w-[600px] md:w-[clamp(320px,45vw,600px)] aspect-[3/3.45] justify-self-center md:justify-self-end">
    
    <div class="no-visibility-scrollbar flex flex-col gap-4 overflow-y-auto flex-nowrap h-full"
         x-data="{ updateMinImage(image) { this.selectedMinImage = image; } }">
        @foreach($images as $image)
            <img src="{{ $image }}"
                alt="{{ $product->name }}"
                x-on:click="updateImage('{{ $image }}'), updateMinImage('{{ $image }}')"
                :class="selectedMinImage === '{{ $image }}' ? 'border border-black' : 'border border-transparent'"
                class="w-[70px] h-auto p-1.5 hover:border-black hover:cursor-pointer">
        @endforeach
    </div>
    
    <img :src="selectedImage" class="w-[80%] h-auto object-contain" alt="{{ $product->name }}">
</section>
