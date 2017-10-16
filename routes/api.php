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


Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
    // Get Users
    Route::get('users', 'UserController@index');
    Route::get('users/{limit}', 'UserController@index');
    Route::get('users/{limit}/{start}', 'UserController@index');

    // Get User (with id or randomly)
    Route::get('user', 'UserController@show');
    Route::get('user/{id}', 'UserController@show');

    // Update User
    Route::patch('user/{id}', 'UserController@update');

    // Delete User
    Route::delete('user/{id}', 'UserController@delete');
});
