<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinacion extends Model
{
	protected $table = "tcoordinacion";
	protected $primaryKey = "idCoordinacion";
	protected $fillable =['idCoordinacion', 'vNombreCoordinacion'];
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function presupuestos()
    {
    	return $this->hasMany('App\Presupuesto', 'tCoordinacion_idCoordinacion', 'idCoordinacion');
    }
}
