<x-guest-layout :navBackground="'bg-white'">
<div class="wrapper grid grid-cols-3 2md:grid-cols-4 my-5" x-data="filtersComponent()">

    <!-- Types of filters: size, color, price, brand, collection -->
    <aside class="col-start-1 col-end-2 flex flex-col gap-y-5 p-2">
        <div class="flex flex-col items-start md:flex-row md:justify-between md:items-center">
            <h1 class="font-volkhov text-[clamp(25px,5vw,30px)]">{{ __('Filters') }}</h1>
            <button class="text-primary-600 hover:underline hover:cursor-pointer"
                    @click="clearPriceFilter();">
                {{ __('Clear') }}
            </button>
        </div>

        <x-modules.product.product-filter.size-selector />
        <x-modules.product.product-filter.color-selector />
        <x-modules.product.product-filter.price-selector />
        <x-modules.product.product-filter.brand-selector />
        <x-modules.product.product-filter.collection-selector />

    </aside>
    
    <!-- Products' container (updated by AJAX) -->
    <div class="col-start-2 col-end-4 2md:col-start-2 2md:col-end-5 grid" 
        x-data="{ grid: 3 }" >

        @include('pages.products-list')
    </div>

</div>


<script>
function filtersComponent() {
    return {
        // Holds the filter options.
        filters: {
            sizes: [],
            colors: [],
            prices: { min: null, max: null },
            brand: '',
            name: '',
            collection: '',
        },
        // Timeout ID for debouncing the search function.
        searchTimeout: null,
        //
        saveFilters() {
            localStorage.setItem('filters', JSON.stringify(this.filters));
        },
        //
        restoreFilters() {
            const savedFilters = localStorage.getItem('filters');
            if (savedFilters) {
                this.filters = JSON.parse(savedFilters);
            }
        },
        
        // Constructs the query string and makes an AJAX call to update the product list.
        search() {
            const query = new URLSearchParams();

            //
            query.append('page', '1');

            // Add size filters to the query string.
            if (this.filters.sizes.length > 0) {
                this.filters.sizes.forEach(size => {
                    query.append('filters[sizes][]', size);
                });
            }
            // Add color filters to the query string.
            if (this.filters.colors.length > 0) {
                this.filters.colors.forEach(color => {
                    query.append('filters[colors][]', color);
                });
            }
            // Add minimum and maximum price filters.
            if (this.filters.prices.min !== null) {
                query.append('filters[prices][min]', this.filters.prices.min);
            }
            if (this.filters.prices.max !== null) {
                query.append('filters[prices][max]', this.filters.prices.max);
            }
            // Add brand filter.
            if (this.filters.brand) {
                query.append('filters[brand]', this.filters.brand);
            }
            // Add name filter.
            if (this.filters.name) {
                query.append('filters[name]', this.filters.name);
            }
            // Add collection filter.
            if (this.filters.collection) {
                query.append('filters[collection]', this.filters.collection);
            }

            console.log('query: ', query.toString());

            // Build the URL using the route and the query string.
            const url = "{{ route('products.search') }}" + "?" + query.toString();

            // Make the AJAX call using fetch.
            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                // Update the product container with the new HTML.
                document.querySelector('#product-container').innerHTML = html;
                // Optionally update the browser URL.
                history.pushState(null, '', url);
                this.saveFilters();
            })
            .catch(error => console.error('Error in fetch:', error));
        },
        
        // Initializes filters from the local storage.
        init() {
            this.restoreFilters();
            if (this.filters.name) {
                this.search();      // Perform search if there is a name filter.
            }
        },
        
        // Clears all filter options and triggers a search.
        clearPriceFilter() {
            this.filters.prices.min = null;
            this.filters.prices.max = null;
            this.filters.colors = [];
            this.filters.sizes = [];
            this.filters.brand = '';
            this.filters.name = '';
            this.filters.collection = '';
            this.saveFilters();
            this.search(); // Update search after clearing filters.
        },
    }
}
</script>


</x-guest-layout>