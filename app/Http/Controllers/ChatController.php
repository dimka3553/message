<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('chats.messages.sender');

        return view('chats.index', compact('user'));
    }

    public function show(Chat $chat)
    {
        $user = auth()->user()->load('chats.messages.sender');

        if($user->chats->contains($chat)){
            $chat = $user->chats->where('id', '=', $chat->id)->sole();
            return view('chats.show', compact('chat', 'user'));
        } else {
            return redirect()->route('chats.index');
        }


    }


}
