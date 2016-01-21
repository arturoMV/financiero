<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Coordinacion;
use Redirect;
use DB;
use App\Presupuesto;
use Auth;
class CoordinacionController extends Controller
{
    /**
     * Muestra una lista de las coordinaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/coordinacion/coordinacion', ['mensaje'=> null]);
    }

    /**
     * Muestra el formulario para crear una coordinacion
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/coordinacion/nuevaCoordinacion');
    }

    /**
     * Guarda una nueva coordinacion creada
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   try {
        
        $coordinacion = Coordinacion::create(array(
            'idCoordinacion'=> $request->input('idCoordinacion'),
            'vNombreCoordinacion'=>$request->input('vNombreCoordinacion'),
            ));

        DB::table('tusuario_tcoordinacion')->insert(
                ['tUsuario_idUsuario' => Auth::user()->id , 'tCoordi_idCoordinacion' => $request->input('idCoordinacion')]);
            
        return view('/coordinacion/coordinacion', ['mensaje' =>'Se agrego una nueva Coordinacion']);
        } catch (\Illuminate\Database\QueryException $ex) {
        return view('/coordinacion/nuevaCoordinacion',['errors' => 'Esa Unidad Ejecutora ya existe']);

        }
    }

    /**
     * Muestra una coordinacion especifica
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
     * Muestra el formulario para editar una coordinacion especifica
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
     * Modifica una coordninacion especifica.
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
            $coordinacion = Coordinacion::find($id);
            return view('coordinacion/editarCoordinacion', ['coordinacion' => $coordinacion, 'errors'=>'No se edito la coordinacion']);
        }    
    }

    /**
     * Elimina una coordinacion especifica
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try{

            $presupuestos = Presupuesto::all()
            ->where('tCoordinacion_idCoordinacion', $id);
            //dd(count($presupuestos));
            if(count($presupuestos) <= 0){
            DB::table('tusuario_tcoordinacion')
            ->where('tCoordi_idCoordinacion', $id)
            ->delete();

            Coordinacion::where('idCoordinacion', '=', $id)->forceDelete();
            $mensaje=[];
            array_push($mensaje , 'Se elimino la Unidad Ejecutora');
            }else{
                $coordinacion = Coordinacion::find($id);
                return view('coordinacion/editarCoordinacion', ['coordinacion' => $coordinacion, 'errors'=>'La Unidad Ejecutora seleccionada tiene un presupuesto asignado']);
            }

            return redirect('/coordinacion')->with($mensaje); 
        } catch(\Illuminate\Database\QueryException $ex){ 
            $coordinacion = Coordinacion::find($id);
            return view('coordinacion/editarCoordinacion', ['coordinacion' => $coordinacion, 'errors'=>'La Unidad Ejecutora seleccionada tiene un presupuesto asignado']);
        }
    }
}
