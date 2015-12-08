<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "tfactura";
   	protected $primaryKey = "idFactura";
	protected $fillable = ['idFactura','tPartida_idPartida','vTipoFactura','dFechaFactura','vDescripcionFactura','iMontoFactura'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function presupuesto()
    {
    	return $this->belongsTo('App\Presupuesto');
    }

    public function factura()
    {
    	return $this->hasMany('App\Factura');
    }
}