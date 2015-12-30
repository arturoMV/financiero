<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Coordinacion;
use Redirect;
class CoordinacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/coordinacion/coordinacion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/coordinacion/nuevaCoordinacion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coordinacion = Coordinacion::create(array(
            'idCoordinacion'=> $request->input('idCoordinacion'),
            'vNombreCoordinacion'=>$request->input('vNombreCoordinacion'),
            ));
        return view('/coordinacion/coordinacion');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coordinacion = Coordinacion::find($id);

        $presupuestos = $coordinacion->presupuestos()->orderby('idPresupuesto')->get();

        return view('/coordinacion/verCoordinacion',['coordinacion'=>$coordinacion],['presupuestos'=> $presupuestos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coordinacion = Coordinacion::find($id);

        return view('coordinacion/editarCoordinacion', ['coordinacion' => $coordinacion]);
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
        $coordinacion = Coordinacion::find($id);
        $coordinacion->idCoordinacion= $request->input('idCoordinacion');
        $coordinacion->vNombreCoordinacion=$request->input('vNombreCoordinacion');
        

        $coordinacion->save();

        $presupuestos = $coordinacion->presupuestos()->orderby('idPresupuesto')->get();

        return view('/coordinacion/verCoordinacion',['coordinacion'=>$coordinacion],['presupuestos'=> $presupuestos]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return Redirect::back()
            ->withErrors(['errors'=> 'No se edito la coordinación']);
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
        Coordinacion::where('idCoordinacion', '=', $id)->delete();

        return view('coordinacion/coordinacion');    
    }
}
