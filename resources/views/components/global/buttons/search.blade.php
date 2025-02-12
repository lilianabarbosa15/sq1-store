<div {{$attributes}} x-cloak x-data="{ open: false }" @keydown.escape="open = false" class="relative flex">
    <button x-on:click="open = !open" type="button" x-show="!open" 
            class="inline-flex items-center justify-center hover:text-primary-600 
            hover:bg-gray-100 p-2 rounded-md text-black transition duration-150 ease-in-out">
        <x-global.svg.search class="min-size-6" />
    </button>

    <div x-cloak class="flex items-end gap-2 overflow-hidden transition-all duration-200" x-bind:class="{ 'w-auto': open, 'w-0': !open }">
        <button x-show="open" x-transition x-on:click="open = false" type="button" 
                class="inline-flex items-center justify-center hover:text-primary-600 
                hover:bg-gray-100 p-2 rounded text-gray-900 transition duration-150 ease-in-out">
            <x-global.svg.x-mark class="size-5" />
        </button>
        <form>
            <div>
                <x-global.forms.input-label for="search" class="sr-only">{{__('Search')}}</x-global.forms.input-label>
                <x-global.forms.input
                    id="search"
                    type="search"
                    name="search"
                    required
                    autofocus
                    autocomplete="search"
                    placeholder="{{__('Search for products')}}"
                />
            </div>
        </form>
    </div>
</div>
