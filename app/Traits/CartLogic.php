<?php

namespace App\Traits;

use App\Models\CartItem;

trait CartLogic
{
    // Private property for the extra cost added when wrapping is selected
    private $wrap_price = 10;
    public $minSubtotal = 4000; // The minimum subtotal required for free shipping
    public $subtotal = 0;       // The total cost of items in the cart

    public $cartItems = [];     // An array of cart items for the shopping cart

    
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
     * 
     */
    public function refreshShippingPrice()
    {
        // Calculating shipping price
        if ($this->subtotal > $this->minSubtotal) {
            $this->shippingPrice = 'Free';
            $this->total = $this->subtotal;
        } else {
            $this->shippingPrice = '$500.00';
            $this->total = $this->subtotal + 500;
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
