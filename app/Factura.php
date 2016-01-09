<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Factura extends Model
{
    protected $table = "tfactura";
   	protected $primaryKey = "idFactura";
	protected $fillable = ['idFactura','tPartida_idPartida','vTipoFactura','dFechaFactura','vDescripcionFactura','iMontoFactura'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function presupuestoPartida()
    {
    	return $this->belongsTo('App\Presupuesto','tPartida_idPartida','id');
    }

    public function facturaDetalle()
    {
    	return $this->hasMany('App\Factura_Detalle','idFactura', 'tFactura_idFactura');
    }
}