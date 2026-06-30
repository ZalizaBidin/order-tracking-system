<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'stock_id',
        'order_no',
        'customer_id',
        'shopper_id',
        'item_name',
        'item_description',
        'quantity',
        'estimated_budget',
        'delivery_address',
        'latitude',
        'longitude',
        'status',
        'remarks',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function shopper()
    {
        return $this->belongsTo(User::class, 'shopper_id');
    }

    public function logs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
