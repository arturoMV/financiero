<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Coordinacion extends Model
{
	protected $table = "tcoordinacion";
	protected $primaryKey = "idCoordinacion";
	protected $fillable =['idCoordinacion', 'vNombreCoordinacion'];
	public $timestamps = true;
	protected $dates = ['deleted_at'];
	use SoftDeletes;
   
    public function presupuestos()
    {
    	return $this->hasMany('App\Presupuesto', 'tCoordinacion_idCoordinacion', 'idCoordinacion');
    }
}
