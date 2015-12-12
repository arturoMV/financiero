<?php

namespace App\Http\Controllers;

use App\Partida;
use DB;
use App\Coordinacion;
use App\Presupuesto;
use App\Presupuesto_Partida;
use App\Factura;
use Redirect;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('partida/partida',['mensaje'=>false,'error' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        

        return view('partida/nuevaPartida');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{

            $partida = new Partida;

            $partida->codPartida = $request->codPartida;
            $partida->vNombrePartida = $request->vNombrePartida;
            $partida->vDescripcion = $request->vDescripcion;
            

            $partida->save();

            return view('/partida/partida',['mensaje'=>true]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('/partida/nuevaPartida',
                ['presupuestos' => $presupuestos,
                'config' => $config])
                ->withErrors(['error', 'Error al insertar, ya existe una partida con ese identificador']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){


        $presupuesto_partida = Presupuesto_Partida::find($id);

        $partida = Partida::find($presupuesto_partida->tPartida_idPartida);

        $presupuesto = Presupuesto::find($presupuesto_partida->tPresupuesto_idPresupuesto);

        $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

        $transacciones = Factura::all()
        ->where('tPartida_idPartida',$presupuesto_partida->id);
        $presupuesto_partida->presupuestoModificado();

        $presupuesto_partida->calcularSaldo();
        $presupuesto_partida->calcularGasto();

        return view('partida/verPartida',['presupuesto_partida' => $presupuesto_partida,
         'partida' => $partida,
         'transacciones' => $transacciones,
         'presupuesto' => $presupuesto,
         'coordinacion' => $coordinacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partida = Partida::find($id);
       
        return view('partida/editarPartida', ['partida' => $partida,'mensaje'=>false]);
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

            $partida = Partida::find($id);

            $partida->codPartida = $request->codPartida;
            $partida->vNombrePartida = $request->vNombrePartida;
            $partida->vDescripcion = $request->vDescripcion;
            
            $partida->save();

            return view('partida/editarPartida', ['partida' => $partida,'mensaje'=>"false"]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return Redirect::back()
            ->withErrors(['errors'=> 'Error al editar los datos de la partida']);
        

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
            $partida = Partida::find($id);
            $partida->forceDelete();

            return view('partida/partida', ['partida' => $partida,'mensaje'=>false]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $partida = Partida::find($id);

        return Redirect::back()
            ->withErrors(['errors'=> 'El partida esta asignada a un presupuesto']);
        
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agregarPartida($id)
    {   
        try{

            $presupuesto = Presupuesto::find($id);
            $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

            $partida = Partida::all();

            return view('presupuesto/agregarPresupuestoPartida',
                ['partida' => $partida,
                'coordinacion' => $coordinacion,
                'presupuesto' => $presupuesto, 
                'mensaje'=>null]);

        } catch(\Illuminate\Database\QueryException $ex){ 

        return Redirect::back()
            ->withErrors(['errors'=> 'Error al agregar la partida   ']);
        
        }

    }

        public function asignarPartida($id, Request $request)
    {   
        try{
            $presupuesto_partida = new Presupuesto_Partida;

            $presupuesto_partida->tPresupuesto_idPresupuesto = $id;
            $presupuesto_partida->tPartida_idPartida = $request->tPartida_idPartida;
            $presupuesto_partida->iPresupuestoInicial = $request->iPresupuestoInicial;
            $presupuesto_partida->iPresupuestoModificado = $request->iPresupuestoInicial;
            $presupuesto_partida->presupuestoModificado();
            $presupuesto_partida->calcularSaldo();
            $presupuesto_partida->calcularGasto();
            $presupuesto_partida->save();

            $presupuesto = Presupuesto::find($id);
            $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

            $partida = Partida::all();

            return view('presupuesto/agregarPresupuestoPartida',
                ['partida' => $partida,
                'coordinacion' => $coordinacion,
                'presupuesto' => $presupuesto, 
                'mensaje'=>false]);

        } catch(\Illuminate\Database\QueryException $ex){ 

        return Redirect::back()
            ->withErrors(['errors'=> 'El partida esta asignada a un presupuesto']);
        
        }

    }



}
