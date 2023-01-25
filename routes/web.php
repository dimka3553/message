<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group( function() {
    Route::get('/dashboard', function () {
        return redirect(route('chats.index'));
    })->name('dashboard');

    Route::get('/buy-pro', [\App\Http\Controllers\BuyProController::class, 'prepare'])->name('prepare-payment');
    Route::get('/buy-pro/success', [\App\Http\Controllers\BuyProController::class, 'success'])->name('buy-pro.success');

    Route::get('/create-key', [\App\Http\Controllers\CreateKeyController::class, 'create'])->name('create-key');
    Route::get('/delete-keys', [\App\Http\Controllers\CreateKeyController::class, 'delete'])->name('delete-keys');

    Route::resource('chats', \App\Http\Controllers\ChatController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::post('/message/save', [\App\Http\Controllers\MessageController::class, 'store']);
    Route::post('/chat/leave/{id}', [\App\Http\Controllers\ChatController::class, 'leave']);
});




require __DIR__.'/auth.php';
