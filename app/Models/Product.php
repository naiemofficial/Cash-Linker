<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
        'category',
        'type',
        'year',
        'amount',
        'type',
        'commission',
        'image',
        'description',
    ];
}
