<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;

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
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            ->select('tPermiso.nombrePermiso')
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
