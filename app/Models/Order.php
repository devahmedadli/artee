<?php

namespace App\Models;

use App\Models\Scopes\OrderOrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'freelancer_id',
        'service_id',
        'order_number',
        'subtotal',
        'discount',
        'total',
        'description',
        'deadline',
        'freelancer_archived',
        'admin_archived',
        'status',
        'customer_accepted',
        'is_paid',
        'payment_id'
    ];

    protected $casts = [
        'admin_archived'        => 'boolean',
        'freelancer_archived'   => 'boolean',
        'customer_archived'     => 'boolean',
        'status'                => 'string',
        'customer_accepted'     => 'boolean',
        'is_paid'               => 'boolean',
        'payment_id'            => 'string',
        'deadline'              => 'datetime',
        'subtotal'              => 'decimal:2',
        'discount'              => 'decimal:2',
        'total'                 => 'decimal:2',

    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrderOrderScope);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            do {
                $randomNumber = mt_rand(10000, 99999); // Generate a random 5-digit number
                $orderNumber = 'ORD' . $randomNumber;
            } while (self::where('order_number', $orderNumber)->exists());

            $order->order_number = $orderNumber;
        });
    }
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function files()
    {
        return $this->hasMany(OrderFile::class);
    }

    public function attachments()
    {
        return $this->hasMany(OrderAttachment::class);
    }

    public function assignedTo()
    {
        return $this->hasOne(OrderAssignment::class);
    }

    public function progress()
    {
        return $this->hasMany(OrderProgress::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
