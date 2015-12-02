<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{	
    protected $table = "tpartida";
   	protected $primaryKey = "idPartida";
	protected $fillable = ['idPartida','tPresupuesto_idPresupuesto','estado','saldo','descripcion'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function presupuesto()
    {
    	return this->belongsTo('App\Presupuesto');
    }

    public function factura()
    {
    	return this->hasMany('App\Factura');
    }
}
