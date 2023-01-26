<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('messages', 'App\Http\Controllers\Api\MessageController@index')->name('messages.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('send-message', 'App\Http\Controllers\Api\MessageController@store')->name('messages.store');
    Route::get('chats', 'App\Http\Controllers\Api\ChatController@index')->name('chats.index');
    Route::get('chats/{chat}', 'App\Http\Controllers\Api\ChatController@show')->name('chats.show');
    Route::get('leave-chat/{chat}', 'App\Http\Controllers\Api\ChatController@leave')->name('chats.leave');
    Route::get('leave-all-chats', 'App\Http\Controllers\Api\ChatController@leaveAll')->name('chats.leaveAll');
    Route::post('/create-chat', 'App\Http\Controllers\Api\ChatController@store')->name('chats.store');
    Route::post('update-chat', 'App\Http\Controllers\Api\ChatController@update')->name('chats.update');
});

Route::post('mollie', [\App\Http\Controllers\BuyProController::class, 'webhook'])->name('mollie-webhook');

