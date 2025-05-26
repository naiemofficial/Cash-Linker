<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'items', 'delivery_method', 'address', 'payment_method', 'status', 'note'];
}
