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
        $chat->load('users.chats.messages', 'users.chats.users');

        $user = auth()->user();
        if($user->chats->contains($chat)){
            $messages = $chat->messages;
            $users = $chat->users;
            return view('chats.show', compact('chat', 'user', 'messages', 'users'));
        } else {
            return redirect()->route('chats.index');
        }


    }


}
