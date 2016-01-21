
@extends('layouts.master')
@section('title', 'Coordinacion')

	
	@section('coord')
		class="active"
	@endsection
	@section('content')
	@parent

	@if(Auth::user() AND Auth::user()->tienePermiso('Ver Coordinacion'))
	<section class="container-fluid" ng-controller="coordinacionTemplate"><br>
		<div class="container-fluid search-container form-horizontal">
		<h2>Lista de Unidades Ejecutoras</h2>

		@if (count($mensaje) > 0)
    <div class="alert alert-success">
      <strong>Bien!</strong>Se realizaron cambios<br><br>
      <ul>
        <li><% $mensaje %></li>
      </ul>
    </div> 
    @endif
			<div class="container-fluid">
			<div class="col-md-4">
				
				<input type="text" id="coordinacionName"  class="col-md-6 pull-left form-control" placeholder="Digite para buscar" ng-model="search">
			</div>
				@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Coordinacion', Auth::user()->id))
				<a href="/coordinacion/create" class="btn btn-success pull-right">Nueva Coordinación</a>
				@endif
			</div>
		</div>
		<div class="container-fluid table-responsive">
				<table class="table table-striped table-hover">
					<tbody>
						<tr >
							<th ng-click="orderTable('idCoordinacion')" style="cursor:pointer;">Unidad Ejecutora</th>
							<th ng-click="orderTable('vNombreCoordinacion')" style="cursor:pointer;">Nombre</th>
							<th></th>
							@if(Auth::user() AND Auth::user()->tienePermiso('Editar Coordinacion', Auth::user()->id))

							<th></th>
							@endif
						</tr>
						<tr ng-repeat="coordinacion in modelC | filter : search | orderBy : myOrder track by $index">
							<td>{{coordinacion.idCoordinacion}}</td>
							<td>{{coordinacion.vNombreCoordinacion}}</td>
							
							<td>
								<a href="/coordinacion/{{coordinacion.idCoordinacion}}"  class="btn btn-info" title="">Ver</a>
							</td>
							<td>
							@if(Auth::user() AND Auth::user()->tienePermiso('Editar Coordinacion', Auth::user()->id))
								<a href="/coordinacion/{{coordinacion.idCoordinacion}}/edit" class="btn btn-warning" title="">Editar</a>
							@endif
							</td>
						</tr>
					</tbody>
				</table>
		</div>
</section>
	@else
		Debe estar autenticado y tener permisos para ver esta sección
	@endif
	@endsection