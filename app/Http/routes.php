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
use App\Partida;
use App\User;

Route::get('/algo', function () {

abort(503);


});

Route::get('/', function () {
    return view('index');
});

Route::get('/prueba', function () {
    return view('prueba');
});




Route::get('/home', function () {
    return view('index');
});
Route::get('/presupuesto', function () {
    return view('presupuesto');
});

Route::get('/factura', function () {
    return view('factura');
});

Route::get('/about', function () {
    return view('about');
});

Route::post('auth/login', 'Auth\AuthController@postLogin');


Route::resource('usuario', 'UsuarioController');

Route::resource('partida', 'PartidaController');

Route::post('partida/{partida}/delete', 'PartidaController@destroy');
Route::post('partida/{partida}/put', 'PartidaController@update');


Route::post('usuario/{usuario}/put', 'UsuarioController@update');
Route::post('usuario/{usuario}/cambiar', 'UsuarioController@cambiarRol');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


//angular model routes
Route::get('/partidas', function () {
	$partida = Partida::all();	
    return $partida;	
});	

Route::get('/usuarios', function () {
	$usuario = User::all();	
    return $usuario;	
});	


//Modificacion de la sintaxis
Blade::setContentTags('<%', '%>'); // for variables and all things Blade
Blade::setEscapedContentTags('[[', ']]'); // for escaped data


//prueba mail
Route::get('/sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message) {

        $message->from('r2robsr@gmail.com', 'Learning Laravel');

        $message->to('r2robsr@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";

});