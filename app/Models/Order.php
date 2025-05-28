<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Gloudemans\Shoppingcart\Facades\Cart;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'items', 'delivery_method', 'address', 'payment_method', 'status', 'note'];

    public static function countCartExtraCost(){
        $sum = 0;
        Cart::content()->each(function($cartItem) use (&$sum){
            $sum += ($cartItem->options->commission * $cartItem->qty);
        });
        return (float) $sum;
    }
}
