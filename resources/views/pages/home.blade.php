<x-guest-layout :navBackground="'bg-neutral-50'">
    <main class="flex-1">
        <!-- Hero Section -->
        <section class="py-10 sm:py-20 bg-blue-100/80">
            <livewire:hero-section/>
        </section>
        
        <!-- Asociated brands Section -->
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

        <!-- Recommeded products Section -->
        <section class="pb-20 border-t-[40px] bg-neutral-300 min-[761px]:bg-white"
             style="border-image: linear-gradient(180deg, #F9F9F9, #FFFFFF, #FFFFFF); border-image-slice: 380; box-sizing: border-box; flex-wrap: wrap;"
        >
            <livewire:recommended-products-section/>
        </section>

        <!-- Promotional Section -->
        <div class="relative z-1 py-8 sm:py-20" 
        >
            @php
                $background = asset('images/marketing/background-banner.jpg');
            @endphp
            <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat bg-slate-700"
                    style="background-image: url('{{ $background }}'); 
                            filter: blur(2px) contrast(0.9) brightness(0.6);" > </div>
            <livewire:promotional-section/>
        </div>

        <!-- Additional information -->
        <aside class="wrapper py-10 grid gap-3 font-poppins 
             grid-cols-2 grid-flow-row  lg:grid-cols-none lg:grid-flow-col lg:gap-0">
            @php
                $features = [
                    ['icon' => 'svg-quality', 'title' => __('High Quality'), 'subtitle' => __('crafted from top materials')],
                    ['icon' => 'svg-warranty', 'title' => __('Warranty Protection'), 'subtitle' => __('Over 2 years')],
                    ['icon' => 'svg-shipping', 'title' => __('Free shipping'), 'subtitle' => __('Order over 150 $')],
                    ['icon' => 'svg-support', 'title' => __('24 / 7 Support'), 'subtitle' => __('Dedicated support')],
                ];
            @endphp

            @foreach ($features as $feature)
                <div class="flex gap-2 sm:justify-self-center min-[547px]:w-60">
                    <x-dynamic-component :component="$feature['icon']" />
                    <div>
                        <p class="font-medium text-[clamp(14px,4vw,20px)] capitalize">
                            {{ $feature['title'] }}
                        </p>
                        <p class="hidden 2xs:flex font-normal text-base">
                            {{ $feature['subtitle'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </aside>

    </main>
    <x-footer/>
</x-guest-layout>
