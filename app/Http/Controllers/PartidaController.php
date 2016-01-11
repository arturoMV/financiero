<?php

namespace App\Http\Controllers;

use App\Partida;
use DB;
use App\Coordinacion;
use App\Presupuesto;
use App\Presupuesto_Partida;
use App\Factura;
use App\User;
use Redirect;
use Auth;
use App\Transferencia;

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
        return view('partida/partida',['mensaje'=>null,'error' => true]);
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

            return view('/partida/partida',['mensaje'=>'Se agrego una nueva partida. Ahora puede agregarla a un presupuesto']);
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
        ->where('tPartida_idPartida',$presupuesto_partida->id)
        ->where('deleted_at', null);
        $presupuesto_partida->presupuestoModificado();
        $presupuesto_partida->calcularReserva();
        $presupuesto_partida->calcularGasto();
        $presupuesto_partida->calcularSaldo();


        $transferenciasA = Transferencia::all()->where('tPresupuestoPartidaA', $presupuesto_partida->id);
        $transferenciasDe = Transferencia::all()->where('tPresupuestoPartidaDe', $presupuesto_partida->id);



        return view('partida/verPartida',['presupuesto_partida' => $presupuesto_partida,
         'partida' => $partida,
         'transacciones' => $transacciones,
         'presupuesto' => $presupuesto,
         'coordinacion' => $coordinacion,
         'transferenciasA' => $transferenciasA,
         'transferenciasDe' => $transferenciasDe]);
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

        return view('partida/editarPartida', ['partida' => $partida,'mensaje'=>null]);
    }

    public function editPresupuestoPartida($id)
    {
        $presupuesto_partida = Presupuesto_Partida::find($id);

        $partida = Partida::find($presupuesto_partida->tPartida_idPartida);

        $presupuesto = Presupuesto::find($presupuesto_partida->tPresupuesto_idPresupuesto);

        $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

    
        return view('partida/editarPresupuestoPartida', ['partida' => $partida,'coordinacion' => $coordinacion, 'presupuesto' => $presupuesto,
            'presupuesto_partida' => $presupuesto_partida,'mensaje'=>null]);
    }

    public function updatePresupuestoPartida(Request $request, $id)
    {
        try{
            $presupuesto_partida = Presupuesto_Partida::find($id);
            $presupuesto_partida->iPresupuestoInicial = $request->iPresupuestoInicial;
            $presupuesto_partida->save();

            
            $partida = Partida::find($presupuesto_partida->tPartida_idPartida);
            $presupuesto = Presupuesto::find($presupuesto_partida->tPresupuesto_idPresupuesto);
            $coordinacion = Coordinacion::find($presupuesto->tCoordinacion_idCoordinacion);

        
            return view('partida/editarPresupuestoPartida', 
                ['partida' => $partida,
                'coordinacion' => $coordinacion,
                 'presupuesto' => $presupuesto,
                'presupuesto_partida' => $presupuesto_partida,
                'mensaje'=> 'Se modifico el monto presupuestado de la partida']);

        } catch(\Illuminate\Database\QueryException $ex){ 
            return Redirect::back()
            ->withErrors(['errors'=> 'Error al editar los datos de la partida']);
        }
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

            return view('partida/editarPartida', ['partida' => $partida,'mensaje'=>'Se elimino una partida del presupuesto']);
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

    public function destroyPresupuestoPartida($id)
    {   
        try{
           // return 'asd';
            $partida = Presupuesto_Partida::find($id);
            $partida->forceDelete();

            return view('partida/partida', ['partida' => $partida,'mensaje'=>"false"]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $partida = Partida::find($id);

        return Redirect::back()
            ->withErrors(['errors'=> 'El partida posee facturas o transferencias']);
        
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

    public function transferencia(Request $request)
    {
        try{
            $presupuesto_partidaDe = Presupuesto_Partida::find($request->partidaDe);
            $presupuesto_partidaA = Presupuesto_Partida::find($request->partidaA);
            $usuario = Auth::user();
               //  return dd($presupuesto_partidaDe);
            if($presupuesto_partidaDe != null && $presupuesto_partidaA != null){
                if ($request->iMontoTransferencia <= $presupuesto_partidaDe->iSaldo 
                    && $request->iMontoTransferencia) {
                    $transferencia = new Transferencia;
                    $transferencia->tPresupuestoPartidaDe = $presupuesto_partidaDe->id;
                    $transferencia->tPresupuestoPartidaA = $presupuesto_partidaA->id;
                    $transferencia->vDocumento = $request->vDocumento;
                    $transferencia->tUsuario_idUsuario = $usuario->id;
                    $transferencia->iMontoTransferencia = $request->iMontoTransferencia;

                    $transferencia->save();
                    //return $transferencia->idTransferencia;


                    $partidaDe = Partida::find($presupuesto_partidaDe->tPartida_idPartida);
                    $presupuestoDe = Presupuesto::find($presupuesto_partidaDe->tPresupuesto_idPresupuesto);
                    $coordinacionDe = Coordinacion::find($presupuestoDe->tCoordinacion_idCoordinacion);

                    $partidaA = Partida::find($presupuesto_partidaA->tPartida_idPartida);
                    $presupuestoA = Presupuesto::find($presupuesto_partidaA->tPresupuesto_idPresupuesto);
                    $coordinacionA = Coordinacion::find($presupuestoA->tCoordinacion_idCoordinacion);

                    $presupuesto_partidaDe->presupuestoModificado();
                    $presupuesto_partidaDe->calcularSaldo();
                    $presupuesto_partidaDe->calcularGasto();
                    $presupuesto_partidaDe->save();

                    $presupuesto_partidaA->presupuestoModificado();
                    $presupuesto_partidaA->calcularGasto();
                    $presupuesto_partidaA->calcularSaldo();

                    $presupuesto_partidaA->save();


                    return view('/transferencia/verTransferencia', ['presupuesto_partidaDe' => $presupuesto_partidaDe,
                            'presupuesto_partidaA' => $presupuesto_partidaA, 
                            'coordinacionDe' => $coordinacionDe, 
                            'presupuestoDe' => $presupuestoDe, 
                            'partidaDe' => $partidaDe, 
                            'coordinacionA' => $coordinacionA,
                            'presupuestoA' => $presupuestoA,
                            'partidaA' => $partidaA,
                            'transferencia' => $transferencia,
                            'usuario' => $usuario]);
                }else{
                    return Redirect::back()
                    ->withErrors(['errors'=> 'Verifique que el monto de transferencia sea menor o 
                        igual al saldo de la partida de la cual esta realizando la transferencia']);
                 }
            } else {
                return Redirect::back()
                ->withErrors(['errors'=> 'Verifique que el monto de transferencia sea menor o 
                    igual al saldo de la partida de la cual esta realizando la transferencia']);
            }
        }catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()
            ->withErrors(['errors'=> 'El presupuesto tiene partidas asignadas']);
        }
    }

    public function verTransferencia($id)
    {   
       try{
            $transferencia = Transferencia::find($id);
            if($transferencia == null){
                abort(404);
            }
            $presupuesto_partidaDe = Presupuesto_Partida::find($transferencia->tPresupuestoPartidaDe);
            $presupuesto_partidaA = Presupuesto_Partida::find($transferencia->tPresupuestoPartidaA);
            $usuario = User::find($transferencia->tUsuario_idUsuario);

            $partidaDe = Partida::find($presupuesto_partidaDe->tPartida_idPartida);
            $presupuestoDe = Presupuesto::find($presupuesto_partidaDe->tPresupuesto_idPresupuesto);
            $coordinacionDe = Coordinacion::find($presupuestoDe->tCoordinacion_idCoordinacion);

            $partidaA = Partida::find($presupuesto_partidaA->tPartida_idPartida);
            $presupuestoA = Presupuesto::find($presupuesto_partidaA->tPresupuesto_idPresupuesto);
            $coordinacionA = Coordinacion::find($presupuestoA->tCoordinacion_idCoordinacion);

            $presupuesto_partidaDe->presupuestoModificado();
            $presupuesto_partidaDe->calcularSaldo();
            $presupuesto_partidaDe->calcularGasto();
            $presupuesto_partidaDe->save();

            $presupuesto_partidaA->presupuestoModificado();
            $presupuesto_partidaA->calcularSaldo();
            $presupuesto_partidaA->calcularGasto();
            $presupuesto_partidaA->save();


            return view('/transferencia/verTransferencia', ['presupuesto_partidaDe' => $presupuesto_partidaDe,
                        'presupuesto_partidaA' => $presupuesto_partidaA, 
                        'coordinacionDe' => $coordinacionDe, 
                        'presupuestoDe' => $presupuestoDe, 
                        'partidaDe' => $partidaDe, 
                        'coordinacionA' => $coordinacionA,
                        'presupuestoA' => $presupuestoA,
                        'partidaA' => $partidaA,
                        'transferencia' => $transferencia,
                        'usuario' => $usuario]);

    }catch(Exception $e){
        //return abort(404);
    }
}



}
