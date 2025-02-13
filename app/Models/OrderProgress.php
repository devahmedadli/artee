<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrderProgressScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProgress extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'note', 'admin_accepted'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderProgressScope);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}