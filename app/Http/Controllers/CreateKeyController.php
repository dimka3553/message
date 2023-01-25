<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateKeyController extends Controller
{


    public function create(){
        //create sanctum key
        //generate a random string
        $x = random_int(1,5454545);
        $k = hash('sha256', $x);
        $key = auth()->user()->createToken($k)->plainTextToken;
        return response()->json(['key' => $key, 'message'=>'Copy the key and close this page, it will not be shown again.']);
    }

    public function delete(){
        //delete all keys
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'All keys deleted']);
    }
}
