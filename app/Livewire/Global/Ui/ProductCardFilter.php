<?php

namespace App\Livewire\Global\Ui;

use App\Models\Product;
use Livewire\Component;

class ProductCardFilter extends Component
{
    // The product stored as a plain array.
    public $product;
    // A Collection of product variants.
    public $variants;
    // The currently selected variant.
    public $selectedVariant;

    /**
     * Mount the component with the given product.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function mount(Product $product): void
    {
        // Convert the product (and its loaded relationships) to a plain array.
        $this->product = $product->toArray();

        // Check if the product has variants.
        if (empty($this->product['product_variants'])) {
            // If no variants exist, initialize variants as an empty collection.
            $this->variants = collect();
            // Set selectedVariant to null (or set a default value if desired).
            $this->selectedVariant = null;
        } else {
            // Convert the product_variants array into a Collection.
            $this->variants = collect($this->product['product_variants']);
            // Select the first variant as the default.
            $this->selectedVariant = $this->variants->first();
        }
    }

    /**
     * Select a variant based on its ID.
     *
     * @param  mixed  $id
     * @return void
     */
    public function selectVariant($id)
    {
        // Look for the variant with the given ID in the preloaded variants.
        $variant = $this->variants->firstWhere('id', $id);

        // If the variant is found, update the selected variant.
        if ($variant) {
            $this->selectedVariant = $variant;
        }
    }

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.global.ui.product-card-filter');
    }
}

