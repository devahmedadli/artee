<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id',
        'method',
        'details',
        'amount',
        'status',
        'date',
        'note',
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

}
