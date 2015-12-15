@extends('/layouts.master')
  @section('title', 'Partida')

  @section('partida')
    class="active"
  @endsection
  @section('content')
  @parent
    @if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida')AND Auth::user()->tieneCoordinacion($coordinacion->idCoordinacion))
    <section>
    <div class="wrapper">
      <form class="col-md-12 form-horizontal" action="/financiero/public/partida/<% $presupuesto_partida->id %>/edit" method="get">
        <h2>Detalles de la partida</h2>

      <div class="form-group">
        <label class="col-md-4 control-label">Unidad Ejecutora</label>
        <p class="col-md-8 form-control-static">
        <a href="/financiero/public/coordinacion/<%$coordinacion->idCoordinacion%>" title="">
        <%$coordinacion->idCoordinacion%>-<% $coordinacion->vNombreCoordinacion %></a></p>         
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Presupuesto</label>
        <p class="col-md-8 form-control-static">
        <a href="/financiero/public/presupuesto/<%$presupuesto->idPresupuesto%>" title=""><%$presupuesto->vNombrePresupuesto%> - 
        <%$presupuesto->anno%></a></p>         
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
        <label class="col-md-4 control-label">Descripcion:</label>
          <p class="col-md-8 form-control-static"><%$partida->vDescripcion%></p>
      </div>
      @endif

       <div class="col-md-6 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
          <input type="submit" name="" class="btn btn-warning" value="Editar">
        @endif

         @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
         <a href="/financiero/public/transaccion/create/<%$presupuesto_partida->id%>" name="" class="btn btn-primary">Agregar Transaccion</a>
        @endif
      </div> 
             
    </form>
    <div class="col-md-12">
      <hr>
  <h3>Estado de la partida</h3>
<div class="">
  <h4>Presupuesto Incial: <small>{{<%$presupuesto_partida->iPresupuestoInicial%> | currency: "₡":0}}</small><br>
  Presupuesto Modificado: <small>{{<%$presupuesto_partida->iPresupuestoModificado%> | currency: "₡":0}}</small> <br>
  Gasto: <small>{{<%$presupuesto_partida->iGasto%> | currency: "₡":0}} </small> <br>
  Saldo: <small>{{<%$presupuesto_partida->iSaldo%> | currency: "₡":0}}</small></h4>
</div>
<div class="progress">
  <div class="progress-bar progress-bar-danger" style="width: <% $presupuesto_partida->calcularGastoPorcentaje() %>%">
    <span class="sr-only"></span>
    <% round($presupuesto_partida->calcularGastoPorcentaje(),2) %>%
  </div>
  <div class="progress-bar progress-bar-primary" style="width: <% $presupuesto_partida->calcularSaldoPorcentaje()%>%">
    <span class="sr-only"></span>
    <% round($presupuesto_partida->calcularSaldoPorcentaje(),2) %>%
  </div>
</div>
<div class="alert alert-danger col-md-1 col-md-offset-4">
  Gasto: <% round($presupuesto_partida->calcularGastoPorcentaje(),2) %>% <br>
</div>

<div class="alert alert-info col-md-1 col-md-offset-1">
  Saldo: <% round($presupuesto_partida->calcularSaldoPorcentaje(),2) %>%
</div>
@if(count($transacciones)>0)
<div class="col-md-12 <% $count = 0 %>">
      <hr>
      <h4>Lista de Transacciones</h4>

      @foreach($transacciones as $transaccion)

      <div class="panel panel-primary" ng-init="ver<% $count%> = false">
        <div class="panel-heading" style="height:40px">
          <label  class="col-md-3 control-label">Num transacción: <small><% $transaccion->idFactura %></small></label>           
          <label  class="col-md-4 control-label">Tipo: <small><% $transaccion->vTipoFactura %></small></label>
          <label  class="col-md-4 control-label">Monto: <small>{{<% $transaccion->iMontoFactura %> | currency: "₡":0 }}</small></label>
          <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!ver<%$count%>"
            ng-click="ver<%$count%> = true">+</button>
            <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="ver<%$count%>"
              ng-click="ver<%$count%> = false">x</button>
            </div>
            <div ng-if="ver<%$count %>" class="panel-body form-horizontal">  
             <div class="form-group">
                <label class="col-md-4 control-label">Num transacción:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->idFactura %></p>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Tipo de transacción: </label>
                <p class="col-md-8 form-control-static"><% $transaccion->vTipoFactura %></p>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Partida:</label>
                <p class="col-md-8 form-control-static"><% $partida->codPartida %></p>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Monto:</label>
                <p class="col-md-8 form-control-static">{{<% $transaccion->iMontoFactura %> | currency: "₡":0 }}</p>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Fecha:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->dFechaFactura %></p>
              </div>

              @if($transaccion->vDocumento!="No Aplica")
              <div class="form-group">
                <label class="col-md-4 control-label">Documento:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->vDocumento %></p>
              </div>
              @endif

              @if($transaccion->vDescripcionFactura!="")
              <div class="form-group">
                <label class="col-md-4 control-label">Documento:</label>
                <p class="col-md-8 form-control-static"><% $transaccion->vDescripcionFactura %></p>
              </div>
              @endif
              <hr>
              <a href="/financiero/public/transaccion/<%$transaccion->idFactura%>" class="btn btn-info pull-right">Ver Más</a>
            </div>
          </div class="<%$count++%>">
          @endforeach
        </div>
  @endif    
    </div>
    </div>
      </section> 
    @else
      Debe estar autenticado y tener permisos para ver esta pagina
    @endif
  @endsection
