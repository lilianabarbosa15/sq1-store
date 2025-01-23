<div {{$attributes}} class="relative flex">
    <button x-data="{ color1: '#000000', color2: '#000000' }"
            x-on:click="color1 = open ? '#ED1C24' : '#000000'; color2 = open ? '#ED1C24' : '#EEEEEE'; open = !open;"
            type="button"
            class="hover:text-primary-600/15 text-white border border-transparent rounded-full size-[44px] p-0 box-borde transition-all">
        <x-svg-star-mark color1="color1" color2="color2" class="min-size-6 hover:bg-primary-600" />
    </button>
</div>

