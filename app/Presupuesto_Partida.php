<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Presupuesto_Partida extends Model
{
   
     /**
     * Tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'tpresupuesto_tpartida';
     /**
     * Clave primaria del moldelo
     *
     * @var string
     */
    protected $primaryKey = 'id';
  
     /**
     * Atributos del modelo
     *
     * @var array
     */
    protected $fillable = ['tPresupuesto_idPresupuesto', 'tParitda_idPartida', 'iPresupuestoInicial','iPresupuestoModificado', 'iGasto', 'iSaldo'];
   
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
    public function presupuesto()
    {
        return $this->belongsTo('App\Presupuesto', 'tPresupuesto_idPresupuesto', 'idPresupuesto');
    }

    /**
     * Retorna la partida del modelo
     *
     * @return App\Partida
     */
    public function partida()
    {
    	return $this->belongsTo('App\Partida', 'tParitda_idPartida', 'idPartida');
    }

    /**
     * Retorna las facturas del modelo
     *
     * @return App\Factura
     */
    public function factura()
    {
        return $this->hasMany('App\Factura', 'id', 'tParitda_idPartida');
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
     * Calcula la reserva consultando las facturas
     *
     */
    public function calcularReserva(){
        $reserva = DB::table('tfactura')
        ->where('tPartida_idPartida','=', $this->id)
        ->where('vTipoFactura', '=','Solicitud GECO')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $anulacion = DB::table('tfactura')
        ->where('tPartida_idPartida',"=",$this->id)
        ->where('vTipoFactura', '=','Pases Anulacion')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $adicionales = DB::table('tfactura')
        ->where('tPartida_idPartida',"=",$this->id)
        ->where('vTipoFactura', '=','Pases Adicionales')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $cancelacion = DB::table('tfactura')
        ->where('tPartida_idPartida',"=",$this->id)
        ->where('vTipoFactura', '=','Cancelacion GECO')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');



        $this->iReserva = $reserva - $anulacion - $cancelacion + $adicionales;
        $this->save();
    }


    /**
     * Calcula el gasto consultando las facturas
     *
     */
    public function calcularGasto(){      
      $gasto = DB::table('tfactura')
        ->where('tPartida_idPartida','=', $this->id)
        ->where('vTipoFactura', '!=','Pases Anulacion')
        ->where('deleted_at', null)
        ->sum('iMontoFactura');

        $adicionales = DB::table('tfactura')
        ->where('tPartida_idPartida',"=",$this->id)
        ->where('vTipoFactura', '=','Pases Adicionales')
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

        $this->iGasto = $gasto - $reserva - $adicionales;
        $this->save();
    }
    
    /**
     * Cacula el saldo como porcentaje
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
     * Cacula la reserva como porcentaje
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
     * Cacula el Gasto como porcentaje
     *
     * @return float
     */
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

    /**
     * Devuelve la partida 
     *
     * @return App\Partida
     */
    public function getPartida(){
         return Partida::find($this->tPartida_idPartida);
    }

    /**
     * Cacula el total de la factura por tipo de transaccion
     *
     * @return int
     */
    public function getTransaccionPorTipo($tipo){
        $monto = DB::table('tfactura')
                ->where('vTipoFactura',$tipo)
                ->where('tPartida_idPartida', $this->id)
                ->sum('iMontoFactura');
        return $monto;
    }

    /**
     * Cacula el monto total de transferencias desde esta partida
     *
     * @return int
     */
    public function getTransferenciasDe(){
        $monto = DB::table('ttranferencia_partida')
                ->where('tPresupuestoPartidaDe',$this->id)
                ->sum('iMontoTransferencia');
        return $monto;
    }

    /**
     * Cacula el monto total de transferencias hacia esta partida
     *
     * @return int
     */
    public function getTransferenciasA(){
         $monto = DB::table('ttranferencia_partida')
                ->where('tPresupuestoPartidaA',$this->id)
                ->sum('iMontoTransferencia');
        return $monto;
    }

    /**
     * Consulta el presupuesto de un Presupuesto_Partida especifico
     *
     * @return App\Presupuesto
     */
    public function getPresupuestoTransferencia($id){
        $presupuesto = Presupuesto::find($id);
        return $presupuesto;
    }

    /**
     * Consulta el Presupuesto_Partida de una Transferencia
     *
     * @return App\Presupuesto_Partida
     */
    public function getPresupuestoPartidaTransferencia($id){
        $presupuesto = Presupuesto_Partida::find($id);
        return $presupuesto;
    }

    /**
     * Consulta el presupuesto de un Presupuesto_Partida especifico
     *
     * @return App\Coordinacion
     */
    public function getCoordinacionTransferencia($id){
        $coordinacion = Coordinacion::find($id);
        return $coordinacion;
    }
    /**
     * Consulta la Partida de un Presupuesto_Partida especifico
     *
     * @return App\Partida
     */
    public function getPartidaTransferencia($id){
        $partida = Partida::find($id);
        return $partida;
    }
}
