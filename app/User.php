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

use App\Rol;
use App\Permiso;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tusuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getPermisos(){
        $user=DB::table('tusuario')
            ->join('trol', 'tusuario.trol_idRol', '=', 'trol.idRol')
            ->join('trol_tiene_tpermiso', 'trol_tiene_tpermiso.trol_idRol', '=', 'trol.idRol')
            ->join('tpermiso', 'trol_tiene_tpermiso.tpermiso_idPermiso', '=', 'tpermiso.idPermiso')
            ->select('tPermiso.nombrePermiso')
            ->get();

    }

        public function tienePermiso($validacion,$id){
      
       $resultado=DB::table('tusuario')
            ->join('trol', 'tusuario.trol_idRol', '=', 'trol.idRol')
            ->join('trol_tiene_tpermiso', 'trol_tiene_tpermiso.trol_idRol', '=', 'trol.idRol')
            ->join('tpermiso', 'trol_tiene_tpermiso.tpermiso_idPermiso', '=', 'tpermiso.idPermiso')
            ->select('tPermiso.nombrePermiso')
            ->where('tusuario.id',"=", $id)
            ->get();

        foreach ($resultado as $permiso) {
             if($permiso->nombrePermiso == $validacion){
            return true;
         }
        }

    }





}
