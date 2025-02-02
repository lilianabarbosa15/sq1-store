@props(['selectedVariant'])

<div class="flex items-center gap-1 xs:gap-3">
    <x-global.svg.views />
    <p class="text-[14px] xs:text-base text-gray-400 font-normal"> 
        {{ $selectedVariant->review_count }} {{ __('people are viewing this right now') }}
    </p>
</div>
