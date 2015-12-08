@extends('/layouts.master')
@section('title', 'Presupuesto')

@section('presupuesto')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Ver Presupuesto', Auth::user()->id))
<section>
  <div class="wrapper">
    <form class="col-md-7 form-horizontal" action="/financiero/public/presupuesto/<%$presupuesto->idPresupuesto%>/edit" method="get"> 
      <div class="form-group">
        <label class="col-md-4 control-label">ID Presupuesto</label>
        <p class="col-md-2 form-control-static"><%$presupuesto->idPresupuesto%></p>

      </div >

      <div class="form-group">
        <label class="col-md-4 control-label">Año</label>
        <p class="col-md-8 form-control-static"><%$presupuesto->anno%></p>

      </div>

      <div  class="form-group">
        <label class="col-md-4 control-label">Coordinacion:</label>
        <p class="col-md-8 form-control-static"><%$coordinacion->idCoordinacion%> - <%$coordinacion->vNombreCoordinacion%></p>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Nombre</label>
        <p class="col-md-8 form-control-static"><%$presupuesto->vNombrePresupuesto%></p>
      </div>


      <div class="form-group">
        <label class="col-md-4 control-label">Monto Presupuestado</label>
        <p class="col-md-8 form-control-static">{{<%$presupuesto->iPresupuestoInicial%> | currency: "₡":0}}</p>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Presupuesto con Modificaciones</label>
        <p class="col-md-8 form-control-static">{{<%$presupuesto->iPresupuestoModificado%> | currency: "₡":0}}</p>
      </div>

      <div class="col-md-7 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Presupuesto', Auth::user()->id))
        <input type="submit" name="" class="btn btn-warning" value="Editar">
        @endif
        @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Partida', Auth::user()->id))
        <a href="" class="btn btn-primary">Agregar Partida</a>
        @endif
      </div> 
    </form>
    <div class="col-md-12 <% $count = 0 %>">
      <hr>
      <h4>Lista de Partidas</h4>

      @foreach($partidas as $partida)

      <div class="panel panel-primary" ng-init="ver<% $count%> = false">
        <div class="panel-heading" style="height:40px">
          <label class="col-md-2 control-label">Partida:<small><% $partida->idPartida %></small></label>           
          <label class="col-md-8 control-label">Nombre:<small><% $partida->vNombrePartida %></small></label>

          <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!ver<%$count%>"
            ng-click="ver<%$count%> = true">+</button>
            <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="ver<%$count%>"
              ng-click="ver<%$count%> = false">x</button>

            </div>

            <div ng-if="ver<%$count %>" class="panel-body form-horizontal">  
              @if($partida->descripcion!="")
              <div class="form-group">
                <label class="col-md-4 control-label">Descripcion:</label>
                <p class="col-md-8 form-control-static"><%$partida->descripcion%></p>
              </div>
              @endif
              <hr>
              <h3>Estado de la partida</h3>
              <div class="">
                <h4>Presupuesto Incial: <small>{{<%$partida->iPresupuestoInicial%> | currency: "₡":0}}</small> <br>Gasto: <small>{{<%$partida->gasto%> | currency: "₡":0}} </small> <br>Saldo: <small>{{<%$partida->saldo%> | currency: "₡":0}}</small></h4>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-warning" style="width: <% $partida->calcularGastoPorcentaje() %>%">
                  <span class="sr-only"></span>
                  <% round($partida->calcularGastoPorcentaje(),2) %>%
                </div>
                <div class="progress-bar progress-bar-success" style="width: <% $partida->calcularSaldoPorcentaje()%>%">
                  <span class="sr-only"></span>
                  <% round($partida->calcularSaldoPorcentaje(),2) %>%
                </div>
              </div>
              <div class="alert alert-warning col-md-1 col-md-offset-4">
                Gasto: <%round( $partida->calcularGastoPorcentaje(),2) %>% <br>
              </div>

              <div class="alert alert-success col-md-1 col-md-offset-1">
                Saldo: <%round( $partida->calcularSaldoPorcentaje(),2) %>%
              </div>
              <a href="/financiero/public/partida/<%$partida->idPartida%>" class="btn btn-info pull-right">Ver Más</a>
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
