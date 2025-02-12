<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\ShoppingCart;
use App\Traits\CartLogic;  // Import the trait

class CartPage extends Component
{
    use CartLogic;  // Reuse the shared logic

    // Public properties available to the component and view
    public $shoppingCart;       // Holds the current shopping cart model instance
    public $cartItems = [];     // An array of cart items for the shopping cart
    public $cartItemsCount = 0; // The total number of items in the cart
    public $subtotal = 0;       // The total cost of items in the cart (calculated as the sum of unit_price * quantity)
    public $minSubtotal = 4000; // The minimum subtotal required for free shipping
    public $shippingPrice = ''; //

    public $wrapStatus = true;

    // 
    protected $listeners = [
        'itemRemoved'     => 'refreshCart',
        'refresh'         => 'refreshCart',
        'wrapUpdatedbyMin'=> 'refreshCart'
    ];

    /**
     * Mount method: runs when the component is initialized.
     */
    public function mount()
    {
        // Initialize the shopping cart
        if (auth()->check()) {
            $this->shoppingCart = ShoppingCart::firstOrCreate([
                'user_id' => auth()->id(),
                'status'  => 'active',
            ]);
        } else {
            $this->shoppingCart = ShoppingCart::create([
                'status' => 'active',
            ]);
        }
        //
        $this->wrapStatus = $this->shoppingCart->wrap;
        //
        $this->refreshCart();
    }

    // WrapCart method calls the trait's logic
    public function wrapCart(bool $wrap)
    {
        $this->wrapCartLogic($wrap);
        $this->dispatch('wrapUpdatedbyCart');
    }

    /**
     * Refreshes the cart data.
     * Retrieves the current cart items, calculates the item count,
     * then dispatches an event to update any frontend listeners.
     */
    public function refreshCart()
    {
        $this->refreshCartLogic();
        $this->dispatch('cart-updated', [
            'cartItemsCount' => $this->cartItemsCount
        ]);
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
