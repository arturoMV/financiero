<?php

namespace App\Http\Controllers;

use App\Partida;
use DB;
use App\Presupuesto;
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
        return view('partida/partida');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $config = DB::table('tConfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','=','Periodo')
        ->first();

        $presupuestos = Presupuesto::all()
        ->where('anno', $config->iValor);

        return view('partida/nuevaPartida', ['presupuestos' => $presupuestos, 'config' => $config]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            if($request->tPresupuesto_idPresupuesto == 0){
                return Redirect::back()
                ->withErrors(['error', 'Debe seleccionar un Presupuesto válido'])
                ->withInput();
            }
             $config = DB::table('tConfiguracion')
            ->select('iValor')
            ->where('vConfiguracion','=','Periodo')
            ->first();

            $presupuestos = Presupuesto::all()
            ->where('anno', $config->iValor);

            $partida = new Partida;

            $partida->idPartida = $request->idPartida;
            $partida->tPresupuesto_idPresupuesto = $request->tPresupuesto_idPresupuesto;
            $partida->tPresupuesto_anno = $request->tPresupuesto_anno;
            $partida->vNombrePartida = $request->vNombrePartida;
            $partida->iPresupuestoInicial = $request->iPresupuestoInicial;
            $partida->iPresupuestoModificado = $request->iPresupuestoModificado;
            $partida->gasto = 0;
            $partida->saldo = $request->saldo;

            $partida->save();

            return view('/partida/partida');
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
        $partida = Partida::find($id);
        $partida->calcularSaldo();
        $presupuesto = $partida->presupuesto;

        return view('partida/verPartida', ['partida' => $partida, 'presupuesto' => $presupuesto]);
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
        
        $config = DB::table('tConfiguracion')
            ->select('iValor')
            ->where('vConfiguracion','=','Periodo')
            ->first();
       
        $presupuestos = Presupuesto::all()
        ->where('anno', $config->iValor);       

        return view('partida/editarPartida', ['partida' => $partida, 'presupuestos' => $presupuestos]);
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
            if($request->tPresupuesto_idPresupuesto == 0){
                return Redirect::back()
                ->withErrors(['error', 'Debe seleccionar un Presupuesto válido'])
                ->withInput();
            }
             $config = DB::table('tConfiguracion')
            ->select('iValor')
            ->where('vConfiguracion','=','Periodo')
            ->first();

            $presupuestos = Presupuesto::all()
            ->where('anno', $config->iValor);

            $partida = Partida::find($id);

            $partida->idPartida = $request->idPartida;
            $partida->tPresupuesto_idPresupuesto = $request->tPresupuesto_idPresupuesto;
            $partida->tPresupuesto_anno = $request->tPresupuesto_anno;
            $partida->vNombrePartida = $request->vNombrePartida;
            $partida->iPresupuestoInicial = $request->iPresupuestoInicial;
            $partida->iPresupuestoModificado = $request->iPresupuestoModificado ;


            $partida->save();

            return view('/partida/partida');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('/partida/$id/edit',
                ['presupuestos' => $presupuestos,
                'partida' => $partida])
                ->withErrors(['error', 'Error al insertar, ya existe una partida con ese identificador']);

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
        $partida  = Partida::where('idPartida', '=', $id)->delete();

        return view('partida/partida', ['partida' => $partida]);
    }
}
