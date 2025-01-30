<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Product;
//use App\Models\OrderItem;
//use App\Models\CartItem;

class ProductVariant extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'color_name',
        'color',
        'sale_price',
        'sale_end_time',
        'rating',
        'quantity',
        'images',
        'review_count',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    /*public function order_items() {
        return $this->hasMany(OrderItem::class, 'product_variant_id', 'id');
    }

    public function cart_items() {
        return $this->hasMany(CartItem::class, 'product_variant_id', 'id');
    }*/
}
