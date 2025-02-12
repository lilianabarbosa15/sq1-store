<header x-data="{ isOpen: false }">
    <div class="wrapper border-b md:border-b-0">
        <div class="flex justify-between items-center gap-4 py-4 md:pt-12 box-border">
            <div class="flex items-end gap-4">
                <button x-on:click="$dispatch('open-modal', 'mobile-nav')"
                    class="inline-flex items-center justify-center hover:text-primary-500 hover:bg-gray-100 p-2 rounded-md text-gray-400 transition duration-150 ease-in-out md:hidden">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{route('home')}}">
                    <span class="sr-only">{{config('app.name')}}</span>
                    <img src="{{asset('images/sq1-logo.svg')}}" alt="{{config('app.name')}}" width="120" height="37" />
                </a>
            </div>
            <div class="w-fit md:flex justify-end items-center gap-5 hidden">
                <x-global.buttons.search />
                <a href="{{route('profile')}}">
                    <x-global.buttons.user-nav />
                </a>
                <x-global.buttons.shopping-cart />
            </div>
        </div>
    </div>
    <nav class="{{ $navBackground }} w-full py-3.5 box-border border-y border-gray-200 hidden md:block">
        <div class="wrapper max-w-4xl flex justify-around items-center gap-4">
            @foreach(config('navigation') as $item)
                <a href="" class="uppercase font-bold text-sm text-gray-900 hover:text-primary-600">
                    {{$item['title']}}
                </a>
            @endforeach
        </div>
    </nav>

    <template x-teleport="#aside-modal" x-show="isOpen">
        <x-global.modals.modal name="mobile-nav" :maxWidth="null" :fullscreen="true">
            <x-global.modals.modal-card class="w-screen min-h-screen rounded-none pt-0 px-0 sm:p-0 flex flex-col" x-effect="window.addEventListener('resize', () => { if (window.innerWidth > 768) $dispatch('close-modal', 'mobile-nav') })">
                <div class="flex items-end gap-4 border-b py-5 px-4">
                    <button x-on:click="$dispatch('close-modal', 'mobile-nav')"
                            class="inline-flex items-center justify-center hover:text-primary-500 hover:bg-gray-100 p-2 rounded-md text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <a href="{{route('home')}}">
                        <span class="sr-only">{{config('app.name')}}</span>
                        <img src="{{asset('images/sq1-logo.svg')}}" alt="{{config('app.name')}}" width="120" height="37" />
                    </a>
                </div>
                <div class="px-4 pt-5 pb-4 flex-1">
                    <nav class="flex flex-col">
                        @foreach(config('navigation') as $item)
                            <a href="" class="uppercase font-bold text-sm text-gray-900 hover:text-primary-600 border-b px-6 py-4 hover:bg-neutral-100">
                                {{$item['title']}}
                            </a>
                        @endforeach
                    </nav>
                </div>
            </x-global.modals.card-modal>
        </x-global.modals.modal>
    </template>
</header>
