<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\ShoppingCart;

class CartPage extends Component
{
    // Public properties available to the component and view
    public $shoppingCart;       // Holds the current shopping cart model instance
    public $cartItems = [];     // An array of cart items for the shopping cart
    
    public $subtotal = 0;       // The total cost of items in the cart (calculated as the sum of unit_price * quantity)

    public $minSubtotal = 4000; // The minimum subtotal required for free shipping
    public $shippingPrice = ''; //

    // Private property for the extra cost added when wrapping is selected
    private $wrap_price = 10;

    // Define listeners for events fired from child components or elsewhere
    // Both 'itemRemoved' and 'refresh' events trigger a refresh of the cart data
    protected $listeners = [
        'itemRemoved'     => 'refreshCart',
        'refresh'         => 'refreshCart'  //,'refreshMiniCart' => 'refreshCart'
    ];

    /**
     * Mount method: runs when the component is initialized.
     */
    public function mount()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // For authenticated users, fetch or create the active shopping cart
            $this->shoppingCart = ShoppingCart::firstOrCreate([
                'user_id' => auth()->id(),
                'status'  => 'active',
            ]);
        } else {
            // For guests, create a new shopping cart with 'active' status
            $this->shoppingCart = ShoppingCart::create([
                'status' => 'active',
            ]);
        }
        // Populate the cart data (items, count, subtotal) after initializing the shopping cart
        $this->refreshCart();
    }

    /**
     * Method to handle wrapping option.
     * If $wrap is true and the subtotal is greater than 1,
     * add the wrap price to the subtotal; otherwise, re-calculate the cart.
     *
     * @param bool $wrap Whether wrapping is selected or not.
     */
    public function wrapCart(bool $wrap)
    {
        if ($wrap && $this->subtotal > 1) {
            // Add the wrapping fee to the subtotal
            $this->subtotal = $this->subtotal + $this->wrap_price;
        } else {
            // Otherwise, reset the subtotal by re-refreshing the cart data
            $this->refreshCart();
        }
    }
    
    /**
     * Refreshes the cart data.
     * Retrieves the current cart items, calculates the item count and subtotal,
     * then dispatches an event to update any frontend listeners.
     */
    public function refreshCart()
    {
        // Retrieve all cart items associated with the current shopping cart
        $this->cartItems = CartItem::where('shopping_cart_id', $this->shoppingCart->id)->get();

        // Calculate the subtotal as the sum of (unit_price * quantity) for each item
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->unit_price * $item->quantity;
        });

        // Calculating shipping price
        if ($this->subtotal > $this->minSubtotal) {
            $this->shippingPrice = 'Free';
        } else {
            $this->shippingPrice = '$500';
        }
    }

    public function render()
    {
        return view('livewire.cart.cart-page', [
            'cartItems'       => $this->cartItems,
            'subtotal'        => $this->subtotal,
        ]);
    }
}
