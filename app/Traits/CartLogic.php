<?php

namespace App\Traits;

use App\Models\CartItem;

trait CartLogic
{
    // Private property for the extra cost added when wrapping is selected
    private $wrap_price = 10;

    /**
     * Refresh the cart data.
     * Retrieves the current cart items, calculates the item count and subtotal.
     */
    public function refreshCartLogic()
    {
        // Retrieve all cart items associated with the current shopping cart
        $this->cartItems = CartItem::where('shopping_cart_id', $this->shoppingCart->id)->get();

        // Calculate the total number of items in the cart
        $this->cartItemsCount = $this->cartItems->count();

        // Calculate the subtotal as the sum of (unit_price * quantity) for each item
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->unit_price * $item->quantity;
        });

        if ($this->shoppingCart->wrap && $this->subtotal > 1) {
            $this->subtotal += $this->wrap_price;
        }
        
    }

    /**
     * Handle the wrapping option.
     * If $wrap is true and the subtotal is greater than 1,
     * add the wrapping fee; otherwise, re-calculate the cart.
     *
     * @param bool $wrap Whether wrapping is selected or not.
     */
    public function wrapCartLogic(bool $wrap)
    {
        $this->shoppingCart->wrap = $wrap;
        $this->shoppingCart->save();

        $this->refreshCartLogic();
    }
}
