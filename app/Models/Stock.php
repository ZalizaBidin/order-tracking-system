<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'item_name',
        'description',
        'price',
        'quantity',
        'image',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
