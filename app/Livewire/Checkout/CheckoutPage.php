<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\ShoppingCart;
use App\Traits\CartLogic;  // Import the trait

class CheckoutPage extends Component
{
    use CartLogic;  // Reuse the shared logic

    // Public properties available to the component and view
    public $shoppingCart;       // Holds the current shopping cart model instance
    public $shippingPrice = ''; // String that can be either 'Free' or '$500.00'
    public $total = 0;          // Sum  of subtotal and shippingPrice

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
        $this->refreshCart();
    }

    /**
     * Refreshes the cart data.
     */
    public function refreshCart()
    {
        $this->refreshCartLogic();
        $this->refreshShippingPrice();
    }

    /**
     * Render method: returns the view for the component.
     */
    public function render()
    {
        return view('livewire.checkout.checkout-page', [
            'cartItems'      => $this->cartItems,
            'subtotal'       => $this->subtotal,
        ]);
    }
}
