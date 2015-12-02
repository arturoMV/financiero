<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'tpresupuesto';
    protected $primaryKey = 'idPresupuesto';
    protected $fillable = ['idPresupuesto', 'tCoordinacio_idCoordinacion', 'vNombrePresupuesto'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function coordinacion()
    {
    	return $this->belongsTo('App\Coordinacion');
    }

    public function partida()
    {
    	return $this->hasMany('App\Partida');
    }
}
