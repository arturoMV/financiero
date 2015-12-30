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


class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/presupuesto/presupuesto');
    }

    /**
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
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

        return view('/presupuesto/presupuesto');
    } catch(\Illuminate\Database\QueryException $ex){ 
        return view('/presupuesto/nuevoPresupuesto',
            ['coordinaciones' => $coordinaciones,
            'config' => $config])
            ->withErrors(['error', 'Error al insertar, identificador duplicado']);

    }
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    try{

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

        return view('/presupuesto/presupuesto');
    }catch(\Illuminate\Database\QueryException $e){
        return Redirect::back()
            ->withErrors(['Error al modificar los datos'])
            ->withInput();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $presupuesto = Presupuesto::find($id);

            $presupuesto->forceDelete($id);

            return view('/presupuesto/presupuesto');
        }catch (\Illuminate\Database\QueryException $e) {

            return Redirect::back()
            ->withErrors(['errors'=> 'El presupuesto tiene partidas asignadas']);
        
        }
    }

    
}
