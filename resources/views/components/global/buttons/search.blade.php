<div {{$attributes}} x-cloak x-data="searchComponent()" @keydown.escape="open = false" class="relative flex">
    <!-- Search button -->
    <button x-on:click="open = !open" type="button" x-show="!open" 
            class="inline-flex items-center justify-center hover:text-primary-600 
            hover:bg-gray-100 p-2 rounded-md text-black transition duration-150 ease-in-out">
        <x-global.svg.search class="min-size-6" />
    </button>

    <!-- Search input container -->
    <div x-cloak class="flex items-end gap-2 overflow-hidden transition-all duration-200" 
         x-bind:class="{ 'w-auto': open, 'w-0': !open }">
        <!-- Close button -->
        <button x-show="open" x-transition x-on:click="open = false" type="button" 
                class="inline-flex items-center justify-center hover:text-primary-600 
                hover:bg-gray-100 p-2 rounded text-gray-900 transition duration-150 ease-in-out">
            <x-global.svg.x-mark class="size-5" />
        </button>

        <!-- Search form -->
        <form @submit.prevent="redirectToSearch">
            <div>
                <x-global.forms.input-label for="search" class="sr-only">{{ __('Search') }}</x-global.forms.input-label>
                <x-global.forms.input
                    id="search"
                    type="search"
                    name="search"
                    x-model="search"
                    @keyup.enter.window="redirectToSearch"
                    required
                    autofocus
                    autocomplete="search"
                    placeholder="{{ __('Search for products') }}"
                />
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('searchComponent', () => ({
            open: false,
            search: '',

            redirectToSearch() {
                if (this.search.trim() === '') {
                    console.warn("Cannot search with an empty input");
                    return;
                }

                // Retrieve existing filters from localStorage
                let filters = JSON.parse(localStorage.getItem('filters')) || {};

                // Store the search term in filters
                filters.name = this.search.trim();

                // Save updated filters back to localStorage
                localStorage.setItem('filters', JSON.stringify(filters));

                // Redirect to the product search page
                const url = "{{ route('products.search') }}";
                console.log(`Redirecting to: ${url}`);
                window.location.href = url;
            }
        }));
    });
</script>
