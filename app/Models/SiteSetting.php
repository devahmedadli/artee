<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo', 'favicon', 'social_media', 'contact', 'colors'];

    protected $casts = [
        'social_media'  => 'array',
        'contact'       => 'array',
        'colors'        => 'array',
    ];
}
