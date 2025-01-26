<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductDetails extends Component
{
    public Product $product;
    public array $colorNames;

    public function render(): View
    {
        
        return view('livewire.product-details');
    }

}
