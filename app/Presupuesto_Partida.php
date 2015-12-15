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
        $this->iSaldo = $this->iPresupuestoModificado - $this->iGasto;
        $this->save();
    }

    public function calcularGasto(){      
      $gasto = DB::table('tfactura')
        ->where('tPartida_idPartida','=', $this->id)
        ->where('vTipoFactura', '!=','Pases Anulacion')
        ->sum('iMontoFactura');

        $anulacion = DB::table('tfactura')
        ->where('tPartida_idPartida',"=",$this->id)
        ->where('vTipoFactura', '=','Pases Anulacion')
        ->sum('iMontoFactura');

        $this->iGasto = $gasto - $anulacion;
        $this->save();
    }
    
    public function calcularSaldoPorcentaje(){
        if($this->iPresupuestoModificado == 0)
            return 0;
        $porcentajeSaldo = ($this->iSaldo/$this->iPresupuestoModificado)*100;
        return $porcentajeSaldo;
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
        $monto = DB::table('tFactura')
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
}
