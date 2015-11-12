
@extends('layouts.master')
@section('title', 'Partida')

	
	@section('partida')
		class="active"
	@endsection
	@section('content')
	@parent
	<script src="{!! asset('js/controllers/partidaTemplate.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/partidas.js') !!}"  type="text/javascript"></script>

	@if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida', Auth::user()->id))
	<section class="container-fluid" ng-controller="partidaTemplate"><br>
		<div class="container-fluid search-container form-horizontal">
			<div class="container-fluid">
				<input type="text" id="partidaName"  class="col-xs-6 col-md-6 col-lg-6 pull-left" placeholder="Digite para buscar" ng-model="search">
				<a href="/partida/create" class="btn btn-success crear-partida pull-right">Nueva Partida</a>
			</div>
		</div>
		<div class="container-fluid table-responsive">
			<table class="table table-striped table-hover">
				<tbody>
					<tr >
						<th ng-click="orderTable('idPartida')" style="cursor:pointer;">ID Partida</th>
						<th ng-click="orderTable('idPresupuesto')" style="cursor:pointer;">ID Presupuesto</th>
						<th ng-click="orderTable('estado')" style="cursor:pointer;">Estado</th>
						<th ng-click="orderTable('saldo')" style="cursor:pointer;">Saldo</th>
						<th ng-click="orderTable('descripcion')" style="cursor:pointer;">Descripción</th>
						<th></th>
						<th></th>
					</tr>
					<tr ng-repeat="partida in modelP | filter : search | orderBy : myOrder track by $index">
						<td>{{partida.idPartida}}</td>
						<td>{{partida.idPresupuesto}}</td>
						<td>{{partida.estado}}</td>
						<td>{{partida.saldo}}</td>
						<td>{{partida.descripcion}}</td>
						<td>
							<a href="/partida/{{partida.id}}"  class="btn btn-info" title="">Ver</a>
						</td>
						<td>
						@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
							<a href="/partida/{{partida.id}}/edit" class="btn btn-warning" title="">Editar</a>
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