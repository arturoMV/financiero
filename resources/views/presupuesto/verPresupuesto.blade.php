@extends('/layouts.master')
@section('title', 'Presupuesto')

@section('presupuesto')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Ver Presupuesto')AND Auth::user()->tieneCoordinacion($coordinacion->idCoordinacion))
<section>
  <div class="wrapper">
    <form class="col-md-12 form-horizontal" action="/financiero/public/presupuesto/<%$presupuesto->idPresupuesto%>/edit" method="get"> 
    <h2>Detalles del Presupuesto</h2>
      
      <div  class="form-group">
        <label class="col-md-4 control-label">Coordinacion:</label>
        <p class="col-md-8 form-control-static"><%$coordinacion->idCoordinacion%> - <%$coordinacion->vNombreCoordinacion%></p>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Presupuesto</label>
        <p class="col-md-8 form-control-static"><%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%></p>
      </div>


      <h3>Estado del Presupuesto</h3>
              <div class="">
                <h4>Presupuesto Incial: <small>{{<%$presupuesto->iPresupuestoInicial%> | currency: "₡":0}}</small> <br>
                Presupuesto con Transferencias: <small>{{<%$presupuesto->iPresupuestoModificado%> | currency: "₡":0}}</small> <br>Gasto: <small>{{<%$presupuesto->iGasto%> | currency: "₡":0}} </small> <br>Saldo: <small>{{<%$presupuesto->iSaldo%> | currency: "₡":0}}</small></h4>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-danger" style="width: <% $presupuesto->calcularGastoPorcentaje() %>%">
                  <span class="sr-only"></span>
                  <% round($presupuesto->calcularGastoPorcentaje(),2) %>%
                </div>
                <div class="progress-bar progress-bar-primary" style="width: <% $presupuesto->calcularSaldoPorcentaje()%>%">
                  <span class="sr-only"></span>
                  <% round($presupuesto->calcularSaldoPorcentaje(),2) %>%
                </div>
              </div>
              <div class="alert alert-warning col-md-1 col-md-offset-4">
                Gasto: <%round( $presupuesto->calcularGastoPorcentaje(),2) %>% <br>
              </div>

              <div class="alert alert-info col-md-1 col-md-offset-1">
                Saldo: <%round( $presupuesto->calcularSaldoPorcentaje(),2) %>%
              </div>

      <div class="col-md-12 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Presupuesto', Auth::user()->id))
        <input type="submit" name="" class="btn btn-warning" value="Editar">
        @endif
        @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Partida', Auth::user()->id))
        <a href="/financiero/public/partida/<%$presupuesto->idPresupuesto%>/agregar" class="btn btn-primary">Agregar Partida</a>
        @endif
        <a href="/financiero/public/presupuesto/informe-gastos/<%$presupuesto->idPresupuesto%>" target="_blank" class="btn btn-info">Informe de Gastos</a>
        <a href="/financiero/public/presupuesto/informe-fin-gestion/<%$presupuesto->idPresupuesto%>" target="_blank" class="btn btn-info">Informe de fin de Gestion</a>

        
      </div> 
    </form>
    <div class="col-md-12 <% $count = 0 %>">
      <hr>
      <h4>Lista de Partidas</h4>

      @foreach($partidas as $partida)
        
        <div ng-hide="true">
          <% $p=App\Partida::find($partida->tPartida_idPartida) %>
        </div>

      <div class="panel panel-primary" ng-init="ver<% $count%> = false">
        <div class="panel-heading" style="height:40px">
          <label ng-show="!ver<%$count%>" class="col-md-4 control-label">Partida: <small><% $p->codPartida %></small></label>           
          <label ng-show="!ver<%$count%>" class="col-md-6 control-label">Nombre: <small><% $p->vNombrePartida %></small></label>
          <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!ver<%$count%>"
            ng-click="ver<%$count%> = true">+</button>
            <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="ver<%$count%>"
              ng-click="ver<%$count%> = false">x</button>
            </div>
            <div ng-if="ver<%$count %>" class="panel-body form-horizontal">  
             <div class="form-group">
                <label class="col-md-4 control-label">Partida:</label>
                <p class="col-md-8 form-control-static"><%$p->codPartida%></p>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Nombre:</label>
                <p class="col-md-8 form-control-static"><%$p->vNombrePartida%></p>
              </div>

              @if($p->vDescripcion!="")
              <div class="form-group">
                <label class="col-md-4 control-label">Descripcion:</label>
                <p class="col-md-8 form-control-static"><%$p->vDescripcion%></p>
              </div>
              @endif
              <hr>
              <h3>Estado de la partida</h3>
              <div class="">
                <h4>Presupuesto Incial: <small>{{<%$partida->iPresupuestoInicial%> | currency: "₡":0}}</small> <br>Gasto: <small>{{<%$partida->iGasto%> | currency: "₡":0}} </small> <br>Saldo: <small>{{<%$partida->iSaldo%> | currency: "₡":0}}</small></h4>
              </div>
              <div class="progress $presupuesto_partida->presupuestoModificado();
">
                <div class="progress-bar progress-bar-danger" style="width: <% $partida->calcularGastoPorcentaje() %>%">
                  <span class="sr-only"></span>
                  <% round($partida->calcularGastoPorcentaje(),2) %>%
                </div>
                <div class="progress-bar progress-bar-primary" style="width: <% $partida->calcularSaldoPorcentaje()%>%">
                  <span class="sr-only"></span>
                  <% round($partida->calcularSaldoPorcentaje(),2) %>%
                </div>
              </div>
              <div class="alert alert-danger col-md-1 col-md-offset-4">
                Gasto: <%round( $partida->calcularGastoPorcentaje(),2) %>% <br>
              </div>

              <div class="alert alert-info col-md-1 col-md-offset-1">
                Saldo: <%round( $partida->calcularSaldoPorcentaje(),2) %>%
              </div>
              <a href="/financiero/public/partida/<%$partida->id%>" class="btn btn-info pull-right">Ver Más</a>
            </div>
          </div class="<%$count++%>">
          @endforeach
        </div>
      </div>

    </section> 
    @else
    Debe estar autenticado y tener permisos para ver esta pagina
    @endif
    @endsection
