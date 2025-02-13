<?php

namespace App\Models;

use App\Models\Scopes\UsersScope;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role',
        'name',
        'username',
        'email',
        'phone',
        'avatar',
        'password',
        'lang',
        'active_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UsersScope);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }


    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function isFreelancer()
    {
        return $this->role === 'freelancer';
    }

    public function customerOrders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function freelancerOrders()
    {
        return $this->hasMany(Order::class, 'freelancer_id');
    }

    public function assignedOrders()
    {
        return $this->hasMany(OrderAssignment::class, 'freelancer_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'freelancer_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function freelancer()
    {
        return $this->hasOne(Freelancer::class);
    }

    public function freelancerPayments()
    {
        return $this->hasMany(FreelancerPayment::class, 'freelancer_id');
    }
}
