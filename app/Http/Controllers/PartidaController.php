<?php

namespace App\Http\Controllers;

use App\Partida;
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
        $partida = Partida::all();

        return view('partida', ['partida' => $partida]);
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
        $partida = Partida::create(array(
                'idPartida'=> $request->input('idPartida'),
                'idPresupuesto'=>$request->input('idPresupuesto'),
                'estado'=>$request->input('estado'),
                'saldo'=> $request->input('saldo'),
                'descripcion'=> $request->input('descripcion'),
            ));
        $partida = Partida::all();

        return view('partida', ['partida' => $partida]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $partida = Partida::find($id);

        return view('partida/verPartida', ['partida' => $partida]);
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

        return view('partida/editarPartida', ['partida' => $partida]);
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
         $partida = Partida::find($id);

         $partida->idPartida= $request->input('idPartida');
         $partida->idPresupuesto=$request->input('idPresupuesto');
         $partida->estado=$request->input('estado');
         $partida->saldo=$request->input('saldo');
         $partida->descripcion=$request->input('descripcion');

         $partida->save();

        return view('partida/verPartida', ['partida' => $partida]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $partida  = Partida::where('id', '=', $id)->delete();

        $partida = Partida::all();

        return view('partida', ['partida' => $partida]);
    }
}
