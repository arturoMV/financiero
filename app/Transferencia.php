<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = "ttranferencia_partida";
   	protected $primaryKey = "idTransferencia";
	protected $fillable = ['tPresupuestoPartidaDe','tPresupuestoPartidaA','vDocumento','tusuario_idUsuario','created_at', 
    'updated_at'];
    public $timestamps = true;

    public function presupuestoPartida()
    {
    	return $this->belongsTo('App\Presupuesto','tPartida_idPartida','id');
    }

    public function facturaDetalle()
    {
    	return $this->hasMany('App\Factura_Detalle','idFactura', 'tFactura_idFactura');
    }
}