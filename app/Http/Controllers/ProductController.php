<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Product;
use App\Services\ProductFilterService;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class ProductController extends Controller
{
    public $perPage = 9;    // poducts/pages by default

    protected $filterService;


    public function __construct(ProductFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

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


    /**
     * Display a listing of the resource (Product's database)
     * http://localhost:8000/product/
     * e.g. http://localhost:8000/product?per_page=4&page=4
     * e.g. http://localhost:8000/product?page=4
     * e.g. http://localhost:8000/product?per_page=4
     */
    public function index(Request $request)
    {
        // Retrieve products, applying filters if necessary.
        $products = Product::with(['product_variants', 'categories'])
                    ->paginate($this->perPage)
                    ->appends($request->query());

        // If no products are found, return a 404 JSON response.
        if ($products->isEmpty()) {
            return response()->json(["message" => "Products Not Found"], 404);
        }
        
        // Return the complete view when the request is not AJAX.
        return view('pages.products', [
            'products' => $products,
        ]);
    }


    /**
     * Search and display a list of resources of Product's database.
     * This filter by name, color, size, brand, collection (categories), and price.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // Call the service to get filtered products.
        $products = $this->filterService->filter($request);

        //dump($products);

        // If the request is AJAX, return the partial view.
        if ($request->ajax()) {
            //dump('ajax: ', $request);
            return view('pages.products-list', compact('products'));
        }

        // Otherwise, return the full view.
        return view('pages.products', compact('products'));
    }


    public function __invoke():View
    {
        return view('pages.products');
    }
}
