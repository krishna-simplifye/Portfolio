<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatConversation extends Model
{
    protected $fillable = [
        'session_id',
        'client_country',
        'client_mobile',
        'client_reason',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
