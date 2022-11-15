<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $chats = auth()->user()->chats;
        return view('chats.index', compact('user', 'chats'));
    }


}
