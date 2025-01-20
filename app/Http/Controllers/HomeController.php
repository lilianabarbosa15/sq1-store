<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke():View
    {
        $firstsCategories = Category::where('slug', '!=', 'discount-deals')->take(15)->get();
        $discountCategory = Category::where('slug', 'discount-deals')->first();

        $categories = collect($firstsCategories)->merge([$discountCategory]);

        return view('pages.home', [
            'categories' => $categories
        ]);
    }
}
