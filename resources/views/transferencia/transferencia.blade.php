
@extends('layouts.master')
@section('title', 'Transferencias')


@section('transferencia')
class="active"
@endsection
@section('content')
@parent

@if(Auth::user() AND Auth::user()->tienePermiso('Ver Transferencia', Auth::user()->id))
<section class="container-fluid" ng-controller="transferenciaTemplate"><br>
	<h3>Lista de transferencias <small> <% $anno->iValor %></small></h3>
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
	<div class="container-fluid search-container form-horizontal col-md-6">
			<div class="container-fluid">
				<input type="text" id="partidaName"  class="form-control pull-left" placeholder="Digite para buscar" ng-model="search">
			</div>
		</div>
				@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Transferencia', Auth::user()->id) AND $anno->iValor == date('Y'))
					<a href="/create/transferencia" class="btn btn-success crear-partida pull-right">Nueva Transferencia</a>
				@endif
	<div class="container-fluid table-responsive col-md-12" >
		
		<table class="table table-striped table-hover">
			<tbody>
				<tr >
					<th ng-click="orderTable('idCoorDe')" style="cursor:pointer;">Und. Ejecutora Origen</th>
					<th ng-click="orderTable('nomPresDe')" style="cursor:pointer;">Presupuesto Origen</th>
					<th class="col-md-2" ng-click="orderTable('codParDe')" style="cursor:pointer;">Partida Origen</th>
					<th ng-click="orderTable('idCoorA')" style="cursor:pointer;">Und. Ejecutora Destino</th>
					<th ng-click="orderTable('nomPresA')" style="cursor:pointer;">Presupuesto Destino</th>
					<th class="col-md-2" ng-click="orderTable('codParA')" style="cursor:pointer;">Partida Destino</th>
					<th ng-click="orderTable('docDe')" style="cursor:pointer;">Documento de transferencia</th>
					<th ng-click="orderTable('monTransDe')" style="cursor:pointer;">Monto Transferido</th>

					<th></th>
					@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
					<th></th>
					@endif

				</tr>
				<tr ng-repeat="transferencia in modelT | filter : search | orderBy : myOrder track by $index">
					<td>{{transferencia.idCoorDe}}-{{transferencia.nomCoorDe}} </td>
					<td>{{transferencia.nomPresDe}}-{{transferencia.annoDe}}</td>
					<td>{{transferencia.codParDe}}</td>
					<td>{{transferencia.idCoorA}}-{{transferencia.nomCoorA}} </td>
					<td>{{transferencia.nomPresA}}-{{transferencia.annoA}}</td>
					<td>{{transferencia.codParA}}</td>
					<td>{{transferencia.docDe}}</td>
					<td>{{transferencia.monTransDe | currency: "₡":0}}</td>
					<td>
						<a href="/transferencia/{{transferencia.codTransDe}}"  class="btn btn-info" title="Ver detalles de la transferencia">Ver</a>
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