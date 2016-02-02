<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Coordinacion extends Model
{
	/**
     * Tabla usada por el modelo
     *
     * @var string
     */
	protected $table = "tcoordinacion";

	/**
     * Clave primaria del el modelo
     *
     * @var string
     */
	protected $primaryKey = "idCoordinacion";

	/**
     * Atributos del modelo
     *
     * @var array
     */
	protected $fillable =['idCoordinacion', 'vNombreCoordinacion'];

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
     * Retorna el Presupuesto del modelo
     *
     * @return App\Presupuesto
     */   
    public function presupuestos()
    {
    	return $this->hasMany('App\Presupuesto', 'tCoordinacion_idCoordinacion', 'idCoordinacion');
    }
}
