<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CartItem;
use App\Models\User;

class ShoppingCart extends Model
{
    /** @use HasFactory<\Database\Factories\ShoppingCartFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
    ];

    public static function getOrCreateForCurrentUser()
    {
        if (auth()->check()) {
            return self::firstOrCreate([
                'user_id' => auth()->id(),
                'status'  => 'active',
            ]);
        } else {
            if (session()->has('guest_shopping_cart_id')) {
                $shoppingCart = self::find(session()->get('guest_shopping_cart_id'));
                if (!$shoppingCart) {
                    $shoppingCart = self::create([
                        'status' => 'active',
                        'wrap' => false,
                    ]);
                    session()->put('guest_shopping_cart_id', $shoppingCart->id);
                }
                return $shoppingCart;
            } else {
                $shoppingCart = self::create([
                    'status' => 'active',
                ]);
                session()->put('guest_shopping_cart_id', $shoppingCart->id);
                return $shoppingCart;
            }
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function cart_items() {
        return $this->hasMany(CartItem::class, 'shopping_cart_id', 'id');
    }
}
