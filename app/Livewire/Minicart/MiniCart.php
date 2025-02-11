<?php

namespace App\Livewire\Minicart;

use Livewire\Component;
use App\Models\ShoppingCart;
use App\Traits\CartLogic;  // Import the trait

class MiniCart extends Component
{
    use CartLogic;  // Reuse the shared logic

    // Public properties available to the component and view
    public $shoppingCart;       // Holds the current shopping cart model instance
    public $cartItems = [];     // An array of cart items for the shopping cart
    public $cartItemsCount = 0; // The total number of items in the cart
    public $subtotal = 0;       // The total cost of items in the cart (calculated as the sum of unit_price * quantity)
    public $minSubtotal = 4000; // The minimum subtotal required for free shipping

    //
    protected $listeners = [
        'itemRemoved'     => 'refreshCart',
        'refresh'         => 'refreshCart',
        'refreshMiniCart' => 'refreshCart',
        'wrapUpdatedbyCart'=> 'refreshCart'
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
        $this->refreshCart();
    }

    // WrapCart method calls the trait's logic
    public function wrapCart(bool $wrap)
    {
        $this->wrapCartLogic($wrap);
        $this->dispatch('wrapUpdatedbyMin');
        
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
    }

    /**
     * Render method: returns the view for the component.
     */
    public function render()
    {
        return view('livewire.pages.minicart.mini-cart', [
            'cartItems'      => $this->cartItems,
            'cartItemsCount' => $this->cartItemsCount,
            'subtotal'       => $this->subtotal,
        ]);
    }
}
