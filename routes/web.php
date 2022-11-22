<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group( function() {
    Route::get('/dashboard', function () {
        return redirect(route('chats.index'));
    })->name('dashboard');

    Route::resource('chats', \App\Http\Controllers\ChatController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::post('/message/save', [\App\Http\Controllers\MessageController::class, 'store']);
    Route::post('/chat/leave/{id}', [\App\Http\Controllers\ChatController::class, 'leave']);
});




require __DIR__.'/auth.php';
