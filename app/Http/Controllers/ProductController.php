<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;


use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function addToCart(int $quantity)
    {
        Log::info("Quantity received: $quantity");

        return response()->json(['quantity' => $quantity]);
    }





    /**
     * Display the specified resource.
     * e.g. http://api-endpoints.test/product/1
     */
    public function show(int $id):View
    {
        $product = Product::find($id);
        
        //If there is no product in the database we return a 404.
        if(!$product) {
            return response()->json(["message" => "Product Not Found"], 404);
        }

        //Tranformation of the JSON element other_atributes.
        $product->other_attributes = json_decode($product->other_attributes, true);

        /*return response()->json([
            'product' => $product,
        ], 200);*/
        return view('pages.product', [
            'product' => $product,
        ]);
    }


    public function __invoke():View
    {
        /*$firstsCategories = Category::where('slug', '!=', 'discount-deals')->take(15)->get();
        $discountCategory = Category::where('slug', 'discount-deals')->first();

        $categories = collect($firstsCategories)->merge([$discountCategory]);*/

        return view('pages.product', [
            //'categories' => $categories
        ]);
    }
}
