<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\ProductVariant;
//use App\Models\CategoryItem;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'brand',
        'price',
        //'tag',
        'description',
    ];

    public $timestamps = false;

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function product_variants() {
        return $this->hasMany(ProductVariant::class);
    }
}
