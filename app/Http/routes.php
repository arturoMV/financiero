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


Route::get('/algo', function () {
abort(503);
});

Route::get('/', function () {
    return view('index');
});

Route::get('/prueba', function () {
    return view('emails/password');
});

Route::get('/home', function () {
    return view('index');
});


// Route::get('/transaccion/{id}', function ($id) {
//     $partida = Partida::find($id);

//     $numFactura = DB::table('tfactura')
//     ->max('idFactura');

//     if($numFactura == null){
//         $ret  = 1;
//     }else{
//         $numFactura++;
//     }

//     return view('factura',['partida'=>$partida,'numFactura' =>$numFactura]);
// });

Route::get('/about', function () {
    return view('about');
});

//rutas de configuracion del sistema
Route::get('/configuracion', function(){
   
   $config = DB::table('tConfiguracion')
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

//Factura routes...
Route::resource('transaccion', 'FacturaController');
Route::get('transaccion/create/{id}', 'FacturaController@create');
Route::post('transaccion/{partida}/delete', 'FacturaController@destroy');
Route::post('transaccion/{partida}/put', 'FacturaController@update');

//User routes...
Route::resource('usuario', 'UsuarioController');
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
    $config = DB::table('tConfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->first();

    $calculos = Partida::all()
    ->where('tPresupuesto_anno', $config->iValor);


	$partidas = DB::table('tPartida')
    ->join('tpresupuesto', 'idPresupuesto','=','tPresupuesto_idPresupuesto')
    ->where('tPresupuesto_anno', $config->iValor)
    ->get();
    
    foreach ($calculos as $calculo) {
        $calculo->presupuestoModificado();
        $calculo->calcularSaldo();
    }

    return $calculos;	
});	

Route::get('/usuarios', function () {
	$usuario = User::all();	
    return $usuario;	
});

Route::get('/coordinaciones', function () {
    $coordinacion = Coordinacion::all(); 
    return $coordinacion;    
});

Route::get('/presupuestos', function () {
    $config = DB::table('tConfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->first();



    $partidas = DB::table('tpresupuesto')
    ->where('anno','=',$config->iValor)
    ->get();

    return $partidas;   
});


//Modificacion de la sintaxis
Blade::setContentTags('<%', '%>'); // for variables and all things Blade
Blade::setEscapedContentTags('[[', ']]'); // for escaped data


