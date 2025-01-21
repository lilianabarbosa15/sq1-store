<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class RecommendedProductsSection extends Component
{
    public Collection $products;
    public Collection $categories;
    public Category $selectedCategory;

    public $productsToShow = 8;

    public function mount():void
    {
        $firstsCategories = Category::where('slug', '!=', 'discount-deals')->take(4)->get();
        $discountCategory = Category::where('slug', 'discount-deals')->first();
        $this->categories = $firstsCategories->merge([$discountCategory]);
        $this->selectedCategory = $firstsCategories->skip(1)->first(); //second element of $firstsCategories
    }

    public function selectCategory(string $categorySlug)
    {
        $this->selectedCategory = $this->categories->firstWhere('slug', $categorySlug);
        $this->productsToShow = 8;
    }

    public function loadMore()
    {
        $this->productsToShow += 8; // Increase the limit of products to display
    }

    public function render():View
    {
        return view('livewire.recommended-products-section');
    }
}
