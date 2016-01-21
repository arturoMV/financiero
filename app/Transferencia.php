<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    /**
     * Tabla usada por el modelo
     *
     * @var string
     */
    protected $table = "ttranferencia_partida";
     
    /**
     * Llave primaria del modelo
     *
     * @var string
     */
   	protected $primaryKey = "idTransferencia";
    
    /**
     * Atributos del modelo
     *
     * @var array
     */
	protected $fillable = ['tPresupuestoPartidaDe','tPresupuestoPartidaA','vDocumento','tusuario_idUsuario','created_at', 
    'updated_at'];

    /**
     * Agregar atributos created_at y updated_at
     *
     * @var boolean
     */
    public $timestamps = true;

   
}