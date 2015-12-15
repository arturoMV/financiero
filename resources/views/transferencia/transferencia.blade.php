
@extends('layouts.master')
@section('title', 'Partida')


@section('transferencia')
class="active"
@endsection
@section('content')
@parent

@if(Auth::user() AND Auth::user()->tienePermiso('Ver Transferencia', Auth::user()->id))
<section class="container-fluid" ng-controller="transferenciaTemplate"><br>
<h3>Historial de transferencias</h3>
<h4> Estos datos corrensponden a los de la partida a la cual se transfirio presupuesto</h4>
	@if (count($errors)>0)
	<div class="alert alert-danger">
		<strong>Ops! </strong>No se pudo eliminar Paritda<br><br>
		<ul>
			@foreach($errors as $error)
			<li><% $error %></li>
			@endforeach
		</ul>
	</div> 
	@endif 

	<div class="container-fluid search-container form-horizontal">
		<div class="container-fluid">
			<input type="text" id="partidaName"  class="col-xs-6 col-md-6 col-lg-6 pull-left" placeholder="Digite para buscar" ng-model="search">
			@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Transferencia', Auth::user()->id))
			<a href="/financiero/public/create/transferencia" class="btn btn-success crear-partida pull-right">Nueva Transferencia</a>
			@endif
		</div>
	</div>
	<div class="container-fluid table-responsive">
		<table class="table table-striped table-hover">
			<tbody>
				<tr >
					<th ng-click="orderTable('idCoordinacion')" style="cursor:pointer;">Unidad Ejecutora</th>
					<th ng-click="orderTable('vNombrePresupuesto')" style="cursor:pointer;">Presupuesto</th>
					<th class="col-md-2" ng-click="orderTable('codPartida')" style="cursor:pointer;">Partida</th>
					<th ng-click="orderTable('vDocumento')" style="cursor:pointer;">Documento de transferencia</th>
					<th ng-click="orderTable('iMontotranseferencia')" style="cursor:pointer;">Monto Transferido</th>

					<th></th>
					@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
					<th></th>
					@endif

				</tr>
				<tr ng-repeat="transferencia in modelT | filter : search | orderBy : myOrder track by $index">
					<td>{{transferencia.idCoordinacion}}-{{transferencia.vNombreCoordinacion}} </td>
					<td>{{transferencia.vNombrePresupuesto}}-{{transferencia.anno}}</td>
					<td>{{transferencia.codPartida}}</td>
					<td>{{transferencia.vDocumento}}</td>
					<td>{{transferencia.iMontoTransferencia | currency: "₡":0}}</td>

					<td>
						<a href="/financiero/public/transferencia/{{transferencia.idTransferencia}}"  class="btn btn-info" title="Ver detalles de la transferencia">Ver</a>
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