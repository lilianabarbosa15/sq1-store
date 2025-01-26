<div {{$attributes}} class="relative flex">
    <button x-data="{ color1: '#000000', color2: '#EEEEEE' }"
            x-on:click="color1 = open ? '#ED1C24' : '#000000'; color2 = open ? '#ED1C24' : '#EEEEEE'; open = !open;"
            type="button"
            class="hover:text-primary-600/15 text-white border border-transparent rounded-full w-[clamp(40px,10vw,45px)] aspect-square p-0 box-borde transition-all">
        <x-global.svg.star-mark color1="color1" color2="color2" class="max-w-[45px] aspect-square hover:bg-primary-600" />
    </button>
</div>

