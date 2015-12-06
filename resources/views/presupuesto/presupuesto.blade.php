
@extends('layouts.master')
@section('title', 'Partida')

	
	@section('presupuesto')
		class="active"
	@endsection
	@section('content')
	@parent
	@if(Auth::user() AND Auth::user()->tienePermiso('Ver Presupuesto', Auth::user()->id))
	<section class="container-fluid" ng-controller="presupuestoTemplate"><br>
		<div class="container-fluid search-container form-horizontal">
			<div class="container-fluid">
				<input type="text" id="partidaName"  class="col-xs-6 col-md-6 col-lg-6 pull-left" placeholder="Digite para buscar" ng-model="search">
				@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Presupuesto', Auth::user()->id))
				<a href="/financiero/public/presupuesto/create" class="btn btn-success pull-right">Nuevo Presupuesto</a>
				@endif
			</div>
		</div>
		<div class="container-fluid table-responsive">
			<table class="table table-striped table-hover">
				<tbody>
					<tr >
						<th ng-click="orderTable('idPresupuesto')" style="cursor:pointer;">ID Presupuesto</th>
						<th ng-click="orderTable('tCoordinacion_idCoodinacion')" style="cursor:pointer;">Unidad Perteneciente<a href=""></a></th>
						<th ng-click="orderTable('vNombrePresupuesto')" style="cursor:pointer;">Nombre</th>
						<th></th>
						<th></th>
					</tr>
					<tr ng-repeat="presupuesto in modelPr | filter : search | orderBy : myOrder track by $index">
						<td>{{presupuesto.idPresupuesto}}-{{presupuesto.anno}}</td>
						<td>{{presupuesto.tCoordinacion_idCoordinacion}}</td>
						<td>{{presupuesto.vNombrePresupuesto}}</td>
						<td>
							<a href="/financiero/public/presupuesto/{{presupuesto.idPresupuesto}}"  class="btn btn-info" title="">Ver</a>
						</td>
						<td>
						@if(Auth::user() AND Auth::user()->tienePermiso('Editar Presupuesto', Auth::user()->id))
							<a href="/financiero/public/presupuesto/{{presupuesto.idPresupuesto}}/edit" class="btn btn-warning" title="">Editar</a>
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