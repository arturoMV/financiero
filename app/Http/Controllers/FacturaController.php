<?php

namespace App\Http\Controllers;

use App\Partida;
use App\Factura;
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
        $partida = Partida::find($id);

        $numFactura = DB::table('tfactura')
        ->max('idFactura');

        if($numFactura == null){
            $ret  = 1;
        }else{
            $numFactura++;
        }

        return view('factura',['partida'=>$partida,'numFactura' =>$numFactura]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $facturaid = DB::table('tfactura')->insertGetId([
            'tPartida_idPartida' => $request->tPartida_idPartida,
            'vTipoFactura' => $request->vTipoFactura,
            'dFechaFactura' => $request->dFechaFactura,
            'vDescripcionFactura' => $request->vDescripcionFactura,
            'iMontoFactura' => $request->iMontoFactura
            ]);
       
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
            if($count > 6){
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
        return 'correcto';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    $partida = Partida::find($id);

    $numFactura = DB::table('tfactura')
    ->max('idFactura');

    if($numFactura == null){
        $ret  = 1;
    }else{
        $numFactura++;
    }

    return view('factura',['partida'=>$partida,'numFactura' =>$numFactura]);
        
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
