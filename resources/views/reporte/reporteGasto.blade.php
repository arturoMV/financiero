@extends('layouts.reporte')
@section('title', 'Reporte de Gasto')


@section('content')

<div class="col-md-10 col-md-offset-1" >
<br>
 	<table class="col-md-12 table table-responsive table-bordered">
 	<button class="btn btn-lg btn-info"  onclick="window.print()" >Informe de Gastos</button>
 		<h2><%$coordinacion->idCoordinacion%>-<%$coordinacion->vNombreCoordinacion%>
 			<small><%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%></small>
 		</h2>
 		<thead>
 			<tr>
 				<th>Partida</th>
 				<th <% $PI = 0 %>>Presupuesto Inicial</th>
 				<th <% $PM = 0 %>>Presupuesto Modificado</th>
 				<th <% $G = 0 %>>Gasto</th>
 				<th <% $S = 0 %>>Saldo</th>
	 			<th>Gasto %</th>
	 			<th>Saldo %</th>
 			</tr>
 		</thead>
 		<tbody>
 		@foreach($presupuestoPartida as $partida)
 			<tr>
 				<td class="alert alert-success"><% $partida->codPartida%>-<% $partida->vNombrePartida%></td>
 				<td <% $PI += $partida->iPresupuestoInicial %> class="alert alert-success">{{<% $partida->iPresupuestoInicial%> | currency: "₡":0}}</td>
 				<td <% $PM += $partida->iPresupuestoModificado %> class="alert alert-success">{{<% $partida->iPresupuestoModificado%> | currency: "₡":0}}</td>
 				<td <% $G += $partida->iGasto + $partida->iReserva%> class="alert alert-danger">{{<% $partida->iGasto + $partida->iReserva%> | currency: "₡":0}}</td>
 				<td <% $S += $partida->iSaldo %> class="alert alert-info">{{<% $partida->iSaldo%> | currency: "₡":0}}</td>
 				<td class="alert alert-danger"><% round((($partida->iGasto+ $partida->iReserva) /$partida->iPresupuestoModificado)*100,2) %>%</td>
 				<td class="alert alert-info"><% round(($partida->iSaldo/$partida->iPresupuestoModificado)*100,2) %>%</td>

 			</tr>
 			@endforeach
 			<tr>
 				<th>Total</th>
 				<th>{{<% $PI %>| currency: "₡":0}}</th>
 				<th>{{<% $PM %>| currency: "₡":0}}</th>
 				<th>{{<% $G %>| currency: "₡":0}}</th>
 				<th>{{<% $S %>| currency: "₡":0}}</th>
 				<th><% round(($G/$PM)*100,2) %>%</th>
 				<th><% round(($S/$PM)*100,2) %>%</th>
 				

 			</tr>
 		</tbody>
 	</table>
 </div> 

@endsection