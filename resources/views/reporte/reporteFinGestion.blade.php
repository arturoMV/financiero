@extends('layouts.reporte')
@section('title', 'Reporte de Gasto')


@section('content')
@if(Auth::user() AND Auth::user()->tienePermiso('Ver Presupuesto')AND Auth::user()->tieneCoordinacion($coordinacion->idCoordinacion))

<div class="col-md-12" >
<br>
 	<table class="table table-bordered" ng-model="ver= true">
 	<button class="btn btn-lg btn-info" ng-init="ver=true" ng-click="ver = false" ng-if="ver" onclick="window.print()" >Informe de Gastos</button>
 		<h2><%$coordinacion->idCoordinacion%>-<%$coordinacion->vNombreCoordinacion%>
 			<small><%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%></small>
 		</h2>
 		<thead>
 			<tr>
 				<th>Partida</th>
 				<th <% $PI = 0 %> >Presupuesto Inicial</th>
 				<th <% $PM = 0 %>>Presupuesto Modificado</th>
 				<th <% $RCC = 0 %>>Reintegros de Caja chica</th>
 				<th <% $FP = 0 %>>Facturas Pendientes</th>
	 			<th <% $FC = 0 %>>Facturas Credito</th>
	 			<th <% $SG = 0 %>>Solicitudes GECO</th>
	 			<th <% $PAd = 0 %> >Pases Adicionales</th>
	 			<th <% $PAn = 0 %>>Pases Anulacion </th>
	 			<th <% $RPB = 0 %>>Requisiciones Paq. Basíco</th>
	 			<th <% $TA = 0 %>>Transferencias Aumentos</th>
	 			<th <% $TR = 0 %>>Transferencias Reducciones</th>
	 			<th <% $OS = 0 %>>Ordenes de Servicio</th>
	 			<th <% $O = 0 %>>Otros</th>
	 			<th <% $G = 0 %>>Gasto</th>
 				<th <% $S = 0 %>>Saldo</th>
	 			<th>Gasto %</th>
	 			<th>Saldo %</th>
 			</tr>
 		</thead>
 		<tbody <%$count = 0%>>
 		@foreach($presupuestoPartida as $partida)
 			<tr>
 				<td <% $parDetalles = $partida->getPartida() %>><% $parDetalles->codPartida%>-<% $parDetalles->vNombrePartida%></td>
 				<td <% $PI += $partida->iPresupuestoInicial%>>{{<% $partida->iPresupuestoInicial%> | currency: "₡":0}}</td>
 				<td <% $PM += $partida->iPresupuestoModificado%>>{{<% $partida->iPresupuestoModificado%> | currency: "₡":0}}</td>
 				<td <% $RCC += $partida->getTransaccionPorTipo('Reintegro de caja chica')%>>{{<% $partida->getTransaccionPorTipo('Reintegro de caja chica')%> | currency: "₡":0}}</td>
 				<td <% $FP += $partida->getTransaccionPorTipo('Factura pendiente')%>>{{<% $partida->getTransaccionPorTipo('Factura pendiente')%> | currency: "₡":0}}</td>
 				<td <% $FC += $partida->getTransaccionPorTipo('Factura credito')%>>{{<% $partida->getTransaccionPorTipo('Factura credito')%> | currency: "₡":0}}</td>
 				<td <% $SG += $partida->getTransaccionPorTipo('Solicitud GECO')%>>{{<% $partida->getTransaccionPorTipo('Solicitud GECO')%> | currency: "₡":0}}</td>
 				<td <% $PAd += $partida->getTransaccionPorTipo('Pases Adicionales')%>>{{<% $partida->getTransaccionPorTipo('Pases Adicionales')%> | currency: "₡":0}}</td>
 				<td <% $PAn += $partida->getTransaccionPorTipo('Pases Anulacion')%>>{{<% $partida->getTransaccionPorTipo('Pases Anulacion')%> | currency: "₡":0}}</td>
 				<td <% $RPB += $partida->getTransaccionPorTipo('Requisicion')%>>{{<% $partida->getTransaccionPorTipo('Requisicion')%> | currency: "₡":0}}</td>
 				<td <% $TA += $partida->getTransferenciasA()%>>{{<% $partida->getTransferenciasA()%> | currency: "₡":0}}</td>
 				<td <% $TR += $partida->getTransferenciasDe()%>>{{<% $partida->getTransferenciasDe()%> | currency: "₡":0}}</td>
 				<td <% $OS += $partida->getTransaccionPorTipo('Orden de servicio')%>>{{<% $partida->getTransaccionPorTipo('Orden de servicio')%> | currency: "₡":0}}</td>
				<td <% $O += $partida->getTransaccionPorTipo('Otros')%>>{{<% $partida->getTransaccionPorTipo('Otros')%> | currency: "₡":0}}</td>
				<td <% $G += $partida->iGasto + $partida->iReserva %>>{{<% $partida->iGasto + $partida->iReserva%> | currency: "₡":0}}</td>
 				<td <% $S += $partida->iSaldo%>>{{<% $partida->iSaldo%> | currency: "₡":0}}</td>
 				<td><% round((($partida->iGasto + $partida->iReserva)/$partida->iPresupuestoModificado)*100,2) %>%</td>
 				<td><% round(($partida->iSaldo/$partida->iPresupuestoModificado)*100,2) %>%</td>
 			</tr>
 			@endforeach
 				<th>Total</th>
 				<th>{{<% $PI %> | currency: "₡":0}}</th>
 				<th>{{<% $PM %> | currency: "₡":0}}</th>
 				<th>{{<% $RCC %> | currency: "₡":0}}</th>
 				<th>{{<% $FP %> | currency: "₡":0}}</th>
 				<th>{{<% $FC %> | currency: "₡":0}}</th>
 				<th>{{<% $SG %> | currency: "₡":0}}</th>
 				<th>{{<% $PAd %> | currency: "₡":0}}</th>
 				<th>{{<% $PAn %> | currency: "₡":0}}</th>
 				<th>{{<% $RPB %> | currency: "₡":0}}</th>
 				<th>{{<% $TA %> | currency: "₡":0}}</th>
 				<th>{{<% $TR %> | currency: "₡":0}}</th>
 				<th>{{<% $OS %> | currency: "₡":0}}</th>
 				<th>{{<% $O %> | currency: "₡":0}}</th>
 				<th>{{<% $G %> | currency: "₡":0}}</th>
 				<th>{{<% $S %> | currency: "₡":0}}</th>
	 			<th><% round(($G/$PM)*100,2) %>%</th>
	 			<th><% round(($S/$PM)*100,2) %>%</th>
 		</tbody>
 	</table>
 </div> 
@endif
@endsection