<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Factura extends Model
{
    /**
     * Tabla usada por el modelo
     *
     * @var string
     */
    protected $table = "tfactura";

    /**
     * Clave primaria del el modelo
     *
     * @var string
     */
   	protected $primaryKey = "idFactura";

    /**
     * Atributos del modelo
     *
     * @var array
     */
	protected $fillable = ['idFactura','tPartida_idPartida','vTipoFactura','dFechaFactura','vDescripcionFactura','iMontoFactura'];

    /**
     * Agregar atributos created_at y updated_at
     *
     * @var boolean
     */
    public $timestamps = true;
    
     /**
     * Atributo de borrado suave
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
     
    /**
     * Utilizar borrardo suave
     *
     */
    use SoftDeletes;

    /**
     * Retorna el presupuesto del modelo
     *
     * @return App\Presupuesto
     */
    public function presupuestoPartida()
    {
    	return $this->belongsTo('App\Presupuesto','tPartida_idPartida','id');
    }

}