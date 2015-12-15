@extends('layouts.reporte')
@section('title', 'Reporte de Gasto')


@section('content')

<div class="col-md-12" >
<br>
 	<table class="table" ng-model="ver= true">
 	<button class="btn btn-lg btn-info" ng-init="ver=true" ng-click="ver = false" ng-if="ver" onclick="window.print()" >Informe de Gastos</button>
 		<h2><%$coordinacion->idCoordinacion%>-<%$coordinacion->vNombreCoordinacion%>
 			<small><%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%></small>
 		</h2>
 		<thead>
 			<tr>
 				<th>Partida</th>
 				<th>Presupuesto Inicial</th>
 				<th>Presupuesto Modificado</th>
 				<th>Reintegros de Caja chica</th>
 				<th>Facturas Pendientes</th>
	 			<th>Facturas Credito</th>
	 			<th>Solicitudes GECO</th>
	 			<th>Pases Adicionales</th>
	 			<th>Pases Anulacion </th>
	 			<th>Requisiciones Paq. Basíco</th>
	 			<th>Transferencias Aumentar</th>
	 			<th>Transferencias Rebajar</th>
	 			<th>Ordenes de Servicio</th>
	 			<th>Otros</th>
	 			<th>Gasto</th>
 				<th>Saldo</th>
	 			<th>Gasto %</th>
	 			<th>Saldo %</th>

 			</tr>
 		</thead>
 		<tbody>
 		@foreach($presupuestoPartida as $partida)
 			<tr>
 				<td <% $parDetalles = $partida->getPartida() %>><% $parDetalles->codPartida%>-<% $parDetalles->vNombrePartida%></td>
 				<td>{{<% $partida->iPresupuestoInicial%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->iPresupuestoModificado%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Reintegro de caja chica')%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Factura pendiente')%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Factura credito')%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Solicitud GECO')%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Pases Adicionales')%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Pases Anulacion')%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Requisicion')%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransferenciasA()%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransferenciasDe()%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->getTransaccionPorTipo('Orden de servicio')%> | currency: "₡":0}}</td>
				<td>{{<% $partida->getTransaccionPorTipo('Otros')%> | currency: "₡":0}}</td>
				<td>{{<% $partida->iGasto%> | currency: "₡":0}}</td>
 				<td>{{<% $partida->iSaldo%> | currency: "₡":0}}</td>
 				<td><% round(($partida->iGasto/$partida->iPresupuestoModificado)*100,2) %></td>
 				<td><% round(($partida->iSaldo/$partida->iPresupuestoModificado)*100,2) %></td>
 			</tr>
 			@endforeach
 		</tbody>
 	</table>
 </div> 

@endsection