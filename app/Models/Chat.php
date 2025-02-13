<?php

namespace App\Models;

use App\Models\Scopes\ChatOrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'chatable_id', 'chatable_type', 'archived', 'last_message_at'];

    protected $casts = [
        'archived'        => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ChatOrderScope);
    }

    public function chatable()
    {
        return $this->morphTo();
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }


    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

}
