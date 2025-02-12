<?php

namespace App\Livewire\Global\Ui;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\Product;

class MiniCartItem extends Component
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

    public $wrapStatus = false;

    
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

    /**
     * Updates the quantity of the CartItem.
     * This method is triggered by an event from Alpine.js (e.g., when a user changes the quantity).
     *
     * @param int $newQuantity The new quantity entered by the user.
     * @return void
     */
    public function updateQuantity($newQuantity)
    {
        // Update the quantity property of the cart item.
        $this->item->quantity = $newQuantity;

        // Persist the updated quantity to the database.
        $this->item->save();
        // Dispatch a custom event 'refresh' (used to notify the parent component)
        // passing the ID of the updated cart item.
        $this->dispatch('refresh', $this->item->id);
    }

    /**
     * Removes the cart item from the database.
     * This method is called when the user decides to remove the item.
     *
     * @return void
     */
    public function removeItem()
    {
        // Delete the cart item record from the database.
        $this->item->delete();
        // Dispatch a custom event 'itemRemoved' to notify the parent component
        // that an item has been removed (passing the item's ID).
        $this->dispatch('itemRemoved', $this->item->id);
    }

    /**
     * Renders the Livewire component view.
     *
     * @return \Illuminate\View\View The view for the mini cart item.
     */
    public function render()
    {
        // Return the Blade view located at resources/views/livewire/global/ui/mini-cart-item.blade.php.
        return view('livewire.global.ui.mini-cart-item');
    }
}
