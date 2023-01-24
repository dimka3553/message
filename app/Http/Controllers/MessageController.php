<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

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

                //if the user with username GPT is in the chat then send the message to the GPT
                //if the message  body contains @gpt then send the message to the GPT

                if(auth()->user()->chats->find($request->chat_id)->users->contains('username', '=', 'GPT')&& str_contains($message->body, '@gpt') !== false){
                    $gpt = auth()->user()->chats->find($request->chat_id)->users->where('username', '=', 'GPT')->first();
                    $prompt = $message->body;
                    $result = OpenAI::completions()->create([
                        'model' => 'text-davinci-003',
                        'max_tokens' => 350,
                        'prompt' => $prompt,
                    ]);
                    $gpt_message = new Message;
                    $gpt_message->body = $result->choices[0]->text;
                    $gpt_message->chat_id = $request->chat_id;
                    $gpt_message->sender_id = $gpt->id;
                    $gpt_message->save();
                }
            }
        }


        return back();

    }
}
