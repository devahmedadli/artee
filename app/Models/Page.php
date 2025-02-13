<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sections',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'sections' => 'array',
    ];
}
