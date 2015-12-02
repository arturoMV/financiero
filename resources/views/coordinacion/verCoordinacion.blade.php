@extends('/layouts.master')
	@section('title', 'Partida')

  @section('partida')
    class="active"
  @endsection
	@section('content')
	@parent
    @if(Auth::user() AND Auth::user()->tienePermiso('Ver Coordinacion', Auth::user()->id))
  	<section>
  	<div class="wrapper">
        	<form class="col-md-7 form-horizontal" action="/coordinacion/<%$coordinacion->idCoordinacion%>/edit" method="get"> 
        <div class="form-group">
          <label class="col-md-4 control-label">ID Coordinacion:</label>
          <p class="col-md-2 form-control-static"><%$coordinacion->idCoordinacion%></p>
       
      </div >

      <div class="form-group">
        <label class="col-md-4 control-label">Nombre Coordinacion:</label>
        <p class="col-md-8 form-control-static"><%$coordinacion->vNombreCoordinacion%></p> 
      </div>


       <div class="col-md-4 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Coordinacion', Auth::user()->id))
          <input type="submit" name="" class="btn btn-warning pull-right" value="Editar">
        @endif
      </div> 
      
    	</form>
      <div class="col-md-12 <% $count = 0 %>">
        <hr>
        <h4>Lista de presupuestos</h4>
        @foreach($presupuestos as $presupuesto)
        <div class="col-md-10 col-md-offset-1 alert bg-info" ng-init="ver<% $count%> = false">
          
          <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!ver<%$count%>"
           ng-click="ver<%$count%> = true">Ver más</button>
          <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="ver<%$count%>"
          ng-click="ver<%$count%> = false">Ocultar</button>
          <div ng-if="!ver<%$count %>">
            <label class="col-md-2 control-label">ID:<small><% $presupuesto->idPresupuesto %></small></label>
            <label class="col-md-6 control-label">Nombre Presupuesto:<small><% $presupuesto->vNombrePresupuesto %>
            </small></label>
          </div>
          <div ng-if="ver<%$count %>" class="animated-if form-horizontal col-md-12">  
            <div class="form-group">
                <label class="col-md-4 control-label">ID Presupuesto:</label>
                <p class="col-md-2 form-control-static"><%$presupuesto->idPresupuesto%></p>
             
            </div >

            <div class="form-group">
              <label class="col-md-4 control-label">Nombre Presupuesto:</label>
              <p class="col-md-8 form-control-static"><% $presupuesto->vNombrePresupuesto %></p> 
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Informacion Adicional</label>
              <p class="col-md-8 form-control-static">This total conversion mod's goals are to expand end-game content for players, providing an economy, currency, and shops, as well some enhanced dinosaurs and a few all-new ones. It's currently best played in single-player, but there is a dedicated server running it for multiplay as well. </p> 
            </div>
          </div>
        </div>
      </div>
        

        @endforeach
      </div>

  	</div>
  	</section> 
    @else
      Debe estar autenticado y tener permisos para ver esta pagina
    @endif
  @endsection
