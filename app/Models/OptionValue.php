<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;

    protected $fillable = ['option_id', 'ar_value', 'en_value', 'price'];

    public function option()
    {
        return $this->belongsTo(ProductOption::class, 'option_id', 'id');
    }

    public function requirements()
    {
        return $this->hasMany(OptionValueRequirement::class);
    }
}
