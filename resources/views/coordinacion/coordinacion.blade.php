
@extends('layouts.master')
@section('title', 'Coordinacion')

	
	@section('coord')
		class="active"
	@endsection
	@section('content')
	@parent

	@if(Auth::user() AND Auth::user()->tienePermiso('Ver Coordinacion', Auth::user()->id))
	<section class="container-fluid" ng-controller="coordinacionTemplate"><br>
		<div class="container-fluid search-container form-horizontal">
			<div class="container-fluid">
				<input type="text" id="coordinacionName"  class="col-xs-6 col-md-6 col-lg-6 pull-left" placeholder="Digite para buscar" ng-model="search">
				@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Coordinacion', Auth::user()->id))
				<a href="/coordinacion/create" class="btn btn-success pull-right">Nueva Coordinacon</a>
				@endif
			</div>
						<th class="col-md-1"></th>
						<th class="col-md-1"></th>
		</div>
		<div class="container-fluid table-responsive">
			<table class="table table-striped table-hover">
				<tbody>
					<tr >
						<th ng-click="orderTable('idCoordinacion')" style="cursor:pointer;">ID Coordinacon</th>
						<th ng-click="orderTable('vNombreCoordinacion')" style="cursor:pointer;">Nombre</th>
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
		Debe estar autenticado y tener permisos para ver esta seccion
	@endif
	@endsection