<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request){
        if(auth()->user()->chats->contains('id', '=', $request->chat_id)){
            if($request->attachment != null){
                $message = new Message;
                //if caption is empty then set it to an invisible character
                if($request->caption == null){
                    $message->body = '';
                } else {
                    $message->body = $request->caption;
                }
                $message->chat_id = $request->chat_id;
                $message->sender_id = auth()->id();
                $message->addMediaFromRequest('attachment')->toMediaCollection();
                $message->save();

            } else {
                $message = new Message;
                $message->body = $request->body;
                $message->chat_id = $request->chat_id;
                $message->sender_id = auth()->id();
                $message->save();
            }
        }


        return back();

    }
}
