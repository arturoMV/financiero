@extends('/layouts.master')
@section('title', 'Partida')
@section('partida')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida') AND Auth::user()->tieneCoordinacion($coordinacion->idCoordinacion))
<section>
    <div class="wrapper">
    <form class="col-md-12 form-horizontal" action="/partida/<% $partida->idPartida%>/edit" method="get">
        <h2>Detalles de la partida</h2>
        <div class="form-group">
            <label class="col-md-4 control-label">Unidad Ejecutora</label>
            <p class="col-md-8 form-control-static">
                <a href="/coordinacion/<%$coordinacion->idCoordinacion%>" title="">
                <%$coordinacion->idCoordinacion%>-<% $coordinacion->vNombreCoordinacion %></a>
            </p>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Presupuesto</label>
            <p class="col-md-8 form-control-static">
                <a href="/presupuesto/<%$presupuesto->idPresupuesto%>" title=""><%$presupuesto->vNombrePresupuesto%> - 
                <%$presupuesto->anno%></a>
            </p>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Partida</label>
            <p class="col-md-2 form-control-static"><% $partida->codPartida %></p>
        </div >
        <div  class="form-group">
            <label class="col-md-4 control-label">Nombre de Partida</label>
            <p class="col-md-8 form-control-static"><%$partida->vNombrePartida%></p>
        </div>
        @if($partida->vDescripcion!="")
        <div class="form-group">
            <label class="col-md-4 control-label">Descripción:</label>
            <p class="col-md-8 form-control-static"><%$partida->vDescripcion%></p>
        </div>
        @endif
        <div class="col-md-12 form-group">
            @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id) AND $presupuesto->anno == date('Y'))
            <input type="submit" name="" class="btn btn-warning" value="Editar Partida">
            <a href="/partida/editar/<% $presupuesto_partida->id %>" class="btn btn-warning" title="Cambiar presupuesto">Editar</a>
            @endif
            @if(count($transferenciasA)>0 || count($transferenciasDe)>0)
            <a href="#lista-transferencias" class="btn btn-info">Ver Transferencias</a>
            @endif
        </div>
    </form>
    <div class="col-md-12">
    <hr>
    <h3>Estado de la partida</h3>
    <div class="">
        <h4>Presupuesto Incial: <small>{{<%$presupuesto_partida->iPresupuestoInicial%> | currency: "₡":0}}</small> <br>
            Presupuesto Modificado: <small>{{<%$presupuesto_partida->iPresupuestoModificado%> | currency: "₡":0}}</small> <br>
            Gasto: <small>{{<%$presupuesto_partida->iGasto%> | currency: "₡":0}} </small> <br>
            @if($presupuesto_partida->iReserva>0)
            Reserva (GECO): <small>{{<%$presupuesto_partida->iReserva%> | currency: "₡":0}} </small> <br>
            @endif
            Saldo: <small>{{<%$presupuesto_partida->iSaldo%> | currency: "₡":0}}</small>
        </h4>
    </div>
    <div class="progress">
        <div class="progress-bar progress-bar-danger" style="width: <% $presupuesto_partida->calcularGastoPorcentaje() %>%">
            <span class="sr-only"></span>
            <% round($presupuesto_partida->calcularGastoPorcentaje(),2) %>%
        </div>
        <div class="progress-bar progress-bar-warning" style="width: <% $presupuesto_partida->calcularReservaPorcentaje()%>%">
            <span class="sr-only"></span>
            <% round($presupuesto_partida->calcularReservaPorcentaje(),2) %>%
        </div>
        <div class="progress-bar progress-bar-primary" style="width: <% $presupuesto_partida->calcularSaldoPorcentaje()%>%">
            <span class="sr-only"></span>
            <% round($presupuesto_partida->calcularSaldoPorcentaje(),2) %>%
        </div>
    </div>
    <div class="alert alert-danger col-md-1 col-md-offset-4">
        Gasto: <% round($presupuesto_partida->calcularGastoPorcentaje(),2) %>% <br>
    </div>
    @if($presupuesto_partida->iReserva>0)
    <div class="alert alert-warning col-md-1 col-md-offset-1">
        Reserva: <% round($presupuesto_partida->calcularReservaPorcentaje(),2) %>% <br>
    </div>
    @endif
    <div class="alert alert-info col-md-1 col-md-offset-1">
        Saldo: <% round($presupuesto_partida->calcularSaldoPorcentaje(),2) %>%
    </div>
    @if(count($transacciones)>0)
    <div class="col-md-12 <% $count = 0 %>">
    <hr>
    <h4>Lista de Transaciones<small>
        <label class="pull-right"><input type="checkbox" name="" ng-model="expandir" ng-check="true" value="">Expandir Todo</label></small>
    </h4>
         <a href="/partida/informe-gastos/<%$presupuesto_partida->id%>" target="_blank" class="btn btn-info">Informe Transacciones</a><br> <br> 
    @foreach($transacciones as $transaccion)
    <div class="panel panel-primary" ng-init="vert<% $count%> = false">
        <div class="panel-heading" style="height:40px">
            <label  class="col-md-4 control-label">Num Documento: <small><% $transaccion->vDocumento %></small></label>           
            <label  class="col-md-4 control-label">Tipo: <small><% $transaccion->vTipoFactura %></small></label>
            <label  class="col-md-3 control-label">Monto: <small>{{<% $transaccion->iMontoFactura %> | currency: "₡":0 }}</small></label>
            <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!vert<%$count%> && !expandir"
                ng-click="vert<%$count%> = true">+</button>
            <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="vert<%$count%> && !expandir"
                ng-click="vert<%$count%> = false">x</button>
        </div>
        <div ng-if="vert<%$count %> || expandir" class="panel-body form-horizontal">
            <div class="form-group">
                <label class="col-md-4 control-label">Tipo de transacción: </label>
                <p class="col-md-8 form-control-static"><% $transaccion->vTipoFactura %></p>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Fecha:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->dFechaFactura %></p>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Partida:</label>
                <p class="col-md-8 form-control-static"><% $partida->codPartida %></p>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Detalle de Transaccion:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->vDetalleFactura %></p>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Monto:</label>
                <p class="col-md-8 form-control-static">{{<% $transaccion->iMontoFactura %> | currency: "₡":0 }}</p>
            </div>
            @if($transaccion->vDocumento!="No Aplica")
            <div class="form-group">
                <label class="col-md-4 control-label">Documento:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->vDocumento %></p>
            </div>
            @endif
            @if($transaccion->vDescripcionFactura!="")
            <div class="form-group">
                <label class="col-md-4 control-label">Observasion:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->vDescripcionFactura %></p>
            </div>
            @endif
            <hr>
            @if(Auth::user()->tienePermiso('Borrar Transaccion') AND $presupuesto->anno == date('Y'))
            <form action="/transaccion/<% $transaccion->idFactura %>/delete" method="post">
                <input type="hidden" name="_token" value="<% csrf_token() %>">
                <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal<% $transaccion->idFactura %>">Eliminar</button>

                <div class="col-md-5">
                    <div class="modal fade" id="myModal<% $transaccion->idFactura %>" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmar</h4>
                          </div>
                          <div class="modal-body">
                            <p>Estas seguro de que quieres eliminar esta transacción.
                              <ul>
                                <li>Eliminar una transacción modifica el estado de la partida</li>

                                @if($transaccion->vTipoFactura == "Solicitud GECO")
                                    <li>Eliminar una Solicitud GECO elimina todas los Pases asosciados a esta solicitud</li>
                                @endif
                              </ul>
                            </p>
                            
                              <input type="submit" name="" class="btn btn-danger" value="Eliminar">
                              <button type="button" class="btn btn-success pull-right" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div> 
                      </div>
                    </div> 
                </div>

            </form>
            @endif
        </div>
        </div class="<%$count++%>">
        @endforeach
    </div>
    @endif   
    <div class="col-md-12">
        <hr>
        @if(count($transferenciasA)>0 || count($transferenciasDe)>0)
        <h3 id="lista-transferencias">Lista de Transferencias</h3>
        @endif
    </div>
    @if(count($transferenciasDe)>0)
    <div class="col-md-6 <% $count = 0 %>">
    @else
    <div class="col-md-12 <% $count = 0 %>">
        @endif
        @if(count($transferenciasA)>0)
        <h4>Aumentos</h4>
        @endif
        @foreach($transferenciasA as $transferenciaA)
        <div class="panel panel-success" ng-init="ver<% $count%> = false">
            <div class="panel-heading" style="height:70px">
                <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!ver<%$count%>"
                    ng-click="ver<%$count%> = true">+</button>
                <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="ver<%$count%>"
                    ng-click="ver<%$count%> = false">x</button>
                <label  class="col-md-10 control-label">Fecha: <small><% $transferenciaA->created_at %></small></label><br>
                <label  class="col-md-10 control-label">Monto: <small>{{<% $transferenciaA->iMontoTransferencia %> | currency: "₡":0 }}</small></label>
            </div>
            <div ng-if="ver<%$count %>" class="panel-body form-horizontal">
                <div class="form-group">
                    <label class="col-md-4 control-label">Fecha de Transferencia: </label>
                    <p class="col-md-8 form-control-static"><% $transferenciaA->created_at %></p>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Documento:</label>
                    <p class="col-md-8 form-control-static"><% $transferenciaA->vDocumento %></p>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Monto Transferido:</label>
                    <p class="col-md-8 form-control-static">{{<% $transferenciaA->iMontoTransferencia %> | currency: "₡":0}}</p>
                </div>
                <hr>
                <a href="/transferencia/<%$transferenciaA->idTransferencia%>" class="btn btn-info pull-right">Ver Más</a>
            </div>
            </div class="<%$count++%>">
            @endforeach
        </div>
        @if(count($transferenciasA)>0)
        <div class="col-md-6 <% $count = 0 %>">
            @else
            <div class="col-md-12 <% $count = 0 %>">
                @endif
                @if(count($transferenciasDe)>0)
                <h4>Reducciones</h4>
                @endif
                @foreach($transferenciasDe as $transferenciaDe)
                <div class="panel panel-danger" ng-init="verr<% $count%> = false">
                    <div class="panel-heading" style="height:70px">
                        <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!verr<%$count%>"
                            ng-click="verr<%$count%> = true">+</button>
                        <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="verr<%$count%>"
                            ng-click="verr<%$count%> = false">x</button>
                        <label  class="col-md-10 control-label">Fecha: <small><% $transferenciaDe->created_at %></small></label><br>
                        <label  class="col-md-10 control-label">Monto: <small>{{<% $transferenciaDe->iMontoTransferencia %> | currency: "₡":0 }}</small></label>
                    </div>
                    <div ng-if="verr<%$count %>" class="panel-body form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fecha de Transferencia: </label>
                            <p class="col-md-8 form-control-static"><% $transferenciaDe->created_at %></p>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Documento:</label>
                            <p class="col-md-8 form-control-static"><% $transferenciaDe->vDocumento %></p>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Monto Transferido:</label>
                            <p class="col-md-8 form-control-static">{{<% $transferenciaDe->iMontoTransferencia %> | currency: "₡":0}}</p>
                        </div>
                        <hr>
                        <a href="/transferencia/<%$transferenciaDe->idTransferencia%>" class="btn btn-info pull-right">Ver Más</a>
                    </div>
                    </div class="<%$count++%>">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@else
    Debe estar autenticado y tener permisos para ver esta pagina
@endif
@endsection