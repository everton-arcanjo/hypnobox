<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contatos','ContatosController@index');
Route::get('/contatos/edit/{id}', 'ContatosController@edit');
Route::post('/contatos/update/{id}', 'ContatosController@update');
Route::get('/contatos/show/{id}', 'ContatosController@show');
Route::get('/contatos/create', 'ContatosController@create');
Route::post('/contatos/cadastrar', 'ContatosController@store');
Route::get('/contatos/destroy/{id}', 'ContatosController@destroy');
Route::any('/contatos/pesquisar','ContatosController@pesquisar');

Route::get('/contatos-api','ControllerContatosApi@indexView');

Route::get('/usuarios','UsuariosController@index');
Route::get('/usuarios/edit/{id}', 'UsuariosController@edit');
Route::get('/usuarios/show/{id}', 'UsuariosController@show');
Route::any('/usuarios/update/{id}', 'UsuariosController@update');
Route::get('/usuarios/create', 'UsuariosController@create');
Route::post('/usuarios/cadastrar', 'UsuariosController@store');
Route::get('/usuarios/destroy/{id}', 'UsuariosController@destroy');
Route::any('/usuarios/pesquisar','UsuariosController@pesquisar');