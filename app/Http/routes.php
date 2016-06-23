<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PageController@home');
Route::get('/bot', 'PageController@bot');

Route::post('/bot/ad6a892e0b5db8cc2cfc31021e671d27', 'PageController@updates');
