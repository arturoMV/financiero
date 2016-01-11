@extends('/layouts.master')
@section('title', 'Partida')

@section('coord')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Ver Coordinacion')AND Auth::user()->tieneCoordinacion($coordinacion->idCoordinacion))
<section>
  <div class="wrapper">
    <h2>Detalles de la Unidad Ejecutora</h2>
    <form class="col-md-7 form-horizontal" action="/coordinacion/<%$coordinacion->idCoordinacion%>/edit" method="get"> 
      <div class="form-group">
        <label class="col-md-4 control-label">ID Unidad:</label>
        <p class="col-md-2 form-control-static"><%$coordinacion->idCoordinacion%></p>

      </div >

      <div class="form-group">
        <label class="col-md-4 control-label">Nombre Unidad:</label>
        <p class="col-md-8 form-control-static"><%$coordinacion->vNombreCoordinacion%></p> 
      </div>


      <div class="col-md-4 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Coordinacion', Auth::user()->id))
        <input type="submit" name="" class="btn btn-warning pull-right" value="Editar">
        @endif
      </div> 

    </form>
    <div class="col-md-12">
    <hr>
      <h3>Lista de presupuestos<small>
      <label class="pull-right"><input type="checkbox" name="" ng-model="expandir" ng-check="true" value="">Expandir Todo</label></small></h3>
    </div>

    <div <% $count = 0 %>>
      @foreach($presupuestos as $presupuesto)
      <div class="col-md-12" ng-init="ver<% $count%> = false">
        <div class="panel panel-primary" style="width: px">

          <div class="panel-heading" style="height: 45px">
            <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!ver<%$count%> && !expandir"
              ng-click="ver<%$count%> = true">+</button>
              <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="ver<%$count%> && !expandir"
                ng-click="ver<%$count%> = false">-</button>
                <label class="control-label">Nombre Presupuesto:<small><% $presupuesto->vNombrePresupuesto %>-<%$presupuesto->anno%></small></label>
              </div>
              <div ng-if="ver<%$count %> || expandir" class="animated-if form-horizontal panel-body">  
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
                    <a href="/presupuesto/<%$presupuesto->idPresupuesto%>" class="btn btn-info pull-right">Ver Más</a>  
                
                </div>
              </div>
            </div <% $count ++%>>
          </div>

          @endforeach
        </div>

    </section> 
    @else
    Debe estar autenticado y tener permisos para ver esta pagina
    @endif
    @endsection
