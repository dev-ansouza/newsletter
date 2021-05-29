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

//Rota para os controllers

use App\Http\Controllers\NewsLetter\NewsLetterController;

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Rota para a tela de login
Route::get('/', 'WelcomeController@index');

//Rota para a tela home
Route::get('home', 'HomeController@index');

//Rota para a tela de NewsLetter
Route::get('/home/newsletter', function()
{
    return view('newsletter/list');
});