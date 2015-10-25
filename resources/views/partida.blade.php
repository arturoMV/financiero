<!DOCTYPE html>
@extends('layouts.master')
<html ng-app="starter">
<head>
	@section('title', 'Partida')
</head>
<body>
	@section('content')
	@parent
	@if(Auth::user() AND Auth::user()->tienePermiso('partida_ver', Auth::user()->id))
	<section class="container-fluid" ng-controller="financieroTemplate"><br>
		<div class="container-fluid search-container form-horizontal">
			<div class="container-fluid">
				<input type="text" id="partidaName"  class="col-xs-6 col-md-6 col-lg-6 pull-left" placeholder="Digite para buscar" ng-model="search">
				<button class="btn btn-success crear-partida pull-right">Nueva Partida</button>
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
					<tr ng-repeat="partida in model | filter : search | orderBy : myOrder track by $index">
						<td>{{partida.idPartida}}</td>
						<td>{{partida.idPresupuesto}}</td>
						<td>{{partida.estado}}</td>
						<td>{{partida.saldo}}</td>
						<td>{{partida.descripcion}}</td>
						<td>
							<a href="/partida/{{partida.id}}"  class="btn btn-info" title="">Ver</a>
						</td>
						<td>
							<a href="/partida/{{partida.id}}/edit" class="btn btn-warning" title="">Editar</a>
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
</body>
</html>