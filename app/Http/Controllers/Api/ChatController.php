<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        //get names of chats
        $chatNames = Auth::user()->chats()->pluck('name', 'id');
        return $chatNames;
    }

    public function store(Request $request)
    {
        $chat = new Chat;

        ray($request);

        $chat->name = "New Chat";
        if($request->name != null){
            $chat->name = $request->name;
        }

        $chat->save();

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

        return $chat;
    }

    public function show($id)
    {

        //if user not authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }


        if (Auth::user()->chats()->where('id', $id)->exists()) {
            $messages = Auth::user()->chats()->find($id)->messages()->with('sender')->get();
            //from messages only keep the id and the body
            $messages = $messages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'body' => $message->body,
                    'sender' => [
                        'id' => $message->sender->id,
                        'name' => $message->sender->name,
                        'username' => $message->sender->username,
                    ],
                ];
            });
            return $messages;
        } else {
            return response()->json(['error' => 'You are not in this chat'], 403);
        }
    }


    public function update(Request $request)
    {
        $chat = Chat::find($request->id);
        $chat->name = $request->name;

        if($request->users != null){
            $users = explode(',', str_replace(' ', '', $request->users.','.auth()->user()->username));

            $users_already_in_chat = $chat->users->pluck('username')->toArray();

            $users = array_merge($users_already_in_chat, $users);
            $users = array_unique($users);

            $user_list = [];

            foreach($users as $user){
                $user = User::where('username', '=', $user)->first();
                if($user != null){
                    $user_list[] = $user->id;
                }
            }
            $chat->users()->sync($user_list);
        }

        $chat->save();
        return(response()->json(['success' => 'chat updated'], 200));
    }

    public function leave($id)
    {
        $chat = Chat::find($id);
        $chat->users()->detach(auth()->user()->id);

        //send message to chat that user left
        $message = new Message;
        $message->body = auth()->user()->name . ' left the chat';
        $message->sender_id = auth()->user()->id;
        $message->chat_id = $chat->id;
        $message->save();

        if($chat->users->count() == 0){
            $chat->delete();
        }

        return response()->json(['success' => 'You left the chat'], 200);
    }

    public function leaveAll(){
        $user = Auth::user();
        $user->chats()->detach();
        return (response()->json(['message' => 'You have left all chats'], 200));
    }
}
