<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Rol;
use App\Permisos;
class Permisos extends Model
{
    //
	protected $table = "tpermiso";
    public $timestamps = false;
    protected $primaryKey = 'idPermiso';


}
