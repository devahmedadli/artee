<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ar_name', 'en_name', 'image', 'ar_description', 'en_description', 'base_price', 'active'];

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function values()
    {
        return $this->hasManyThrough(OptionValue::class, ProductOption::class, 'product_id', 'option_id', 'id', 'id');
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : null;
    }

    public function getFullPriceAttribute()
    {
        return $this->base_price + $this->values->sum('price');
    }

    public function orders()
    {
        return $this->hasMany(ProductOrder::class);
    }
}