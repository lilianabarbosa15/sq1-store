<div class="grid gap-y-3" 
    x-data="{
        // Check if a given price range button should be marked as active.
        isPriceActive(price) {
            // Split the price string (e.g., '$0-$50') into two parts.
            let parts = price.split('-');
            let low = Number(parts[0].replace('$',''));
            let high = Number(parts[1].replace('$',''));
            
            if (this.filters.prices.min !== null && this.filters.prices.max !== null) {
                return (this.filters.prices.min <= low && high <= this.filters.prices.max);
            }
            return false;
        },
        // Update the price range when a button is clicked.
        togglePriceInterval(price) {
            // Split the price string into its numeric parts.
            let parts = price.split('-');
            let low = Number(parts[0].replace('$',''));
            let high = Number(parts[1].replace('$',''));
            
            // If no price range is active, set the range to this button's values.
            if (this.filters.prices.min === null || this.filters.prices.max === null) {
                this.filters.prices.min = low;
                this.filters.prices.max = high;
                return;
            }
            
            // If the active range exactly matches this button's range, clear the range.
            if (this.filters.prices.max === high && this.filters.prices.min === low) {
                this.filters.prices.max = null;
                this.filters.prices.min = null;
                return;
            }
            // If the active max equals the button's high, update the max to the button's low.
            if (this.filters.prices.max === high) {
                this.filters.prices.max = low;
                return;
            } 
            // If the active min equals the button's low, update the min to the button's high.
            if (this.filters.prices.min === low) {
                this.filters.prices.min = high;
                return;
            }
            
            // If the button's low is less than the active min, update the active min.
            if (low < this.filters.prices.min) {
                this.filters.prices.min = low;
            }
            // If the button's high is greater than the active max, update the active max.
            if (high > this.filters.prices.max) {
                this.filters.prices.max = high;
            }
        }
    }">
    <h2 class="font-volkhov text-[clamp(15px,3vw,18px)] hover:cursor-default">
        {{ __('Prices') }}
    </h2>
    
    <div>
        <!-- Display the current price range -->
        Max and Min: 
        <span x-text="filters.prices.min"></span>
        <span x-text="filters.prices.max"></span>
    </div>
    
    @php
        $allPrices = ['$0-$50', '$50-$100', '$100-$150', '$150-$200', '$200-$400'];
    @endphp
    <div class="text-gray-400 text-[clamp(12px,3vw,16px)] grid gap-y-2">
        <!-- Loop through each price range button -->
        @foreach($allPrices as $price)
            <button 
                :class="isPriceActive('{{ $price }}') 
                    ? 'text-primary-600 underline' 
                    : 'hover:text-primary-600'"
                class="flex justify-start hover:cursor-pointer"
                @click="togglePriceInterval('{{ $price }}'); search();">
                {{ $price }}
            </button>
        @endforeach
    </div>
</div>
