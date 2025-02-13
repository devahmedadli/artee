<?php

namespace App\Models;

use App\Models\Scopes\OfferOrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'freelancer_id', 'admin_price', 'freelancer_price', 'freelancer_archived', 'admin_archived', 'status'];

    protected $casts = [
        'admin_archived'        => 'boolean',
        'freelancer_archived'   => 'boolean',
        'admin_price'           => 'decimal:2',
        'freelancer_price'      => 'decimal:2',
        'status'                => 'string',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OfferOrderScope);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class);
    }
}
