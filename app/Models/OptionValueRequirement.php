<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValueRequirement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'option_value_id',
        'ar_name',
        'en_name',
        'type',
        'required'
    ];
    
    public function optionValue()
    {
        return $this->belongsTo(OptionValue::class);
    }
}
