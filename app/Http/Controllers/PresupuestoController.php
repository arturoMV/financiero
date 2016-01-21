<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Coordinacion;
use App\Presupuesto;
use App\Presupuesto_Partida;
use App\Partida;
use Redirect;
use DB;
use Auth;


class PresupuestoController extends Controller
{
    /**
     * Muestra una lista de presupuestos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if(Auth::user()){
        $anno = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','Periodo')
        ->where('tUsuario_idUsuario', Auth::user()->id)
        ->first();
        return view('/presupuesto/presupuesto', ['anno' => $anno]);
        }else{
            return view('/layouts/master');
        }
    }

    /**
     * Muestra el formulario para crear un presupuesto
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coordinaciones = Coordinacion::all();

        $config = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','Periodo')
        ->first();

        return view('presupuesto/nuevoPresupuesto',['coordinaciones' => $coordinaciones],['config' => $config]);
    }

    /**
     * Guarda un nuevo presupuesto creado
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if(Auth::user()){
            
        if($request->tCoordinacion_idCoordinacion ==0){
            return Redirect::back()
            ->withErrors(['error', 'Debe seleccionar una Coordinacion válida'])
            ->withInput();
        }
        $coordinaciones = Coordinacion::all();
        
        $config = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','Periodo')
        ->first();
        $presupueto = new Presupuesto;


        $presupueto->idPresupuesto = $request->idPresupuesto;
        $presupueto->anno = $request->anno;
        $presupueto->tCoordinacion_idCoordinacion = $request->tCoordinacion_idCoordinacion;
        $presupueto->vNombrePresupuesto = $request->vNombrePresupuesto;
        $presupueto->iPresupuestoInicial = 0;
        $presupueto->iPresupuestoModificado = 0;

        $presupueto->save();

        $anno = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','Periodo')
        ->where('tUsuario_idUsuario', Auth::user()->id)
        ->first();

        return view('/presupuesto/presupuesto', ['anno' => $anno]);
        }else{
            return view('layouts/master');
        }
    } catch(\Illuminate\Database\QueryException $ex){ 
        return view('/presupuesto/nuevoPresupuesto',
            ['coordinaciones' => $coordinaciones,
            'config' => $config])
            ->withErrors(['error', 'Error al insertar, identificador duplicado']);

    }
    }

    /**
     * Muestra un presupuesto especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $presupuesto = Presupuesto::find($id);
        $presupuesto->calcularPresupuestoInicial();
        $presupuesto->calcularPresupuestoModificado();
        $presupuesto->calcularGasto();
        $presupuesto->calcularReserva();
        $presupuesto->calcularSaldo();


        $partidas = $presupuesto->partidas;

        foreach ($partidas as $partida) {
            $partida->presupuestoModificado();
            $partida->calcularSaldo();  
            $partida->calcularSaldo();  
        }
        $coordinacion = Presupuesto::find($id)->coordinacion;
        return view('/presupuesto/verPresupuesto',['presupuesto' => $presupuesto],['coordinacion' => $coordinacion, 'partidas' => $partidas]);
    }

    /**
     * Muestra un formulario para editar un presupuesto especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presupuesto = Presupuesto::find($id);
        $coordinaciones = Coordinacion::all();

        return view('/presupuesto/editarPresupuesto',['presupuesto' => $presupuesto], ['coordinaciones' => $coordinaciones]);
    }
    /**
     * Modifica un presupuesto especifico
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    try{
        if(Auth::user()){

        if($request->tCoordinacion_idCoordinacion ==0){
            return Redirect::back()
            ->withErrors(['error', 'Debe seleccionar una Coordinacion válida'])
            ->withInput();
        }
        $coordinaciones = Coordinacion::all();
        
        $config = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','Periodo')
        ->first();

        $presupueto = Presupuesto::find($id);

        $presupueto->anno = $request->anno;
        $presupueto->tCoordinacion_idCoordinacion = $request->tCoordinacion_idCoordinacion;
        $presupueto->vNombrePresupuesto = $request->vNombrePresupuesto;

        $presupueto->save();

        $anno = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','Periodo')
        ->where('tUsuario_idUsuario', Auth::user()->id)
        ->first();

        return view('/presupuesto/presupuesto', ['anno' => $anno]);
        }else{
            return view('layouts/master');
        }
    }catch(\Illuminate\Database\QueryException $e){
        return Redirect::back()
            ->withErrors(['Error al modificar los datos'])
            ->withInput();
    }
    }

    /**
     * Elimina un presupuesto especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(Auth::user()){
                $presupuesto = Presupuesto::find($id);

                $presupuesto->forceDelete($id);

                $anno = DB::table('tconfiguracion')
                ->select('iValor')
                ->where('vConfiguracion','Periodo')
                ->where('tUsuario_idUsuario', Auth::user()->id)
                ->first();
                return view('/presupuesto/presupuesto', ['anno' => $anno]);

            }else{
                return view('layouts/master');
            }
        }catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()
            ->withErrors(['errors'=> 'El presupuesto tiene partidas asignadas']);
        }
    }

    
}
