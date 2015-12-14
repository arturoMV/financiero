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
use App\Coordinacion;
use App\Presupuesto;
use App\Partida;
use App\User;



Route::get('/', function () {
    return view('index');
});

Route::get('/prueba', function () {
    return view('emails/password');
});

Route::get('/home', function () {

    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

//rutas de configuracion del sistema
Route::get('/configuracion', function(){
   
   $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->first();
    return view('/config/config',['config'=> $config, 'cambio' => false]);
});

Route::post('/configuracion', 'UsuarioController@cambiarConfig');


//Coordinacion routes...
Route::resource('coordinacion', 'CoordinacionController');
Route::post('coordinacion/{coordinacion}/delete', 'CoordinacionController@destroy');
Route::post('coordinacion/{coordinacion}/put', 'CoordinacionController@update');

//Presupuesto routes...
Route::resource('presupuesto', 'PresupuestoController');
Route::post('presupuesto/{presupuesto}/delete', 'PresupuestoController@destroy');
Route::post('presupuesto/{presupuesto}/put', 'PresupuestoController@update');

//Partida routes...
Route::resource('partida', 'PartidaController');
Route::post('partida/{partida}/delete', 'PartidaController@destroy');
Route::post('partida/{partida}/put', 'PartidaController@update');
Route::get('partida/{id}/agregar', 'PartidaController@agregarPartida');
Route::post('partida/{id}/agregar', 'PartidaController@asignarPartida');
Route::post('/transferencia/verificar', 'PartidaController@transferencia');
Route::get('/transferencia/{transferencia}', 'PartidaController@verTransferencia');


Route::get('/transferencia', function () {
    return view('transferencia/transferencia');});

Route::get('/create/transferencia', function () {
    return view('transferencia/nuevaTransferencia');});


//Factura routes...
Route::resource('transaccion', 'FacturaController');
Route::get('transaccion/create/{id}', 'FacturaController@create');
Route::post('transaccion/{partida}/delete', 'FacturaController@destroy');
Route::post('transaccion/{partida}/put', 'FacturaController@update');

//User routes...
Route::resource('usuario', 'UsuarioController');
Route::post('usuario/{usuario}/put', 'UsuarioController@update');
Route::post('usuario/{usuario}/cambiar', 'UsuarioController@cambiarRol');
Route::post('usuario/rol/{usuario}', 'UsuarioController@store');
Route::get('usuario/{usuario}/coordinacion', 'UsuarioController@editarCoordinacion');
Route::post('usuario/{usuario}/coordinacion/put', 'UsuarioController@cambiarCoordinacion');


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
    $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vconfiguracion','=','Periodo')
    ->first();

    $presupuestoPartida = DB::table('tpresupuesto_tpartida')
    ->join('tpresupuesto', 'idPresupuesto', '=', 'tPresupuesto_idPresupuesto')
    ->join('tpartida', 'idPartida', '=', 'tPartida_idPartida')
    ->join('tcoordinacion', 'idCoordinacion', '=', 'tCoordinacion_idCoordinacion')
    ->join('tusuario_tcoordinacion','tCoordi_idCoordinacion', '=' , 'idCoordinacion')
    ->select('idCoordinacion','anno','vNombreCoordinacion','vNombrePresupuesto','codPartida','vNombrePartida',
    'idPartida','id','tPresupuesto_idPresupuesto','tpresupuesto_tpartida.iPresupuestoInicial',
    'tpresupuesto_tpartida.iPresupuestoModificado','tpresupuesto_tpartida.iGasto', 'tpresupuesto_tpartida.iSaldo')
    ->where('tUsuario_idUsuario', '=' , Auth::user()->id)
    ->where('anno','=',$config->iValor)
    ->get();
    
    return $presupuestoPartida;	
});	

Route::get('/usuarios', function () {
	$usuario = User::all();	
    return $usuario;	
});

Route::get('/coordinaciones', function () {
    $coordinacion = DB::table('tcoordinacion')
    ->join('tusuario_tcoordinacion','tCoordi_idCoordinacion', '=' , 'idCoordinacion')
    ->where('tUsuario_idUsuario', '=' , Auth::user()->id)
    ->get(); 
    return $coordinacion;    
});

Route::get('/presupuestos', function () {
    $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->first();



    $presupuestos = DB::table('tpresupuesto')
    ->join('tcoordinacion','tCoordinacion_idCoordinacion','=','idCoordinacion')
    ->join('tusuario_tcoordinacion','tCoordi_idCoordinacion', '=' , 'idCoordinacion')
    ->where('tUsuario_idUsuario', '=' , Auth::user()->id)
    ->where('anno','=',$config->iValor)
    ->get();

    return $presupuestos;   
});

Route::get('/transferencias', function (){
    $transferencias = DB::table('ttranferencia_partida')
    ->join('tpresupuesto_tpartida', 'tPresupuestoPartidaA', '=', 'id')
    ->join('tpresupuesto', 'tPresupuesto_idPresupuesto', '=', 'idPresupuesto')
    ->join('tpartida', 'tPartida_idPartida', '=', 'idPartida')
    ->join('tcoordinacion', 'tCoordinacion_idCoordinacion', '=', 'idCoordinacion')
    ->select('idTransferencia', 'vDocumento','iMontoTransferencia', 'idCoordinacion', 
    'vNombreCoordinacion', 'vNombrePresupuesto', 'anno', 'codPartida')
    ->get();

    return $transferencias;
});



//Modificacion de la sintaxis
Blade::setContentTags('<%', '%>'); // for variables and all things Blade
Blade::setEscapedContentTags('[[', ']]'); // for escaped data


