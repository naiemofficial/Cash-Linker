<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Gloudemans\Shoppingcart\Facades\Cart;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'receiver',
        'delivery_address',
        'note',
        'delivery_method_snapshot',
        'payment_method_snapshot',
        'products',
        'products_snapshot',
        'payment_info',
        'status',
    ];

    protected $casts = [
        'receiver'                  => 'array',
        'delivery_address'          => 'array',
        'delivery_method_snapshot'  => 'array',
        'payment_method_snapshot'   => 'array',
        'products'                  => 'array',
        'products_snapshot'         => 'array',
        'payment_info'              => 'array',
    ];

    public static function countCartExtraCost(){
        $sum = 0;
        Cart::content()->each(function($cartItem) use (&$sum){
            $sum += ($cartItem->options->commission * $cartItem->qty);
        });
        return (float) $sum;
    }


    public function logs(){
        return $this->hasMany(OrderLog::class)->orderBy('created_at', 'desc');
    }
}
