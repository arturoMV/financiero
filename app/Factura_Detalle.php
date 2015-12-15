<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura_Detalle extends Model
{
    protected $table = "tfacturadetalle";
   	protected $primaryKey = ['iDetalle'];
	protected $fillable = ['tFactura_idFactura','iLinia','vDetalle','iPrecio','iCantidad','iTotalLinea'];


    public function factura()
    {
    	return $this->belongsTo('App\Factura',,'idFactura');
    }
}