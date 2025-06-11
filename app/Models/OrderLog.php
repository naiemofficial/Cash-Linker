<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'note'
    ];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (is_null($model->status) && is_null($model->note)) {
                throw new \InvalidArgumentException('Either status or note must be filled');
            }
        });
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

}
