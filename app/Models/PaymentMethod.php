<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $fillable = ['logo', 'name', 'account_no', 'account_name', 'type', 'category', 'swift_code', 'description', 'status'];
}
