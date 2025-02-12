<?php

namespace App\Livewire\Global\Ui;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\Product;

class CheckoutCartItem extends Component
{
    /*
        States of the cart item (for reference):
        - active: the user is actively adding products.
        - checking_out: the user has started the checkout process.
        - checked_out: the purchase has been completed.
        - abandoned: the user left the cart without completing the purchase.
    */

    // The cart item model instance
    public CartItem $item;
    // The associated product for this cart item
    public Product $product;
    // The variant of the product
    public ProductVariant $variant;

    
    /**
     * The mount method is called when the component is initialized.
     * It sets up the item, its variant, and its associated product.
     *
     * @param CartItem $item The cart item passed to the component.
     */
    public function mount(CartItem $item): void
    {
        // Set the cart item for this component.
        $this->item = $item;
        // Find and assign the product variant based on the cart item's product_variant_id.
        $this->variant = ProductVariant::find($this->item->product_variant_id);
        // Find and assign the product associated with the variant.
        $this->product = Product::find($this->variant->product_id);
    }

    public function update() {}

    /**
     * Renders the Livewire component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Return the Blade view located at resources/views/livewire/global/ui/checkout-cart-item.blade.php.
        return view('livewire.global.ui.checkout-cart-item');
    }
}
