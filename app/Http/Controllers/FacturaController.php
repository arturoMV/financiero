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
use Auth;

class FacturaController extends Controller
{
   

    /**
     * Muestra el formulario para creear una nueva factura
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   if(Auth::user()){
        $anno = DB::table('tconfiguracion')
            ->select('iValor')
            ->where('vConfiguracion','Periodo')
            ->where('tUsuario_idUsuario', Auth::user()->id)
            ->first();

        return view('transaccion/nuevaTransaccion', ['mensaje' => null, 'anno' => $anno]);  
        } 
        return view('layouts/master');
    }

    /**
     * Guarda una nueva factura creada
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

                    if($monto <= 0){
                        return redirect('transaccion/create')->withErrors('El monto de una transacción no puede ser igual a 0');

                    }
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
      //  return dd($listaFactura);
        foreach ($listaFactura as $fac) {
           if($fac->vTipoFactura == 'Pases Anulacion' || $fac->vTipoFactura == 'Cancelacion GECO'){
                $presupuesto_partida = Presupuesto_Partida::find($fac->tPartida_idPartida);

                array_push($listaPartida, $presupuesto_partida);

                $reserva = DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->first();
                //return dd($reserva); 
                if($reserva == null){
                     return redirect('transaccion/create')->withErrors('Debe seleccionar una reserva válida');
                } 
                if($reserva->iMontoFactura < $fac->iMontoFactura){
                    return redirect('transaccion/create')->withErrors('El monto de una partida excede el limite posible');
                }
           }else{
                $presupuesto_partida = Presupuesto_Partida::find($fac->tPartida_idPartida);

                array_push($listaPartida, $presupuesto_partida);

                if($presupuesto_partida->iSaldo < $fac->iMontoFactura){
                    return redirect('transaccion/create')->withErrors('El monto de una partida excede el limitesd posible');
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
                    'tPartida_idPartida' => $fac->tPartida_idPartida,]);
                $fac->tReserva_vReserva = $fac->idFactura;
            }

            if($tipo == "Pases Adicionales"){
                $fac->tReserva_vReserva = $fac->vDetalleFactura;
               // DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)
                //->increment('iMontoFactura', $fac->iMontoFactura);
                $reserva = DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->first();
                $fac->vDetalleFactura = 'Aumento en la reserva '.$reserva->vDocumento.' '.$reserva->vDetalle;
            }

            if($tipo == "Pases Anulacion"){
                $fac->tReserva_vReserva = $fac->vDetalleFactura;
              //  DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->decrement('iMontoFactura', $fac->iMontoFactura);
                $reserva = DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->first();
                $fac->vDetalleFactura = 'Reduccion en la reserva '.$reserva->vDocumento.' '.$reserva->vDetalle;
            }
            if($tipo == "Cancelacion GECO"){
                $fac->tReserva_vReserva = $fac->vDetalleFactura;
                $date = date('Y/m/d h:i:s');
                $reserva = DB::table('treserva')->where('vReserva', $fac->vDetalleFactura)->first();
              //  DB::table('treserva')->update('deleted_at', $date)->where('vReserva', $fac->vDetalleFactura);
                $fac->vDetalleFactura = 'Cancelacion de la reserva '.$reserva->vDocumento.' '.$reserva->vDetalle;   
            }

            $fac->save();
            $this->calcularReserva();
            
        }


        return redirect('transaccion/create')->with('mensaje','s');        
    }


    /**
     * Calcula la reserva las partidas
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function calcularReserva()
    {
        $reservas = DB::table('treserva')->get();

        foreach ($reservas as $reserva) {
   
            $solicitud = DB::table('tfactura')
            ->select('iMontoFactura')
            ->where('vTipoFactura','Solicitud GECO')
            ->where('deleted_at',null)
            ->where('tReserva_vReserva', $reserva->vReserva)->get();

            $adicionales = DB::table('tfactura')
            ->select('iMontoFactura')
            ->where('vTipoFactura','Pases Adicionales')
            ->where('deleted_at',null)
            ->where('tReserva_vReserva',$reserva->vReserva)->get();
            
            $anulaciones = DB::table('tfactura')
            ->select('iMontoFactura')
            ->where('vTipoFactura','Pases Anulacion')
            ->where('deleted_at',null)
            ->where('tReserva_vReserva',$reserva->vReserva)->get();
            
            $cancelaciones = DB::table('tfactura')
            ->select('iMontoFactura')
            ->where('vTipoFactura','Cancelacion GECO')
            ->where('tReserva_vReserva', $reserva->vReserva)
            ->where('deleted_at',null)
            ->get();

            $montoReserva = 0;
            
            foreach ($solicitud as $s) {
                $montoReserva = $montoReserva + $s->iMontoFactura;                
            }

            foreach ($adicionales as $a) {
                $montoReserva = $montoReserva + $a->iMontoFactura;                
            }
            foreach ($anulaciones as $a) {
                $montoReserva = $montoReserva - $a->iMontoFactura;                
            }
            
            foreach ($cancelaciones as $c) {
                $montoReserva = $montoReserva - $c->iMontoFactura;                
            }

            DB::table('treserva')->where('vReserva', $reserva->vReserva)
            ->update(['iMontoFactura'=> $montoReserva]);

            $reserva =  DB::table('treserva')->where('vReserva', $reserva->vReserva)->first();
           // return dd($reserva);
            if($reserva->iMontoFactura <= 0){
                DB::table('treserva')->where('vReserva', $reserva->vReserva)->delete();
            }


        }
    }


    /**
     * Elimina una factura en especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factura = Factura::find($id);


        if($factura->vTipoFactura ==   'Solicitud GECO'){
            $facturas = Factura::all()->where('tReserva_vReserva',$factura->tReserva_vReserva);
            foreach ($facturas as $fac) {
                $fac->deleted_by = Auth::user()->id;
                $fac->delete();            }
        }else{
            $factura->deleted_by = Auth::user()->id;
            $factura->delete();
        }

        $this->calcularReserva();

        return redirect('/partida/'.$factura->tPartida_idPartida);
    }
}
