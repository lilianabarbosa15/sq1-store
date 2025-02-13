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
    public $shippingPrice = ''; // String that can be either 'Free' or '$500.00'
    public $wrapStatus = true;  //

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
        // Shopping cart shared by the View
        $this->shoppingCart = \App\Models\ShoppingCart::getOrCreateForCurrentUser(); //dump($this->shoppingCart->id);
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
        $this->dispatch('cart-updated', [ 'cartItemsCount' => $this->cartItemsCount ]);
        $this->refreshShippingPrice();
    }

    public function render()
    {
        return view('livewire.cart.cart-page', [
            'cartItems'       => $this->cartItems,
            'subtotal'        => $this->subtotal,
        ]);
    }
}
