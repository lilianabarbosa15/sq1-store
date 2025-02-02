<?php

namespace App\Livewire\Global\Ui;

use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;

class ProductCard extends Component
{
    public Product $product;
    public ProductVariant $selectedVariant;

    public function mount(Product $product): void
    {
        $this->setProduct($product);
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->selectedVariant = $product->product_variants[0];
    }

    public function selectVariant($id)
    {
        $this->selectedVariant = $this->product->product_variants->where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.global.ui.product-card');
    }
}
