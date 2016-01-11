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
use Redirect;

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
    public function create()
    {
        return view('transaccion/nuevaTransaccion', ['mensaje' => null]);   
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
        $listaFactura = []; 
        $listaPartida = [];


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

                    $factura = new Factura;

                    $factura->vTipoFactura =  $tipo;
                    $factura->vDocumento =  $documento;
                    $factura->dFechaFactura =  $fecha;
                    $factura->vDescripcionFactura =  $descripcion;
                    $factura->tPartida_idPartida =  $partida;
                    $factura->vDetalleFactura =  $detalle;
                    $factura->iMontoFactura =  $monto;

                    if(in_array($partida, $listaPartida)){
                        return redirect('transaccion/create')->withErrors('Solo se puede agregar una linea por Partida');
                    }
                    else{
                        array_push($listaPartida, $partida);
                    }

                    array_push($listaFactura, $factura);
                    $campo = 0;
                }
                $campo++;
            }
            $count++;
        }
      // return dd($listaPartida);

        $listaPartida;
        foreach ($listaFactura as $fac) {
           if($fac->vTipoFactura == 'Pase de Anulacion' || $fac->vTipoFactura == 'Cancelacion GECO'){
                $presupuesto_partida = Presupuesto_Partida::find($fac->tPartida_idPartida);

                array_push($listaPartida, $presupuesto_partida);

                if($presupuesto_partida->iReserva < $fac->iMontoFactura){
                    return redirect('transaccion/create')->withErrors('El monto de una partida excede el limite posible');
                }
           }else{
                $presupuesto_partida = Presupuesto_Partida::find($fac->tPartida_idPartida);

                array_push($listaPartida, $presupuesto_partida);

                if($presupuesto_partida->iSaldo < $fac->iMontoFactura){
                    return redirect('transaccion/create')->withErrors('El monto de una partida excede el limite posible');
                }
           }
            
        }

        foreach ($listaFactura as $fac) {
            $fac->save();
            if($tipo == "Solicitud GECO"){
                DB::table('treserva')->insert([
                    'vReserva' => $fac->idFactura,
                    'vDocumento' => $fac->vDocumento,
                    'vDetalle' => $fac->vDetalleFactura,
                    'iMontoFactura' => $fac->iMontoFactura,
                    'tPartida_idPartida' => $fac->tPartida_idPartida]);
            }

            if($tipo == "Pases Adicionales"){
                DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)
                ->increment('iMontoFactura', $fac->iMontoFactura);
                $reserva = DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->first();
                $fac->vDetalleFactura = 'Aumento en la reserva '.$reserva->vDocumento.' '.$reserva->vDetalle;
            }

            if($tipo == "Pases Anulacion"){
                DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->decrement('iMontoFactura', $fac->iMontoFactura);
                $reserva = DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->first();
                $fac->vDetalleFactura = 'Reduccion en la reserva '.$reserva->vDocumento.' '.$reserva->vDetalle;
            }
            if($tipo == "Cancelacion GECO"){
                $reserva = DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->first();
                DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->delete();
                $fac->vDetalleFactura = 'Cancelacion de la reserva '.$reserva->vDocumento.' '.$reserva->vDetalle;   
            }

            $fac->save();
          
        }

        return redirect('transaccion/create')->with('mensaje','s');        
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
            return view('transaccion/verTransaccion/');
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
