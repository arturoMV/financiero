<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Presupuesto_Partida extends Model
{
    protected $table = 'tpresupuesto_tpartida';
    protected $primaryKey = 'id';
    protected $fillable = ['tPresupuesto_idPresupuesto', 'tParitda_idPartida', 'iPresupuestoInicial','iPresupuestoModificado', 'iGasto', 'iSaldo'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function presupuesto()
    {
        return $this->belongsTo('App\Presupuesto', 'tPresupuesto_idPresupuesto', 'idPresupuesto');
    }

    public function partida()
    {
    	return $this->belongsTo('App\Partida', 'tParitda_idPartida', 'idPartida');
    }

    public function factura()
    {
        return $this->hasMany('App\Factura', 'id', 'tParitda_idPartida');
    }

    public function calcularSaldo(){
        $reserva = DB::table('tfactura')
        ->where('tPartida_idPartida','=', $this->id)
        ->where('vTipoFactura', '=','Solicitud GECO')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $this->iReserva = $reserva;

        $this->iSaldo = $this->iPresupuestoModificado - $this->iGasto- $reserva;
        $this->save();
    }

    public function calcularReserva(){
        $reserva = DB::table('tfactura')
        ->where('tPartida_idPartida','=', $this->id)
        ->where('vTipoFactura', '=','Solicitud GECO')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $this->iReserva = $reserva;
        $this->save();
    }

    public function calcularGasto(){      
      $gasto = DB::table('tfactura')
        ->where('tPartida_idPartida','=', $this->id)
        ->where('vTipoFactura', '!=','Pases Anulacion')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $anulacion = DB::table('tfactura')
        ->where('tPartida_idPartida',"=",$this->id)
        ->where('vTipoFactura', '=','Pases Anulacion')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $reserva = DB::table('tfactura')
        ->where('tPartida_idPartida','=', $this->id)
        ->where('vTipoFactura', '=','Solicitud GECO')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $this->iGasto = $gasto - $anulacion - $reserva;
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
        $transferenciasAumentar = DB::table('ttranferencia_partida')
        ->where('tPresupuestoPartidaA',"=",$this->id)
        ->sum('iMontoTransferencia');


        $transferenciasDisminuir = DB::table('ttranferencia_partida')
        ->where('tPresupuestoPartidaDe',"=",$this->id)
        ->sum('iMontoTransferencia');

        $this->iPresupuestoModificado = $this->iPresupuestoInicial + $transferenciasAumentar - $transferenciasDisminuir;
        $this->save();
    }

    public function getPartida(){
         return Partida::find($this->tPartida_idPartida);
    }

    public function getTransaccionPorTipo($tipo){
        $monto = DB::table('tfactura')
                ->where('vTipoFactura',$tipo)
                ->where('tPartida_idPartida', $this->id)
                ->sum('iMontoFactura');
        return $monto;
    }

    public function getTransferenciasDe(){
        $monto = DB::table('ttranferencia_partida')
                ->where('tPresupuestoPartidaDe',$this->id)
                ->sum('iMontoTransferencia');
        return $monto;
    }

    public function getTransferenciasA(){
         $monto = DB::table('ttranferencia_partida')
                ->where('tPresupuestoPartidaA',$this->id)
                ->sum('iMontoTransferencia');
        return $monto;
    }

    public function getPresupuestoTransferencia($id){
        $presupuesto = Presupuesto::find($id);
        return $presupuesto;
    }

    public function getPresupuestoPartidaTransferencia($id){
        $presupuesto = Presupuesto_Partida::find($id);
        return $presupuesto;
    }

    public function getCoordinacionTransferencia($id){
        $coordinacion = Coordinacion::find($id);
        return $coordinacion;
    }

    public function getPartidaTransferencia($id){
        $partida = Partida::find($id);
        return $partida;
    }
}
