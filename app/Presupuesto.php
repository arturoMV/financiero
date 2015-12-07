<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presupuesto extends Model
{
    protected $table = 'tpresupuesto';
    protected $primaryKey = 'idPresupuesto';
    protected $fillable = ['idPresupuesto', 'tCoordinacion_idCoordinacion', 'vNombrePresupuesto', 'iPresupuestoInicial','iPresupuestoModificado'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function coordinacion()
    {
    	return $this->belongsTo('App\Coordinacion','tCoordinacion_idCoordinacion', 'idCoordinacion');
    }

    public function partidas()
    {
    	return $this->hasMany('App\Partida', 'tPresupuesto_idPresupuesto', 'idPresupuesto');
    }
}
