<?php

namespace App\Http\Controllers;

use App\Partida;
use App\Factura;
use App\Presupuesto_Partida;
use App\Presupuesto;
use App\Coordinacion;
use App\Factura_Detalle;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {


        return view('transaccion/nuevaTransaccion');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $input= $request->all();
        $count = 0;
        $campo = 1;
        $tipo =  $request->vTipoFactura;
        $documento = $request->vDocumento;        
        $fecha = $request->dFechaFactura;
        $descripcion = $request->vDescripcionFactura;

        foreach($input as $in){
            if($count > 4){
                if($campo == 1){
                    $partida = $in;
                }
                if($campo == 2){
                    $detalle = $in;
                }
                if($campo == 3){
                    $monto = $in;
                   $factura = DB::table('tfactura')->insert(
                    ['vTipoFactura' => $tipo,
                    'vDocumento' => $documento,
                    'dFechaFactura' => $fecha,
                    'vDescripcionFactura' => $descripcion,
                    'tPartida_idPartida' => $partida,
                    'vDetalleFactura' => $detalle, 
                    'iMontoFactura' => $monto]);
                    $campo = 0;
                }
                $campo++;
            }

            $count++;
        }

        return Factura::find($factura);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $factura = Factura::find($id);

            $detalles = DB::table('tfacturadetalle')
            ->join('tfactura', 'idFactura','=','tFactura_idFactura')
            ->select('iLinea','vDetalle','iPrecio','iCantidad','iTotalLinea')
            ->where('tFactura_idFactura',$id)
            ->get();

            $presupuesto_partida = Presupuesto_Partida::find($factura->tPartida_idPartida);

            $partida = Partida::find($presupuesto_partida->tPartida_idPartida);

            $presupuesto = Presupuesto::find($presupuesto_partida->tPresupuesto_idPresupuesto);

            $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

        $presupuesto_partida->calcularSaldo();
        $presupuesto_partida->calcularGasto();
        $presupuesto_partida->presupuestoModificado();

            return view('transaccion/verTransaccion',
                ['factura'=>$factura,
                'detalles'=>$detalles,
                'presupuesto_partida'=>$presupuesto_partida,
                'partida'=>$partida,
                'presupuesto'=>$presupuesto,
                'coordinacion'=>$coordinacion]); 
        }catch(\Illuminate\Database\QueryException $ex){ 
            return view('/transaccion/verTransaccion/');
        }       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
