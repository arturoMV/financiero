@extends('layouts.master')
@section('title', 'Partida')

@section('partida')
class="active"
@endsection
@section('content')
@parent

@if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida', Auth::user()->id))
<section class="container-fluid" ng-controller="partidaTemplate"><br>
	@if (count($mensaje)>0)
	<div class="alert alert-success">
		<strong>Bien! </strong>Se realizaron cambios<br><br>
		<ul>
			<li><%$mensaje%></li>
		</ul>
	</div> 
	@endif 
	@if (count($errors)>0)
	<div class="alert alert-danger">
		<strong>Ops! </strong>No se pudo eliminar Paritda<br><br>
		<ul>
			<li>La Partida esta activa en un presupuesto</li>
		</ul>
	</div> 
	@endif 
	<h3> Lista de Partidas <small><% $anno->iValor%> </small></h3>
	<div class="container-fluid search-container form-horizontal">
		<div class="container-fluid">
			<input type="text" id="partidaName"  class="col-xs-6 col-md-6 col-lg-6 pull-left" placeholder="Digite para buscar" ng-model="search">
			@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Partida', Auth::user()->id))
			<a href="/partida/create" class="btn btn-success crear-partida pull-right">Nueva Partida</a>
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
					<th ng-click="orderTable('vNombrePartida')" style="cursor:pointer;">Nombre</th>
					<th ng-click="orderTable('iSaldo')" style="cursor:pointer;">Saldo</th>

					<th></th>
					@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
					<th></th>
					@endif

				</tr>
				<tr ng-repeat="partida in modelP | filter : search | orderBy : myOrder track by $index">
					<td>{{partida.idCoordinacion}}-{{partida.vNombreCoordinacion}} </td>
					<td>{{partida.vNombrePresupuesto}}-{{partida.anno}}</td>
					<td>{{partida.codPartida}}</td>
					<td>{{partida.vNombrePartida}}</td>
					<td>{{partida.iSaldo | currency:"₡":0}}</td>
					<td><a href="/partida/{{partida.id}}"  class="btn btn-info" title="">Ver</a></td>
					<td>
						@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id)  AND $anno->iValor == date('Y'))
						<a href="/partida/editar/{{partida.id}}" class="btn btn-warning" title="">Editar</a>
						@endif
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