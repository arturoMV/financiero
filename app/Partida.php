<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partida extends Model
{	
    protected $table = "tpartida";
   	protected $primaryKey = "idPartida";
	protected $fillable = ['idPartida','codPartida','vNombrePartida','vDescripcion'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function presupuestoPartida()
    {
    	return $this->hasMany('App\Presupuesto_Partida','tPartida_idPartida','idPartida');
    }


}
