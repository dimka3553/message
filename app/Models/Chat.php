<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Message;

class Chat extends Model
{
    use HasFactory;

    public function lastMessage() {
        return $this->messages->sortByDesc('created_at')->first();
    }

    public function messages(){
        return $this->hasMany(Message::class, 'chat_id' );
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
