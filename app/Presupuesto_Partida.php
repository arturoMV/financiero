<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presupuesto_Partida extends Model
{
{
    protected $table = 'tpresupuesto_tpartida';
    protected $primaryKey = 'id';
    protected $fillable = ['tPresupuesto_idPresupuesto', 'tParitda_idPartida', 'iPresupuestoInicial','iPresupuestoModificado0', 'iGasto', 'iSaldo'];
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
