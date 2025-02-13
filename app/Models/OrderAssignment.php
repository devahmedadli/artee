<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'freelancer_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}