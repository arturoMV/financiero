<!DOCTYPE html>
@extends('layouts.master')
<html ng-app="starter">
<head>
	@section('title', 'Partida')
</head>
<body>
	@section('content')
	@parent
	<section class="container-fluid" ng-controller="financieroTemplate">
		<div class="container-fluid search-container">
			<label for="partidaName" class="col-lg-12 col-md-12 col-xs-12 search">Search Partida:</label>
			<input type="text" id="partidaName"  placeholder="escriba algo para buscar" ng-model="search">
		</div>
		<div class="container-fluid table-responsive">
			<table class="table table-striped">
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
							<button class="btn btn-success">Ver</button>
						</td>
						<td>
							<button class="btn btn-danger">Editar</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>
	@endsection
</body>
</html>