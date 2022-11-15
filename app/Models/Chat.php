<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Message;

class Chat extends Model
{
    use HasFactory;

    public function lastMessage() {
        return Message::all()
            ->where('chat_id', '=', $this->id)
            ->last();
    }

    public function messages(){
        return $this->hasMany(Message::class, 'chat_id' )->get();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
