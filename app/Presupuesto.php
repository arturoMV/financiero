<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Presupuesto extends Model
{
    protected $table = 'tpresupuesto';
    protected $primaryKey = 'idPresupuesto';
    protected $fillable = ['idPresupuesto', 'tCoordinacion_idCoordinacion', 'vNombrePresupuesto', 'iPresupuestoInicial','iPresupuestoModificado'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function coordinacion()
    {
    	return $this->belongsTo('App\Coordinacion','tCoordinacion_idCoordinacion', 'idCoordinacion');
    }

    public function partidas()
    {
    	return $this->hasMany('App\Presupuesto_Partida', 'tPresupuesto_idPresupuesto', 'idPresupuesto');
    }

    public function calcularPresupuestoInicial(){
        $presupuesto = DB::table('tpresupuesto_tpartida')
                    ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
                    ->sum('iPresupuestoInicial');
        $this->iPresupuestoInicial = $presupuesto;
        $this->save();
    }

    public function calcularPresupuestoModificado(){
        $presupuesto = DB::table('tpresupuesto_tpartida')
                    ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
                    ->sum('iPresupuestoModificado');
        $this->iPresupuestoModificado = $presupuesto;
        $this->save();
    }
    public function calcularSaldo(){
        
        $this->iSaldo = $this->iPresupuestoModificado - $this->iGasto - $this->iReserva;
        $this->save();
    }

    public function calcularReserva(){
        $reserva = DB::table('tpresupuesto_tpartida')
        ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
        ->sum('iReserva');
        $this->iReserva = $reserva;
        $this->save();
    }

    public function calcularGasto(){      
      $gasto = DB::table('tpresupuesto_tpartida')
        ->where('tPresupuesto_idPresupuesto','=', $this->idPresupuesto)
        ->sum('iGasto');

        $this->iGasto = $gasto ;
        $this->save();
    }

    public function calcularSaldoPorcentaje(){
        if($this->iPresupuestoModificado == 0)
            return 0;
        $porcentajeSaldo = ($this->iSaldo/$this->iPresupuestoModificado)*100;
        return $porcentajeSaldo;
    }

    public function calcularReservaPorcentaje(){
        if($this->iPresupuestoModificado == 0)
            return 0;
        $porcentajeReserva = ($this->iReserva/$this->iPresupuestoModificado)*100;
        return $porcentajeReserva;
    }

    public function calcularGastoPorcentaje(){
        if($this->iPresupuestoModificado == 0)
            return 0;
        $porcentajeGasto = ($this->iGasto/$this->iPresupuestoModificado)*100;
        return $porcentajeGasto;
    }

    public function presupuestoModificado(){
        $this->iPresupuestoModificado = $this->iPresupuestoInicial;
        $this->save();
    }
}
