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
        $presupuesto_partida = Presupuesto_Partida::find($id);

        $partida = Partida::find($presupuesto_partida->tPartida_idPartida);
        
        $presupuesto = Presupuesto::find($presupuesto_partida->tPresupuesto_idPresupuesto);
      //  return dd($presupuesto);
        $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);


        $presupuesto_partida->calcularSaldo();
        $presupuesto_partida->calcularGasto();
        $presupuesto_partida->presupuestoModificado();

        $numFactura = DB::table('tfactura')
        ->max('idFactura');

        if($numFactura == null){
            $ret  = 1;
        }else{
            $numFactura++;
        }

        return view('transaccion/nuevaTransaccion',
            ['presupuesto_partida'=>$presupuesto_partida,
            'partida'=>$partida,
            'presupuesto'=>$presupuesto,
            'coordinacion'=>$coordinacion,
            'numFactura' =>$numFactura]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if($request->iMontoFactura==0){
            return redirect()->back()->withErrors('No se puede agregar una transaccion sin monto');
        }else if($request->iSaldo<$request->iMontoFactura && $request->vTipoFactura == 'Pases anulacion'){
            return redirect()->back()->withErrors('El monto de la transaccion no puede ser mayor al saldo disponible de la partida');
        }

        $factura = new Factura;

        $factura->tPartida_idPartida = $request->tPartida_idPartida;
        $factura->vTipoFactura = $request->vTipoFactura;
        $factura->vDocumento = $request->vDocumento;        
        $factura->dFechaFactura = $request->dFechaFactura;
        $factura->vDescripcionFactura = $request->vDescripcionFactura;
        $factura->iMontoFactura = $request->iMontoFactura;

        $factura->save();

       
        $facturaid = $factura->idFactura;

        $input= $request->all();
        $count = 0;
        $linea = 0;
        $campo = 1;
        $detalle = "";
        $precio = "";
        $cantidad = ""; 
        $total = "";
        $salida = "";

        foreach($input as $in){
            if($count > 8){
                if($campo == 1){
                    $linea++;
                    $detalle = $in;
                }
                if($campo == 2){
                    $precio = $in;
                }
                if($campo == 3){
                    $cantidad = $in;
                }
                if($campo == 4){
                    $total = $in;
                    $factura = DB::table('tfacturadetalle')->insert([
                        'tFactura_idFactura' => $facturaid,
                        'iLinea' => $linea,
                        'vDetalle' => $detalle,
                        'iPrecio' => $precio,
                        'iCantidad' => $cantidad,
                        'iTotalLinea' => $total
                        ]);
                    $campo = 0;
                }
                $campo++;
            }
            $count++;
        }

        return $this->show($facturaid);

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
