@extends('layouts.reporte')
@section('title', 'Reporte de Gasto')


@section('content')

<div class="col-md-10 col-md-offset-1" >
<br>
 	<table class="col-md-12 table table-responsive" ng-model="ver= true">
 	<button class="btn btn-lg btn-info" ng-init="ver=true" ng-click="ver = false" ng-if="ver" onclick="window.print()" >Informe de Gastos</button>
 		<h2><%$coordinacion->idCoordinacion%>-<%$coordinacion->vNombreCoordinacion%>
 			<small><%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%></small>
 		</h2>
 		<thead>
 			<tr>
 				<th>Partida</th>
 				<th>Presupuesto Inicial</th>
 				<th>Presupuesto Modificado</th>
 				<th>Gasto</th>
 				<th>Saldo</th>
	 			<th>Gasto %</th>
	 			<th>Saldo %</th>
 			</tr>
 		</thead>
 		<tbody>
 		@foreach($presupuestoPartida as $partida)
 			<tr>
 				<td class="alert alert-success"><% $partida->codPartida%>-<% $partida->vNombrePartida%></td>
 				<td class="alert alert-success">{{<% $partida->iPresupuestoInicial%> | currency: "₡":0}}</td>
 				<td class="alert alert-success">{{<% $partida->iPresupuestoModificado%> | currency: "₡":0}}</td>
 				<td class="alert alert-danger">{{<% $partida->iGasto%> | currency: "₡":0}}</td>
 				<td class="alert alert-info">{{<% $partida->iSaldo%> | currency: "₡":0}}</td>
 				<td class="alert alert-danger"><% round(($partida->iGasto/$partida->iPresupuestoModificado)*100,2) %></td>
 				<td class="alert alert-info"><% round(($partida->iSaldo/$partida->iPresupuestoModificado)*100,2) %></td>

 			</tr>
 			@endforeach
 		</tbody>
 	</table>
 </div> 

@endsection