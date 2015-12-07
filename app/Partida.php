<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partida extends Model
{	
    protected $table = "tpartida";
   	protected $primaryKey = "idPartida";
	protected $fillable = ['idPartida','tPresupuesto_idPresupuesto','estado','saldo','descripcion'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function presupuesto()
    {
    	return $this->belongsTo('App\Presupuesto', 'tPresupuesto_idPresupuesto', 'idPresupuesto');
    }

    public function factura()
    {
    	return $this->hasMany('App\Factura');
    }

    public function calcularSaldo(){
        $this->saldo = $this->iPresupuestoModificado - $this->gasto;

        $this->save();
    }

    public function calcularSaldoPorcentaje(){
        $porcentajeSaldo = ($this->saldo/$this->iPresupuestoModificado)*100;
        return $porcentajeSaldo;
    }

    public function calcularGastoPorcentaje(){
        $porcentajeGasto = ($this->gasto/$this->iPresupuestoModificado)*100;
        return $porcentajeGasto;
    }

    public function presupuestoModificado(){
        $this->iPresupuestoModificado = $this->iPresupuestoModificado;
    }
}
