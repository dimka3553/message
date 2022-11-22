<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $request->user()->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096|nullable',
        ]);


        $user = $request->user();
        $user->name = $request->name;
        $user->username = $request->username;

        if($request->has('avatar')) {
            $user->media()->first()?->delete();
            $user->addMediaFromRequest('avatar')->toMediaCollection();
        }

        $user->save();



        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
