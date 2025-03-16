<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_id',
        'product_id',
        'subtotal',
        'discount',
        'total',
        'data',
        'status',
        'is_paid',
        'payment_id',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public static function boot()
    {
        parent::boot();
        // global observer to return orders in latest
        static::addGlobalScope('latest', function ($query) {
            $query->latest();
        });
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
