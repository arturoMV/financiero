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
use App\Presupuesto_Partida;
use App\Factura;

//rutas de aplicaccion
Route::get('/verRespaldosRealizados', function () {
    return view('respaldos/index');
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

Route::get('/about', function () {
    return view('about');
});

Route::get('respaldo', 'UsuarioController@showRespaldo');
Route::post('respaldo', 'UsuarioController@respaldo');

//rutas de configuracion del sistema
Route::get('/configuracion', function(){
   
   $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->where('tUsuario_idUsuario', '=', Auth::user()->id)
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
Route::post('partida/{partida}/borrar', 'PartidaController@destroyPresupuestoPartida');
Route::post('partida/{partida}/put', 'PartidaController@update');
Route::get('partida/{id}/agregar', 'PartidaController@agregarPartida');
Route::post('partida/{id}/agregar', 'PartidaController@asignarPartida');
Route::get('partida/editar/{id}', 'PartidaController@editPresupuestoPartida');
Route::post('partida/editar/{id}', 'PartidaController@updatePresupuestoPartida');

//rutas de transferencias
Route::post('/transferencia/verificar', 'PartidaController@transferencia');
Route::get('/transferencia/{transferencia}', 'PartidaController@verTransferencia');
Route::get('/transferencia', function () {
    $anno = DB::table('tconfiguracion')
            ->select('iValor')
            ->where('vConfiguracion','Periodo')
            ->where('tUsuario_idUsuario', Auth::user()->id)
            ->first();
    return view('transferencia/transferencia', ['anno'=> $anno]);});

Route::get('/create/transferencia', function () {
    if(Auth::user()){
        $anno = DB::table('tconfiguracion')
            ->select('iValor')
            ->where('vConfiguracion','Periodo')
            ->where('tUsuario_idUsuario', Auth::user()->id)
            ->first();
        return view('transferencia/nuevaTransferencia', ['anno'=> $anno]);
    }else{
        return view('layouts/master');
    }});

//rutas de informes
Route::get('/presupuesto/informe-gastos/{idPresupuesto}',function($idPresupuesto){
    $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->where('tUsuario_idUsuario', '=', Auth::user()->id)
    ->first();


    $presupuesto = Presupuesto::find($idPresupuesto);

    $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

    $presupuestoPartida = DB::table('tpresupuesto_tpartida')
    ->join('tpresupuesto', 'idPresupuesto', '=', 'tPresupuesto_idPresupuesto')
    ->join('tpartida', 'idPartida', '=', 'tPartida_idPartida')
    ->join('tcoordinacion', 'idCoordinacion', '=', 'tCoordinacion_idCoordinacion')
    ->join('tusuario_tcoordinacion','tCoordi_idCoordinacion', '=' , 'idCoordinacion')
    ->select('codPartida','vNombrePartida','idPartida','id','tPresupuesto_idPresupuesto','tpresupuesto_tpartida.iPresupuestoInicial',
    'tpresupuesto_tpartida.iPresupuestoModificado','tpresupuesto_tpartida.iGasto', 'tpresupuesto_tpartida.iReserva','tpresupuesto_tpartida.iSaldo')
    ->where('tUsuario_idUsuario', '=' , Auth::user()->id)
    ->where('idPresupuesto', '=', $presupuesto->idPresupuesto)
    ->where('anno','=',$config->iValor)
    ->orderBy('codPartida')
    ->get();
    return view('reporte/reporteGasto', ['presupuestoPartida' => $presupuestoPartida, 'coordinacion' => $coordinacion, 'presupuesto' => $presupuesto]);
});



Route::get('/partida/informe-gastos/{idPartda}',function($idPartda){
    $presupuesto_partida = Presupuesto_Partida::find($idPartda);

    $presupuesto = Presupuesto::find($presupuesto_partida->tPresupuesto_idPresupuesto);

    $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

    $partida = Partida::find($presupuesto_partida->tPartida_idPartida);

    return view('reporte/reportePartida', ['presupuesto_partida' => $presupuesto_partida, 'coordinacion' => $coordinacion, 'presupuesto' => $presupuesto, 'partida' => $partida]);
});

Route::get('/presupuesto/informe-fin-gestion/{idPresupuesto}',function($idPresupuesto){
    $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->where('tUsuario_idUsuario', '=', Auth::user()->id)
    ->first();

    $presupuesto = Presupuesto::find($idPresupuesto);

    $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

    $presupuestoPartida = Presupuesto_Partida::all()->where('tPresupuesto_idPresupuesto', $presupuesto->idPresupuesto);

    return view('reporte/reporteFinGestion', ['presupuestoPartida' => $presupuestoPartida, 'coordinacion' => $coordinacion, 'presupuesto' => $presupuesto]);
});


//Factura routes...
Route::resource('transaccion', 'FacturaController');
Route::get('transaccion/create', 'FacturaController@create');
Route::post('transaccion/{transaccion}/delete', 'FacturaController@destroy');


//Rutas de usuarios
Route::resource('usuario', 'UsuarioController');
Route::post('usuario/{usuario}/put', 'UsuarioController@update');
Route::post('usuario/{usuario}/cambiar', 'UsuarioController@cambiarRol');
Route::post('usuario/rol/{usuario}', 'UsuarioController@store');
Route::get('usuario/{usuario}/coordinacion', 'UsuarioController@editarCoordinacion');
Route::post('usuario/{usuario}/coordinacion/put', 'UsuarioController@cambiarCoordinacion');


// Rutas de autenticacion
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Turas de Registro...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Rutas de reestablecimiento de contraseña...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


//angular model routes
Route::get('/partidas', function () {
    $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->where('tUsuario_idUsuario', '=', Auth::user()->id)
    ->first();

    $p = Presupuesto_Partida::all();

    foreach ($p as $x) {
        $x->calcularReserva();
        $x->calcularGasto();
        $x->calcularSaldo();
    }

    $presupuestoPartida = DB::table('tpresupuesto_tpartida')
    ->join('tpresupuesto', 'idPresupuesto', '=', 'tPresupuesto_idPresupuesto')
    ->join('tpartida', 'idPartida', '=', 'tPartida_idPartida')
    ->join('tcoordinacion', 'idCoordinacion', '=', 'tCoordinacion_idCoordinacion')
    ->join('tusuario_tcoordinacion','tCoordi_idCoordinacion', '=' , 'idCoordinacion')
    ->select('idCoordinacion','anno','vNombreCoordinacion','vNombrePresupuesto','codPartida','vNombrePartida',
    'idPartida','id','tPresupuesto_idPresupuesto','tpresupuesto_tpartida.iPresupuestoInicial',
    'tpresupuesto_tpartida.iPresupuestoModificado','tpresupuesto_tpartida.iGasto','tpresupuesto_tpartida.iReserva', 'tpresupuesto_tpartida.iSaldo')
    ->where('tUsuario_idUsuario', '=' , Auth::user()->id)
    ->where('anno','=',$config->iValor)
    ->orderBy('codPartida')
    ->get();
    
    return $presupuestoPartida;	
});	

Route::get('/transaccionesReporte', function () {
    $transacciones = Factura::all();
    return $transacciones;
});

Route::get('/reservas', function () {
    $reservas = DB::table('treserva')->where('deleted_at', null)->get();
    return $reservas;
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
    ->where('tUsuario_idUsuario', '=', Auth::user()->id)
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
        $config = DB::table('tconfiguracion')
    ->select('iValor')
    ->where('vConfiguracion','=','Periodo')
    ->where('tUsuario_idUsuario', '=', Auth::user()->id)
    ->first();
   
    $transferencias = DB::select('
        SELECT * 
        FROM 
        (
        SELECT  
            `idTransferencia` as `codTransDe`, 
            `vDocumento` as `docDe`, 
            `iMontoTransferencia` as `monTransDe`, 
            `idCoordinacion` as `idCoorDe`, 
            `vNombreCoordinacion` as `nomCoorDe`, 
            `vNombrePresupuesto` as `nomPresDe`, 
            `anno` as `annoDe`, 
            `codPartida` as `codParDe` 
        FROM 
            ttranferencia_partida, 
            tcoordinacion, 
            tpartida, 
            tpresupuesto, 
            tpresupuesto_tpartida 
        WHERE 
            tPresupuestoPartidaDE = id 
            AND tPresupuesto_idPresupuesto = idPresupuesto 
            AND tPartida_idPartida = idPartida 
            AND tCoordinacion_idCoordinacion = idCoordinacion 
            AND anno = '.$config->iValor.'
    ) t1 
    LEFT JOIN (
        SELECT 
            `idTransferencia` as `codTransA`, 
            `vDocumento` as `docA`, 
            `iMontoTransferencia` as `monTransA`, 
            `idCoordinacion` as `idCoorA`, 
            `vNombreCoordinacion` as `nomCoorA`, 
            `vNombrePresupuesto` as `nomPresA`, 
            `anno` as `annoA`, 
            `codPartida` as `codParA` 
        FROM 
            ttranferencia_partida, 
            tcoordinacion, 
            tpartida, 
            tpresupuesto, 
            tpresupuesto_tpartida 
        WHERE 
            tPresupuestoPartidaA = id 
            AND tPresupuesto_idPresupuesto = idPresupuesto 
            AND tPartida_idPartida = idPartida 
            AND tCoordinacion_idCoordinacion = idCoordinacion 
            AND anno = '.$config->iValor.'
    ) t2 ON t1.codTransDE = t2.codTransA');

    return $transferencias;
});


//Modificacion de la sintaxis de laravel blade
Blade::setContentTags('<%', '%>'); // for variables and all things Blade
Blade::setEscapedContentTags('[[', ']]'); // for escaped data