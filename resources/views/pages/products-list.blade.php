<!-- Product Container -->
<div id="product-container" class="flex-grow" x-data="gridComponent()" 
    x-init="grid = localStorage.getItem('grid') ? parseInt(localStorage.getItem('grid')) : 3"
    @resize.window="checkScreenSize()">

    <div class="flex wrapper space-x-2 mb-4 w-full justify-end">
        <button x-on:click="setGrid(2)" class="btn-column hidden 2xs:flex" id="btn-grid-2">
            <x-global.svg.2-column />
        </button>
        <button x-on:click="setGrid(3)" class="btn-column hidden 2sm:flex" id="btn-grid-3">
            <x-global.svg.3-column />
        </button>
        <button x-on:click="setGrid(4)" class="btn-column hidden 2md:flex" id="btn-grid-4">
            <x-global.svg.4-column />
        </button>
        <button x-on:click="setGrid(5)" class="btn-column hidden l:flex" id="btn-grid-5">
            <x-global.svg.5-column />
        </button>
    </div>

    <!-- Grid of products -->
    <div 
    
        :class="{
            'grid grid-cols-2 gap-3': grid === 1,
            'grid grid-cols-2 gap-3': grid === 2,
            'grid grid-cols-3 gap-3': grid === 3,
            'grid grid-cols-4 gap-3': grid === 4,
            'grid grid-cols-5 gap-3': grid === 5
        }">
        @foreach($products as $product)
            <livewire:global.ui.product-card-filter :product="$product" wire:key="product-{{ $product->id }}" />
        @endforeach
    </div>
        
    <!-- Pagination (always at the bottom) -->
    <div class="mt-8">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>
</div>

<!-- x-data -->
<script>
function gridComponent() {
    return {
        grid: localStorage.getItem('grid') ? parseInt(localStorage.getItem('grid')) : 3,
        screenWidth: window.innerWidth,

        setGrid(value) {
            if (this.screenWidth < 1060 && value > 4) {
                this.grid = 4;
            } else if (this.screenWidth < 860 && value > 3) {
                this.grid = 3;
            } else if (this.screenWidth < 670 && value > 2) {
                this.grid = 2;
            } else {
                this.grid = value;
            }
            localStorage.setItem('grid', this.grid);
        },

        checkScreenSize() {
            this.screenWidth = window.innerWidth;
            //
            const btnGrid5 = document.getElementById('btn-grid-5');
            if (btnGrid5 && window.getComputedStyle(btnGrid5).display === 'none' && this.grid === 5) {
                this.setGrid(4);
            }
            //
            const btnGrid4 = document.getElementById('btn-grid-4');
            if (btnGrid5 && window.getComputedStyle(btnGrid4).display === 'none' && this.grid === 4) {
                this.setGrid(3);
            }
            //
            const btnGrid3 = document.getElementById('btn-grid-3');
            if (btnGrid3 && window.getComputedStyle(btnGrid3).display === 'none' && this.grid === 3) {
                this.setGrid(2);
            }
            //
            const btnGrid2 = document.getElementById('btn-grid-2');
            if (btnGrid2 && window.getComputedStyle(btnGrid2).display === 'none' && this.grid === 2) {
                this.setGrid(1);
            }
        }
    }
}
</script>
