@extends('/layouts.master')
@section('title', 'Partida')
@section('movimiento')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND  Auth::user()->tienePermiso('Agregar Transaccion') AND $date = date('Y') == $anno->iValor)
<section class="container-fluid">


    <br>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Oops!</strong> Error en la transaccion<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li><% $error %></li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('mensaje'))
    <div class="alert alert-success">
        <strong>Bien!</strong><br><br>
        <ul>
            <li>Se agrego la Factura</li>
        </ul>
    </div>
    @endif
    <form class="col-md-12 alert container-fluid table-responsive form-horizontal" method="post" action="/transaccion" onsubmit="buttonName.disabled=true; return true;">
        {!!csrf_field()!!}
        <div class="col-md-12">
        <h3>Nuevo Movimiento de Presupuesto</h3>
        </div>
        <div class="container-fluid col-md-7">
            <div class="form-group">
                <label class="col-md-6 control-label" >Tipo de Transacción:</label>
                <div class="col-md-6">
                    <select name="vTipoFactura" class="form-control" required ng-model="tipo">
                        <option value="Factura credito" ng-selected="true"  >Factura Credito</option>
                        <option value="Factura pendiente" >Factura Pendiente</option>
                        <option value="Reintegro de caja chica" >Reintegro de Caja Chica</option>
                        <option value="Solicitud GECO" >Solicitud GECO</option>
                        <option value="Cancelacion GECO">Cancelacion GECO</option>
                        <option value="Pases Adicionales" >Pases Adicionales</option>
                        <option value="Pases Anulacion" >Pases Anulación</option>
                        <option value="Requisicion" >Requesición Paq. Basico</option>
                        <option value="Orden de servicio" >Ordenes de Servicio</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6 control-label">Observacion:</label>
                <div class="col-md-6">
                    <textarea name="vDescripcionFactura" class="form-control" rows="2"></textarea> 
                </div>
            </div>
        </div>
        <div class="container-fluid col-md-5">
            <div class="form-group">
                <label class="col-md-5 control-label">Fecha:</label>
                <div class="col-md-7">
                    <input type="date"  class="form-control" name="dFechaFactura" max="<%date('Y-m-d')%>" required> 
                </div>
            </div>
            <div class="form-group text-left">
                <label class="col-md-6 control-label">Num. Documento:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="vDocumento" value="N/A">
                </div>
            </div >
        </div>
        <div class="container-fluid table-responsive col-md-12"  ng-controller="facturaTemplate">
            <button class="btn btn-primary btn-sm" ng-click="agregarFila()">Agregar Partida</button>
            <table  class="table table-condensed text-center col-md-12">
                <thead>
                    <tr>
                        <th class="col-md-6 text-center">Partida</th>
                        <th class="col-md-3 text-center">Detalle</th>
                        <th class="col-md-3 text-center">Monto</th>
                    </tr>
                </thead>
                <tbody id="factura">
                    <tr ng-repeat="x in factura">
                        <td>
                            <div ng-controller="coordinacionTemplate">
                                <div class="container-fluid search-container form-horizontal" ng-controller="presupuestoTemplate">
                                    <div class="container-fluid" ng-controller="partidaTemplate" >
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12">
                                                        <strong>Unidad Ejecutora</strong>
                                                        <select ng-model="coorSelected" ng-change="pSelected = 0; partSelected = 0" class="form-control">
                                                            <option  ng-repeat="coordinacion in modelC" value="{{coordinacion.idCoordinacion}}">{{coordinacion.idCoordinacion}}-{{coordinacion.vNombreCoordinacion}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12" >
                                                        <strong>Presupuesto</strong>
                                                        <select ng-model="pSelected" class="form-control">
                                                            <option ng-if="presupuesto.tCoordinacion_idCoordinacion == coorSelected" ng-repeat="presupuesto in modelPr" value="{{presupuesto.idPresupuesto}}">{{presupuesto.vNombrePresupuesto}}-{{presupuesto.anno}}</option>
                                                        </select>
                                                    </div>
                                                    <strong>Partida</strong>
                                                    <div class="form-group col-md-12">
                                                        <select ng-model="partSelected" class="form-control">
                                                            <option ng-if="partida.tPresupuesto_idPresupuesto == pSelected" ng-repeat="partida in modelP" value="{{partida.id}}" >{{partida.codPartida}}-{{partida.vNombrePartida}}</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <hr>
                                                        <div ng-if="partida.id == partSelected" ng-repeat="partida in modelP" ng-init="x.partida=partida.id">
                                                            <strong>Presupuesto Incial: <small>{{partida.iPresupuestoInicial | currency: "₡":0}}</small><br>
                                                            Presupuesto Modificado: <small>{{partida.iPresupuestoModificado | currency: "₡":0}}</small> <br>
                                                            Gasto: <small>{{partida.iGasto | currency: "₡":0}} </small> <br>
                                                            Reserva: <small>{{partida.iReserva | currency: "₡":0}} </small> <br>
                                                            Saldo: <small>{{partida.iSaldo | currency: "₡":0}}</small></strong>
                                                            <div ng-if="tipo != 'Pases Anulacion'" ng-init="x.maximo=partida.iSaldo">  
                                                            </div>
                                                           
                                                        </div>
                                                        <input  type="hidden" name="id{{$index}}" required value="{{x.partida}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div ng-if="tipo != 'Cancelacion GECO' && tipo != 'Pases Anulacion' && tipo != 'Pases Adicionales'">
                                        <input type="text" class="form-control" ng-model="x.detalle" required name="detalle{{$index}}">
                                    </div>
                                    <div ng-if="tipo == 'Cancelacion GECO' || tipo == 'Pases Anulacion'" ng-controller="reservaTemplate">
                                        <select class="form-control" required name="detalle{{$index}}" ng-model="resSelected">
                                            <option ng-repeat="reserva in modelRe | filter : search | orderBy : myOrder track by $index" 
                                            ng-if="reserva.tPartida_idPartida == x.partida" value="{{reserva.vReserva}}">
                                            {{reserva.vDocumento}}-{{reserva.vDetalle}}-
                                            {{reserva.iMontoFactura | currency: "₡":0}}
                                            </option>
                                        </select>
                                        <div  ng-repeat="reserva in modelRe" ng-if="resSelected == reserva.vReserva"  ng-init="x.maximo = reserva.iMontoFactura">
                                        </div>
                                    </div>

                                    <div ng-if="tipo == 'Pases Adicionales'" ng-controller="reservaTemplate">
                                        <select class="form-control" required name="detalle{{$index}}" >
                                            <option ng-repeat="reserva in modelRe | filter : search | orderBy : myOrder track by $index" 
                                            ng-if="reserva.tPartida_idPartida == x.partida" value="{{reserva.vReserva}}">
                                            {{reserva.vDocumento}}-{{reserva.vDetalle}}-
                                            {{reserva.iMontoFactura | currency: "₡":0}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <div ng-if="tipo == 'Cancelacion GECO' || tipo == 'Pases Anulacion' || tipo == 'Pases Adicionales'">
                                    <input type="number" class="form-control" required name="iMontoFactura{{$index}}" min="0"
                                        max="{{x.maximo}}" >
                                  </div>
                                  <div ng-if="tipo != 'Cancelacion GECO' && tipo != 'Pases Anulacion' && tipo != 'Pases Adicionales'">
                                    <input type="number" class="form-control" required name="iMontoFactura{{$index}}" min="0"
                                      max="{{x.maximo}}" min="{{x.maximo}}">
                                  </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>  
                                <br>
                                <button type="button" class="btn btn-sm btn-danger"  ng-click="eliminarFila($index)">Remover fila</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <input type="submit" value="Agregar Factura" name="buttonName"  class="btn btn-primary pull-right">
            </div>
    </form>
    </div>
</section>
@else
    @if(date('Y') != $anno->iValor)
        Solo se pueden agregar movimientos al presente año. <br> 
       Para agregar un nuevo movimiento presupuestatio debe <br><br>
       <a href="/configuracion" class="btn btn-info">Configurar Año de Sistema</a>
    @else
        Debe estar autenticado y tener permisos para ver esta pagina
    @endif
@endif
@endsection