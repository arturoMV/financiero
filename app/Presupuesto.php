<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Presupuesto extends Model
{
      /**
     * Tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'tpresupuesto';
      /**
     * Clave primadira del modelo
     *
     * @var string
     */
    protected $primaryKey = 'idPresupuesto';

    /**
     * Atributos del modelo
     *
     * @var array
     */
    protected $fillable = ['idPresupuesto', 'tCoordinacion_idCoordinacion', 'vNombrePresupuesto', 'iPresupuestoInicial','iPresupuestoModificado'];
    
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
    /**
     * Retorna la coordinacion del Presupuesto
     *
     * @return App\Coordinacion
     */
    public function coordinacion()
    {
    	return $this->belongsTo('App\Coordinacion','tCoordinacion_idCoordinacion', 'idCoordinacion');
    }

    /**
     * Retorna los Presupuesto_Partida del Presupuesto
     *
     * @return App\Presupuesto_Partida
     */
    public function partidas()
    {
    	return $this->hasMany('App\Presupuesto_Partida', 'tPresupuesto_idPresupuesto', 'idPresupuesto');
    }

    /**
     * Calcula el presupuesto inicial 
     *
     */
    public function calcularPresupuestoInicial(){
        $presupuesto = DB::table('tpresupuesto_tpartida')
                    ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
                    ->sum('iPresupuestoInicial');
        $this->iPresupuestoInicial = $presupuesto;
        $this->save();
    }

    /**
     * Calcula el presupuesto con transferencias 
     *
     */
    public function calcularPresupuestoModificado(){
        $presupuesto = DB::table('tpresupuesto_tpartida')
                    ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
                    ->sum('iPresupuestoModificado');
        $this->iPresupuestoModificado = $presupuesto;
        $this->save();
    }

    /**
     * Calcula el Saldo 
     *
     */
    public function calcularSaldo(){
        
        $this->iSaldo = $this->iPresupuestoModificado - $this->iGasto - $this->iReserva;
        $this->save();
    }

    /**
     * Calcula la reserva  
     *
     */
    public function calcularReserva(){
        $reserva = DB::table('tpresupuesto_tpartida')
        ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
        ->sum('iReserva');
        $this->iReserva = $reserva;
        $this->save();
    }

    /**
     * Calcula el Gasto 
     *
     */
    public function calcularGasto(){      
      $gasto = DB::table('tpresupuesto_tpartida')
        ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
        ->sum('iGasto');

        $this->iGasto = $gasto ;
        $this->save();
    }

    /**
     * Devuelve el Saldo como purcentaje
     *
     * @return float
     */
    public function calcularSaldoPorcentaje(){
        if($this->iPresupuestoModificado == 0)
            return 0;
        $porcentajeSaldo = ($this->iSaldo/$this->iPresupuestoModificado)*100;
        return $porcentajeSaldo;
    }

    /**
     * Devuelve la Reserva como porcentaje 
     *
     * @return float
     */
    public function calcularReservaPorcentaje(){
        if($this->iPresupuestoModificado == 0)
            return 0;
        $porcentajeReserva = ($this->iReserva/$this->iPresupuestoModificado)*100;
        return $porcentajeReserva;
    }

    /**
     * Devuelve el gasto como porcentaje 
     *
     * @return float
     */
    public function calcularGastoPorcentaje(){
        if($this->iPresupuestoModificado == 0)
            return 0;
        $porcentajeGasto = ($this->iGasto/$this->iPresupuestoModificado)*100;
        return $porcentajeGasto;
    }

    /**
     * Calcula la Presupuesto con transferencias inicial
     * 
     */
    public function presupuestoModificado(){
        $this->iPresupuestoModificado = $this->iPresupuestoInicial;
        $this->save();
    }
}
