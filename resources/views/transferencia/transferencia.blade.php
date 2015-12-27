
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
<<<<<<< HEAD
					<th ng-click="orderTable('idCoordinacion')" style="cursor:pointer;">Partida Origen</th>
					<th ng-click="orderTable('vNombrePresupuesto')" style="cursor:pointer;">Partida de Destino</th>
					<th class="col-md-2" ng-click="orderTable('codPartida')" style="cursor:pointer;">Partida</th>
					<th ng-click="orderTable('vDocumento')" style="cursor:pointer;">Documento de transferencia</th>
					<th ng-click="orderTable('iMontotranseferencia')" style="cursor:pointer;">Monto Transferido</th>
=======
					<th ng-click="orderTable('idCoorDe')" style="cursor:pointer;">Und. Ejecutora Origen</th>
					<th ng-click="orderTable('nomPresDe')" style="cursor:pointer;">Presupuesto Origen</th>
					<th class="col-md-2" ng-click="orderTable('codParDe')" style="cursor:pointer;">Partida Origen</th>
					<th ng-click="orderTable('idCoorA')" style="cursor:pointer;">Und. Ejecutora Destino</th>
					<th ng-click="orderTable('nomPresA')" style="cursor:pointer;">Presupuesto Destino</th>
					<th class="col-md-2" ng-click="orderTable('codParA')" style="cursor:pointer;">Partida Destino</th>
					<th ng-click="orderTable('docDe')" style="cursor:pointer;">Documento de transferencia</th>
					<th ng-click="orderTable('monTransDe')" style="cursor:pointer;">Monto Transferido</th>
>>>>>>> 394b20c27665d2c042df4cde2cb88fc2468153f4

					<th></th>
					@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
					<th></th>
					@endif

				</tr>
				<tr ng-repeat="transferencia in modelT | filter : search | orderBy : myOrder track by $index">
<<<<<<< HEAD
					<td>{{transferencia.idCoordinacion}}-{{transferencia.vNombreCoordinacion}}-{{transferencia.vNombrePresupuesto}}-{{transferencia.anno}} Partida:{{transferencia.codPartida}} </td>
					<td>{{transferencia.idCoordinacion}}-{{transferencia.vNombreCoordinacion}}-{{transferencia.vNombrePresupuesto}}-{{transferencia.anno}} Partida:{{transferencia.codPartida}} </td>
					
					<td>{{transferencia.vDocumento}}</td>
					<td>{{transferencia.iMontoTransferencia | currency: "₡":0}}</td>
=======
					<td>{{transferencia.idCoorDe}}-{{transferencia.nomCoorDe}} </td>
					<td>{{transferencia.nomPresDe}}-{{transferencia.annoDe}}</td>
					<td>{{transferencia.codParDe}}</td>
					<td>{{transferencia.idCoorA}}-{{transferencia.nomCoorA}} </td>
					<td>{{transferencia.nomPresA}}-{{transferencia.annoA}}</td>
					<td>{{transferencia.codParA}}</td>
					<td>{{transferencia.docDe}}</td>
					<td>{{transferencia.monTransDe | currency: "₡":0}}</td>
>>>>>>> 394b20c27665d2c042df4cde2cb88fc2468153f4

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