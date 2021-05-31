<?php

use Psr\Http\Message\ServerRequestInterface;

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
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Rota para a tela de login
Route::get('/', 'WelcomeController@index');

//Rota para a tela home
Route::get('home', 'HomeController@index');

//Rota para a tela de listagem das NewsLetters
Route::get('/home/newsletter', 'NewsLetterController@index');

//Rota para o formulário de newsletter
Route::get('/home/newsletter/new', function() {
	return view('newsletter/form');
});

//Rota para o save de newsletter
Route::post('/home/newsletter/new', 'NewsLetterController@store');

//Rota para edição de newsletter
Route::get('/home/newsletter/edit/{id}', 'NewsLetterController@edit');