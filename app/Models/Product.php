<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status',
        'origin',
        'name',
        'value',
        'category',
        'type',
        'year',
        'price',
        'commission',
        'image',
        'description',
    ];
}
