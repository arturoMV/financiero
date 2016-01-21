@extends('layouts.reporte')
@section('title', 'Reporte de Gasto')


@section('content')

<div class="col-md-10 col-md-offset-1" >
<br>
 	<button class="btn btn-lg btn-info" onclick="window.print()" >Informe de Gastos</button>
 		<h2><%$coordinacion->idCoordinacion%>-<%$coordinacion->vNombreCoordinacion%>
 			<small>
 					<%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%><br> 
 					<small><%$partida->codPartida%> - <% $partida->vNombrePartida %></small>
			</small>
 		</h2>
 
		  <h3>Estado de la partida</h3>
<div>
  <h4>Presupuesto Incial: <small>{{<%$presupuesto_partida->iPresupuestoInicial%> | currency: "₡":0}}</small>
  <br>
  Presupuesto Modificado: <small>{{<%$presupuesto_partida->iPresupuestoModificado%> | currency: "₡":0}}</small> <br>
  Gasto: <small>{{<%$presupuesto_partida->iGasto%> | currency: "₡":0}} </small> <br>
  @if($presupuesto_partida->iReserva>0)
  Reserva (GECO): <small>{{<%$presupuesto_partida->iReserva%> | currency: "₡":0}} </small> <br>
  @endif
  Saldo: <small>{{<%$presupuesto_partida->iSaldo%> | currency: "₡":0}}</small></h4>
</div>
<div class="progress">
  <div class="progress-bar progress-bar-danger" style="width: <% $presupuesto_partida->calcularGastoPorcentaje() %>%">
    <span class="sr-only"></span>
    <% round($presupuesto_partida->calcularGastoPorcentaje(),2) %>%
  </div>
  <div class="progress-bar progress-bar-warning" style="width: <% $presupuesto_partida->calcularReservaPorcentaje()%>%">
    <span class="sr-only"></span>
    <% round($presupuesto_partida->calcularReservaPorcentaje(),2) %>%
  </div>
  <div class="progress-bar progress-bar-primary" style="width: <% $presupuesto_partida->calcularSaldoPorcentaje()%>%">
    <span class="sr-only"></span>
    <% round($presupuesto_partida->calcularSaldoPorcentaje(),2) %>%
  </div>
</div>
<div class="alert alert-danger col-md-1 col-md-offset-4">
  Gasto: <% round($presupuesto_partida->calcularGastoPorcentaje(),2) %>% <br>
</div>
@if($presupuesto_partida->iReserva>0)
<div class="alert alert-warning col-md-1 col-md-offset-1">
  Reserva: <% round($presupuesto_partida->calcularReservaPorcentaje(),2) %>% <br>
</div>
@endif

<div class="alert alert-info col-md-1 col-md-offset-1">
  Saldo: <% round($presupuesto_partida->calcularSaldoPorcentaje(),2) %>%
</div>
<div ng-controller="transaccionTemplate"  ng-init="transaccionTemplate.Total = 0">
	
<div class="col-md-12 form-inline" >

<div class="container-fluid search-container form-horizontal">
 <div class="col-md-12">	
				<div class="form-group">
					<label class="control-label">Buscar</label>
					<input type="text" class="form-control"  placeholder="Digite para buscar" ng-model="search" >
				</div>
			</div>
</div>
	<div class="form-group">
		<label class="control-label" ng-init="fechaInicio = '2015-01-01'">Fecha Inicio</label>
			<input type="date" class="form-control" ng-value="fechaInicio" ng-model="fechaInicio" max="<%date('Y-m-d')%>">
	</div>

	<div class="form-group">
		<label class="control-label" ng-init="fechaFin = '<%date('Y-m-d')%>'">Fecha Fin</label>
			<input type="date" class="form-control" value="<%date('Y-m-d')%>" max="<%date('Y-m-d')%>" ng-model="fechaFin" >
	</div>

	<div class="form-group">
		<label class="control-label">Tipo de Transacción</label>
			<select class="form-control"  ng-model="data.select" ng-change="todos=false">
				<option value="Factura credito">Factura Credito</option>
	            <option value="Factura pendiente">Factura Pendiente</option>
	            <option value="Reintegro de caja chica" >Reintegro de caja chica</option>
	            <option value="Solicitud GECO" >Solicitud GECO</option>
	            <option value="Pases Adicionales" >Pases adicionales</option>
	            <option value="Pases Anulacion" >Pases anulacion</option>
	            <option value="Requisicion" >Requesicion Paq. Basico</option>
	            <option value="Orden de servicio" >Ordenes de Servicio</option>
	            <option value="Otros" >Otros</option>			
			</select>
		</div>
		<label ng-init="todos=false">
			Seleccionar Todos
			<input type="checkbox" ng-model="todos" >
		</label>
	</div >

	<div class="col-md-12" style="height: 500px"  >
	<br> <br>{{fechaFin}} <br> 
		<table class="table table-striped table-hover">
				<tbody>
					<tr>
						<th ng-click="orderTable('vTipoFactura');transaccionTemplate.Total = 0" style="cursor:pointer;">Tipo</th>
						<th ng-click="orderTable('dFechaFactura');transaccionTemplate.Total = 0" style="cursor:pointer;">Fecha</th>
						<th ng-click="orderTable('vDocumento');transaccionTemplate.Total = 0" style="cursor:pointer;">Documento</th>
						<th ng-click="orderTable('vDescripcionFactura');transaccionTemplate.Total = 0" style="cursor:pointer;">Obsevacion</th>
						<th ng-click="orderTable('vDetalleFactura');transaccionTemplate.Total = 0" style="cursor:pointer;">Detalle de Compra</th>
						<th ng-click="orderTable('iMontoFactura');transaccionTemplate.Total = 0" style="cursor:pointer;">Monto</th>

					</tr>
					<tr ng-repeat="transaccion in modelTra | filter : search | orderBy : myOrder track by $index" 
					ng-if="transaccion.tPartida_idPartida == <% $presupuesto_partida->id %> && 
					(data.select == transaccion.vTipoFactura || todos) &&
					(transaccion.dFechaFactura | date:'yyyy-M-dd') >= (fechaInicio | date:'yyyy-M-dd') && 
					(transaccion.dFechaFactura | date:'yyyy-M-dd') <= (fechaFin | date:'yyyy-M-dd')">
				
						<td>{{transaccion.vTipoFactura}}</td>
						<td>{{transaccion.dFechaFactura	}}</td>
						<td>{{transaccion.vDocumento}}</td>
						<td>{{transaccion.vDescripcionFactura}}</td>
						<td>{{transaccion.vDetalleFactura}}</td>
						<td ng-init="tot = transaccion.iMontoFactura; transaccionTemplate.Total = transaccionTemplate.Total + tot">{{transaccion.iMontoFactura | currency:"₡":0}}</td>
					</tr>
					
				</tbody>
			</table>
	</div>
	</div></div>


@endsection