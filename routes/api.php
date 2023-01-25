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
    Route::post('messages', 'App\Http\Controllers\MessageController@store')->name('messages.store');
    Route::get('chats', 'App\Http\Controllers\ChatController@index')->name('chats.index');
    Route::get('chats/{chat}', 'App\Http\Controllers\ChatController@show')->name('chats.show');
    Route::post('chats', 'App\Http\Controllers\ChatController@store')->name('chats.store');
    Route::put('chats/{chat}', 'App\Http\Controllers\ChatController@update')->name('chats.update');
});

Route::post('mollie', [\App\Http\Controllers\BuyProController::class, 'webhook'])->name('mollie-webhook');

