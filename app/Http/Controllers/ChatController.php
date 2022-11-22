<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
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

    public function store(Request $request)
    {
        $chat = new Chat;

        $chat->name = "New Chat";
        if($request->name != null){
            $chat->name = $request->name;
        }

        $chat->save();

       if($request->users != null){
           $users = explode(',', str_replace(' ', '', $request->users.','.auth()->user()->username));

           $users = array_unique($users);

           $user_list = [];

           foreach($users as $user){
                $user = User::where('username', '=', $user)->first();
                if($user != null){
                     $user_list[] = $user->id;
                }
           }
              $chat->users()->attach($user_list);
        }
        return redirect()->route('chats.show', $chat);
    }

    public function update(Request $request, Chat $chat)
    {
        $chat->name = $request->name;

       if($request->users != null){
           $users = explode(',', str_replace(' ', '', $request->users.','.auth()->user()->username));

           $users = array_unique($users);

           $users_already_in_chat = $chat->users->pluck('username')->toArray();

           $users_to_add = array_diff($users, $users_already_in_chat);

           $user_list = [];

           foreach($users_to_add as $user){
                $user = User::where('username', '=', $user)->first();
                if($user != null){
                     $user_list[] = $user->id;
                }
           }
              $chat->users()->sync($user_list);
        }
        if($request->has('avatarchat')) {
            $chat->media()->first()?->delete();
            $chat->addMediaFromRequest('avatarchat')->toMediaCollection();
        }

        $chat->save();

        return redirect()->route('chats.show', $chat);
    }
}

