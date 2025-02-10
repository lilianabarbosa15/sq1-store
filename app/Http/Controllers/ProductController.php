<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;


class ProductController extends Controller
{

    private function _decodeJsonAttributes( Object $items ): Object
    {
        // Transform the collection by iterating through each item
        $items->transform(function ($item) {

            // Check if 'product_variants->quatity' contains a valid JSON string
            // Decode the JSON string into an associative array
            foreach ($item->product_variants as $variant) {
                $variant->quantity = json_decode($variant->quantity, true);
            }
            
            // Return the item with the 'product_variants->quatity' field transformed into an array
            return $item;
        });

        // Return the collection after all items have been transformed
        return $items;
    }

    
    /**
     * Display the specified resource.
     * e.g. http://localhost:8000/product/1
     */
    public function show(int $id):View
    {
        $product = Product::with(['product_variants'])->find($id);

        //If there is no product in the database we return a 404.
        if(!$product) {
            return response()->json(["message" => "Product Not Found"], 404);
        }

        //Tranformation of the JSON element product_variants->quantity.
        $product = collect([$product]);
        $product = $this->_decodeJsonAttributes($product);

        /*return response()->json([
            'product' => $product,
        ], 200);*/
        
        return view('pages.product', [
            'product' => $product->first(),
        ]);
    }


    public function __invoke():View
    {
        return view('pages.product');
    }
}
