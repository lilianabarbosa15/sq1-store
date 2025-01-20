<x-guest-layout>
    <main class="flex-1">
        <div class="py-[clamp(30px,5vw,82px)] box-border">
            <div class="wrapper hidden bg-white lg:flex justify-center items-center gap-[clamp(28px,4vw,68px)]"> 
                @foreach(collect(File::allFiles('images/brands'))->shuffle() as $image)
                    <img src="{{ $image }}" alt="" class="w-full h-auto max-w-[clamp(160px,10.5vw,196px)]">
                @endforeach
            </div>


            <x-marquee class="lg:hidden ">
                @foreach(collect(File::allFiles('images/brands')) as $image)
                    <img src="{{ $image }}" alt="" class="w-full h-auto max-w-[clamp(80px,25vw,160px)]">
                @endforeach
            </x-marquee>
        </div>

        <div class="pb-20 border-t-[40px] bg-neutral-300 min-[761px]:bg-white"
             style="border-image: linear-gradient(180deg, #F9F9F9, #FFFFFF, #FFFFFF); border-image-slice: 380; box-sizing: border-box; flex-wrap: wrap;"
        >
            <livewire:recommended-products-section/>
        </div>
    </main>
</x-guest-layout>
