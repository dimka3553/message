<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('chats.index', compact('user'));
    }

    public function show(Chat $chat)
    {
        $user = auth()->user();
        if($user->chats->contains($chat)){
            $messages = $chat->messages();
            return view('chats.show', compact('chat', 'user', 'messages'));
        } else {
            return redirect()->route('chats.index');
        }


    }


}
