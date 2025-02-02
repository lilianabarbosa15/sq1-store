<?php

namespace App\Livewire\Pages\Product;

use App\Models\Product;
use App\Models\ProductVariant;
//use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductPage extends Component
{
    /*  */

    public Product $product;
    public ProductVariant $selectedVariant;

    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->selectedVariant = $product->product_variants[0];
    }

    public function selectVariant(int $id)
    {
        $this->selectedVariant = ProductVariant::find($id);
        $this->selectedVariant->quantity = json_decode($this->selectedVariant->quantity, true);
    }


    /*  */

    public function addToCart($quantity, int $variant_id, string $size)//:View
    {
        /*
        Product variant is associated with the Product (general).
        Each product_variant has:
        {
            "id": 39,
            "product_id": 16,
            "color_name": "lightblue",
            "color": "#ADD8E6",
            "sale_price": 94.09,
            "sale_end_time": "2025-02-12T04:56:48Z",
            "quantity": {
                "s": 57,
                "m": 96,
                "l": 28,
                "xl": 34
            }
        }
        */
        $this->selectVariant( $variant_id );
        
        dump('size:', $size);
        dump('quantity:', $quantity);
        dump('variant:', $variant_id);
        die;

        //dump($quantity);

        // Cart::add($productId, $quantity);
        
        //
    }



    public function render()
    {
        return view('livewire.pages.product.product-page');
    }
}
