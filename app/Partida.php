<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partida extends Model
{	
    /**
     * Tabla usada por el modelo
     *
     * @var string
     */
    protected $table = "tpartida";

    /**
     * Clave primaria del el modelo
     *
     * @var string
     */
   	protected $primaryKey = "idPartida";

    /**
     * Atributos del modelo
     *
     * @var array
     */
	protected $fillable = ['idPartida','codPartida','vNombrePartida','vDescripcion'];
    
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
     * Retorna el Presupuesto_Partida del modelo
     *
     * @return App\Presupuesto_Partida
     */
    public function presupuestoPartida()
    {
    	return $this->hasMany('App\Presupuesto_Partida','tPartida_idPartida','idPartida');
    }


}
