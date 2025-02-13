<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Freelancer extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'bio',
        'country',
        'website',
        'specification',
        'skills',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'freelancer_id', 'user_id');
    }

    public function assignedOrders()
    {
        return $this->hasMany(OrderAssignment::class, 'freelancer_id', 'user_id');
    }

    public function chat()
    {
        return $this->hasOne(Chat::class, 'chatable_id', 'user_id');
    }
}
