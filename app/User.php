<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use Auth;

use App\Rol;
use App\Permiso;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Tablaa usada por el modelo
     *
     * @var string
     */
    protected $table = 'tusuario';

    /**
     * Atributos del modelo
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * Atributos ocultos del modelo
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Verifica si el usuario tiene un permiso de aplicacion
     *
     * @param  String  $nombreRol
     * @param  String  $nombrePermiso
     * @return boolean
     */
    public function verificarPermiso($nombreRol, $nombrePermiso){
    
        $permisos =DB::table('trol_tiene_tpermiso')
            ->join('trol', 'trol_tiene_tpermiso.trol_idRol', '=', 'trol.idRol')
            ->join('tpermiso', 'trol_tiene_tpermiso.tpermiso_idPermiso', '=', 'tpermiso.idPermiso')
            ->select('tpermiso.nombrePermiso')
            ->where('trol.nombreRol','=',$nombreRol)
            ->get();

        foreach ($permisos as $permiso) {
            if($permiso->nombrePermiso == $nombrePermiso){
                return true;
            }
        }
    }


    /**
     * Verifica si el usuario autenticado tiene un permiso
     *
     * @param  String  $validacion
     * @return boolean
     */
    public function tienePermiso($validacion){
        $config = DB::table('tconfiguracion')
        ->select('iValor')
        ->where('vConfiguracion','=','Periodo')
        ->where('tUsuario_idUsuario', '=', Auth::user()->id)
        ->first();
        
        if(count($config)<=0){
        DB::table('tconfiguracion')->insert([
        'vConfiguracion' => 'Periodo',
        'iValor' => date('Y'),
        'tUsuario_idUsuario' => $this->id]); 
        } 
      
       $resultado=DB::table('tusuario')
            ->join('trol', 'tusuario.trol_idRol', '=', 'trol.idRol')
            ->join('trol_tiene_tpermiso', 'trol_tiene_tpermiso.trol_idRol', '=', 'trol.idRol')
            ->join('tpermiso', 'trol_tiene_tpermiso.tpermiso_idPermiso', '=', 'tpermiso.idPermiso')
            ->select('tpermiso.nombrePermiso')
            ->where('tusuario.id',"=", Auth::user()->id)
            ->get();

        foreach ($resultado as $permiso) {
             if($permiso->nombrePermiso == $validacion){
            return true;
         }
        }
    }
 
    /**
     * Verifica si el usuario autenticado tiene una coordinacion
     *
     * @param  String  $coordinacion
     * @return boolean
     */
    public function tieneCoordinacion($coordinacion){
      $resultado=DB::table('tusuario_tcoordinacion')
            ->select('tCoordi_idCoordinacion')
            ->where('tUsuario_idUsuario', '=', Auth::user()->id)
            ->get();

        foreach ($resultado as $permiso) {
            if($permiso->tCoordi_idCoordinacion == $coordinacion){
                return true;
            }
        }
        return false;
    }

      /**
     * Verifica si el usuario especifico tiene una coordinacion
     *
     * @param  String  $coordinacion
     * @param  int $id
     * @return boolean
     */
    public function verificarCoordinacion($coordinacion, $id){
      $resultado=DB::table('tusuario_tcoordinacion')
            ->select('tCoordi_idCoordinacion')
            ->where('tUsuario_idUsuario', '=', $id)
            ->get();

        foreach ($resultado as $permiso) {
            if($permiso->tCoordi_idCoordinacion == $coordinacion){
                return true;
            }
        }
        return false;
    }

    /**
     * Agrega la configuracion de año de un usuario autenticado
     *
     */
    public function agregarAnno(){
        DB::table('tconfiguracion')->insert([
            'vConfiguracion' => 'Periodo',
            'iValor' => 2016,
            'tUsuario_idUsuario' => $this->id]);  
    }
}
