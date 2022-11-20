<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request){
        if(auth()->user()->chats->contains('id', '=', $request->chat_id)){
            $message = new Message;
            $message->body = $request->body;
            $message->chat_id = $request->chat_id;
            $message->sender_id = auth()->id();

            $message->save();
        }


        return back();

    }
}
