<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryMethod extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'cost', 'details', 'status'];
}
