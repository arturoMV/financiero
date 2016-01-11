<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Redirect;
use App\Coordinacion;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
       
        return view('usuario/usuario',['usuarios', $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRespaldo()
    {
        return view('config/respaldo');
    }

    public function respaldo()
    {
        define("BACKUP_PATH", "/var/www/html/");

    $server_name   = "localhost";
    $username      = "root";
    $password      = "1234";
    $database_name = "presupuestooaf";
    $date_string   = date("d-m-Y");

    $cmd = "mysqldump --hex-blob --routines --skip-lock-tables --log-error=mysqldump_error.log -h {$server_name} -u {$username} -p{$password} {$database_name} > " . BACKUP_PATH . "Backup-{$date_string}_{$database_name}.sql";

    $arr_out = array();
    unset($return);

    exec($cmd, $arr_out, $return);

    if($return !== 0) {
        echo "mysqldump for {$server_name} : {$database_name} failed with a return code of {$return}\n\n";
        echo "Descripcion del error:\n";
        $file = escapeshellarg("mysqldump_error.log");
        $message = `tail -n 1 $file`;
        echo "- $message\n\n";
    }else{

        return view('config/respaldo' , ["mensaje" => "Se completo correctamente el respaldo de ".$database_name ]);
    }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $id = DB::table('tRol')->insertGetId(
               ['nombreRol' => $request->nombreRol , 'descripcionRol' => $request->descripcionRol]);
        $count=0;
        DB::table('trol_tiene_tpermiso')->where('trol_idRol', '=', $id)->delete();
        foreach ($input as $in) {
             if ($count>2) {
                DB::table('trol_tiene_tpermiso')->insert(
                ['trol_idRol' => $id , 'tpermiso_idPermiso' => $in]);
             }     
             $count++;
        }

        return view('/usuario/usuario',['mensaje'=> 'Nuevo rol de usuario creado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);

        $rol = $user=DB::table('tusuario')
            ->join('trol', 'tusuario.trol_idRol', '=', 'trol.idRol')
            ->select('trol.nombreRol')
            ->where('tusuario.id', '=', $id)
            ->first();

        $permisos =  $user=DB::table('tusuario')
            ->join('trol', 'tusuario.trol_idRol', '=', 'trol.idRol')
            ->join('trol_tiene_tpermiso', 'trol_tiene_tpermiso.trol_idRol', '=', 'trol.idRol')
            ->join('tpermiso', 'trol_tiene_tpermiso.tpermiso_idPermiso', '=', 'tpermiso.idPermiso')
            ->select('tpermiso.nombrePermiso')
            ->where('tusuario.id', '=', $id)
            ->get();

        return view('usuario/verUsuario', ['usuario' => $usuario], ['rol' => $rol, 'permisos' => $permisos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $usuario = User::find($id);

        $rolU =DB::table('tusuario')
            ->join('trol', 'tusuario.trol_idRol', '=', 'trol.idRol')
            ->select('trol.nombreRol')
            ->where('tusuario.id', '=', $id)
            ->first();

        $rol =DB::table('trol')
            ->select('trol.idRol','trol.nombreRol')
            ->get();

        $permisos =DB::table('trol_tiene_tpermiso')
            ->join('trol', 'trol_tiene_tpermiso.trol_idRol', '=', 'trol.idRol')
            ->join('tpermiso', 'trol_tiene_tpermiso.tpermiso_idPermiso', '=', 'tpermiso.idPermiso')
            ->select('trol.nombreRol','trol.idRol','tpermiso.idPermiso','tpermiso.nombrePermiso')
            ->get();

        $permisoAll = DB::table('tpermiso')
            ->select('tpermiso.idPermiso','tpermiso.nombrePermiso')
            ->get();

    
        return view('usuario/editarRolUsuario', ['usuario' => $usuario], ['rol' => $rol,'rolU' => $rolU, 'permisos' => $permisos, 'permisoAll' => $permisoAll]);
        
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
        $input = $request->all();
        $count=0;
        DB::table('trol_tiene_tpermiso')->where('trol_idRol', '=', $id)->delete();
        foreach ($input as $in) {
             if($count>0){
                DB::table('trol_tiene_tpermiso')->insert(
                ['trol_idRol' => $id , 'tpermiso_idPermiso' => $in]);
             } 
             $count++;     
        }
      return Redirect::back();
    }

    public function cambiarRol(Request $request, $id)
    {
       $user = User::find($id);

       $user->tRol_idRol = $request->input('idRol');

       $user->save();

       return Redirect::back();
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

    public function cambiarConfig(Request $request){  
        $config  = $request->input('iValor');  

        DB::table('tconfiguracion')
        ->where('vConfiguracion', 'Periodo')
        ->update(['iValor' => $config]);

        $config = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','=','Periodo')
        ->first();
        return view('/config/config', ['config'=> $config, 'cambio'=>true]);
    }

    public function editarCoordinacion($id)
    {   
        $usuario = User::find($id);

        $coordinaciones = Coordinacion::all();

        return view('usuario/editarUsuarioCoordinacion', 
            ['usuario' => $usuario, 
            'coordinaciones' => $coordinaciones,
            'errors' => null]);
    }

    public function cambiarCoordinacion(Request $request, $id)
    {   
        $input = $request->all();
        $count=0;
        DB::table('tusuario_tcoordinacion')->where('tUsuario_idUsuario', '=', $id)->delete();
        foreach ($input as $in) {
             if($count>0){
                DB::table('tusuario_tcoordinacion')->insert(
                ['tUsuario_idUsuario' => $id , 'tCoordi_idCoordinacion' => $in]);
             } 
             $count++;     
        }

        $usuario = User::find($id);

        $coordinaciones = Coordinacion::all();

        return view('usuario/editarUsuarioCoordinacion', 
            ['usuario' => $usuario, 
            'coordinaciones' => $coordinaciones,
            'errors' => 'Se realizaron cambios en las coordinaciones de este usuario']);
    }
}
