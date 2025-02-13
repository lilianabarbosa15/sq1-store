<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;

use App\Models\CartItem;
use App\Models\ShoppingCart;
//use Illuminate\Contracts\View\View;


class ProductPage extends Component
{
    //
    public $shoppingCart;       // Holds the current shopping cart model instance
    public $cartItem;

    public Product $product;
    public ProductVariant $selectedVariant;

    public $sizes;
    public $defaultSize;
    public $stockData;
    

    public function mount(Product $product): void
    {
        // Initialization
        $this->product = $product;
        $this->selectedVariant = $product->product_variants[0];
        $this->sizes = array_keys($this->selectedVariant->quantity);
        $this->defaultSize = $this->sizes[0];
        $this->stockData = json_encode($this->selectedVariant->quantity, JSON_UNESCAPED_UNICODE);

        // Shopping cart shared by the View
        $this->shoppingCart = \App\Models\ShoppingCart::getOrCreateForCurrentUser(); //dump($this->shoppingCart->id);
    }

    public function selectVariant(int $id)
    {
        $this->selectedVariant = ProductVariant::find($id);
        $this->selectedVariant->quantity = json_decode($this->selectedVariant->quantity, true);
        
        $this->sizes = array_keys($this->selectedVariant->quantity);
        $this->defaultSize = $this->sizes[0];
        $this->stockData = json_encode($this->selectedVariant->quantity, JSON_UNESCAPED_UNICODE);
    }

    /*  */
    public function addToCart($quantity, int $variant_id, string $size)
    {
        // Retrieve all items associated with the current shopping cart
        $allItems = CartItem::where('shopping_cart_id', $this->shoppingCart->id)->get();
                
        // Find the first item that matches the selected variant ID.
        // You can use firstWhere to return the first matching item.
        $item = $allItems->firstWhere('product_variant_id', $variant_id);

        // Check if an item was found AND if the sizes match (after converting to uppercase)
        if ($item !== null && strtoupper($item->size) === strtoupper($size)) {
            $item->delete();
        }
        // Determine the unit price
        if (($this->selectedVariant->sale_price) == null) {
            // Otherwise, retrieve the regular price from the Product model.
            // Use $variant->product_id to get the product id.
            $product_id = $this->selectedVariant->product_id;
            $unit_price = Product::where('id', $product_id)->value('price');
        } else {
            // If there's a sale price, use it.
            $unit_price = $this->selectedVariant->sale_price;
        }
        // Use firstOrCreate to either retrieve an existing cart item or create a new one.
        // The first array is used as search criteria and the second sets additional attributes if a new record is created.
        $this->cartItem = CartItem::firstOrCreate(
            [
                'shopping_cart_id'      => $this->shoppingCart->id,
                'product_variant_id'    => $variant_id,
                'size'          => strtoupper($size),
                'quantity'      => $quantity,
                'unit_price'    => $unit_price,
            ]
        );

        // Emit an event to refresh the mini-cart
        $this->dispatch('refreshMiniCart');
    }

    public function render()
    {
        return view('livewire.pages.product.product-page');
    }
}
