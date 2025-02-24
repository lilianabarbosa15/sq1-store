<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductFilterService
{
    protected $perPage;

    public function __construct($perPage = 9)
    {
        $this->perPage = $perPage;
    }

    /**
     * Applies filters to products and returns a paginated result.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filter(Request $request)
    {
        // Get filters from the request with default values.
        $filters = $request->input('filters', [
            'name'       => '',
            'colors'     => [],
            'sizes'      => [],
            'prices'     => ['min' => null, 'max' => null],
            'brand'      => '',
            'collection' => '',
        ]);

        $query = Product::with(['product_variants', 'categories']);


        /*
        * Filter by sizes:
        * Convert each size to lowercase and filter products that have at least one variant
        * where the quantity for each given size is greater than or equal to 1.
        */
        if (!empty($filters['sizes'])) {
            $sizes = array_map('strtolower', $filters['sizes']);

            $query->whereHas('product_variants', function ($q) use ($sizes) {
                foreach ($sizes as $size) {
                    $q->whereRaw("json_extract(quantity, '$.\"$size\"') >= ?", [1]);
                }
            });

            // Also, load only the variants that meet the condition.
            $query->with(['product_variants' => function ($q) use ($sizes) {
                foreach ($sizes as $size) {
                    $q->whereRaw("json_extract(quantity, '$.\"$size\"') >= ?", [1]);
                }
            }]);
        }


        /*
        * Filter by brand:
        * If a brand filter is set, search for products where the brand contains the given value.
        */
        if (!empty($filters['brand'])) {
            $query->where('brand', 'like', '%' . $filters['brand'] . '%');
        }


        /*
        * Filter by collection:
        * Convert the collection filter to a slug (lowercase with hyphens) and filter products
        * that belong to categories whose slug contains the collection filter.
        */
        if (!empty($filters['collection'])) {
            $slug_collection = strtolower(preg_replace('/\s+/', '-', $filters['collection']));
            $query->whereHas('categories', function ($q) use ($slug_collection) {
                if ($slug_collection !== 'all-products') {
                    $q->where('slug', 'like', '%' . $slug_collection . '%');
                }
            });
        }


        /*
        * Filter by colors:
        * Convert colors to lowercase and trim spaces, then filter products that have at least one variant
        * with a color matching one of the provided values.
        */
        if (!empty($filters['colors'])) {
            $colors = array_map(function ($c) {
                return strtolower(trim($c));
            }, $filters['colors']);

            $query->whereHas('product_variants', function ($q) use ($colors) {
                $q->whereIn(\DB::raw('TRIM(LOWER(color))'), $colors);
            });
        }


        /*
        * Filter by name:
        * If a name filter is provided, search for products where the slug contains the given value.
        */
        if (!empty($filters['name'])) {
            $slug_name = strtolower(preg_replace('/\s+/', '-', $filters['name']));
            $query->where('slug', 'like', '%' . $slug_name . '%');
        }


        /*
        * Filter by prices:
        * If both minimum and maximum prices are set, apply one of three cases:
        * - Case A: The product's price is between min and max.
        * - Case B: The product's price is greater than max, but it has at least one variant with a sale_price between min and max.
        * - Case C: The product's price is less than min, but it has at least one variant with a sale_price >= min.
        */
        if (isset($filters['prices']['min']) && isset($filters['prices']['max'])) {
            $min = (float) $filters['prices']['min'];
            $max = (float) $filters['prices']['max'];

            $query->where(function ($q) use ($min, $max) {
                $q->whereBetween('price', [$min, $max])
                ->orWhere(function ($q2) use ($min, $max) {
                    $q2->where('price', '>', $max)
                        ->whereHas('product_variants', function ($q3) use ($min, $max) {
                            $q3->whereNotNull('sale_price')
                                ->whereBetween('sale_price', [$min, $max]);
                        });
                })
                ->orWhere(function ($q2) use ($min) {
                    $q2->where('price', '<', $min)
                        ->whereHas('product_variants', function ($q3) use ($min) {
                            $q3->whereNotNull('sale_price')
                                ->where('sale_price', '>=', $min);
                        });
                });
            });

            // Ensure the full relation is loaded for post-processing.
            $query->with('product_variants');
        }


        // Apply pagination, keeping the query parameters (filters) in the pagination links.
        $products = $query->paginate($this->perPage)->appends($request->query());

        /*
        * Post-processing: Filter product variants based on price rules.
        * For each product, adjust the variants collection if necessary:
        * - If the product's price is greater than max, keep only variants with sale_price between min and max.
        * - If the product's price is less than min, keep only variants with sale_price >= min.
        * - Otherwise, leave the variants unfiltered.
        */
        if (isset($filters['prices']['min']) && isset($filters['prices']['max'])) {
            $min = (float) $filters['prices']['min'];
            $max = (float) $filters['prices']['max'];

            $products->through(function ($product) use ($min, $max) {
                if ($product->price > $max) {
                    $filteredVariants = $product->product_variants->filter(function ($variant) use ($min, $max) {
                        return !is_null($variant->sale_price)
                            && $variant->sale_price >= $min
                            && $variant->sale_price <= $max;
                    });
                    $product->setRelation('product_variants', $filteredVariants);
                } elseif ($product->price < $min) {
                    $filteredVariants = $product->product_variants->filter(function ($variant) use ($min) {
                        return !is_null($variant->sale_price)
                            && $variant->sale_price >= $min;
                    });
                    $product->setRelation('product_variants', $filteredVariants);
                }
                return $product;
            });
        }

        return $products;
    }
}
