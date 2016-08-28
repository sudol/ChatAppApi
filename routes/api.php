<?php

use Illuminate\Http\Request;

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

Route::post('/users/register', 'UsersController@register');
Route::post('/users/login', 'UsersController@login');
Route::get('/users/me', 'UsersController@view')->middleware('auth:api');
Route::put('/users/me', 'UsersController@edit')->middleware('auth:api');

Route::get('/chats', 'ChatController@list')->middleware('auth:api');
Route::post('/chats', 'ChatController@create')->middleware('auth:api');

Route::get('/messages/list', 'MessagesController@list')->middleware('auth:api');
Route::post('/messages/create', 'MessagesController@create')->middleware('auth:api');
