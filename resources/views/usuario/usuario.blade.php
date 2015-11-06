
@extends('layouts.master')

	@section('title', 'usuario')

	@section('admU')
		class="active"
	@endsection
	@section('content')
	@parent
	
	
	@if(Auth::user() AND Auth::user()->tienePermiso('Administrar Usuarios', Auth::user()->id))
	<section class="container-fluid" ng-controller="usuarioTemplate"><br>
		<div class="container-fluid search-container form-horizontal">
			<div class="container-fluid">
				<input type="text" id="usuarioName"  class="col-xs-6 col-md-6 col-lg-6 pull-left" placeholder="Digite para buscar" ng-model="search">
				<a href="#" class="btn btn-success crear-usuario pull-right">Nueva usuario</a>
			</div>
		</div>
		<div class="container-fluid table-responsive">
			<table class="table table-striped table-hover">
				<tbody>
					<tr >
						<th ng-click="orderTable('name')" style="cursor:pointer;">Nombre</th>
						<th ng-click="orderTable('email')" style="cursor:pointer;">Email</th>
					
						<th></th>
						<th></th>
					</tr>
					<tr ng-repeat="usuario in modelU | filter : search | orderBy : myOrder track by $index">
						<td>{{usuario.name}}</td>
						<td>{{usuario.email}}</td>
				
						<td>
							<a href="/usuario/{{usuario.id}}"  class="btn btn-info" title="">Ver</a>
						</td>
						<td>
							<a href="/usuario/{{usuario.id}}/edit" class="btn btn-warning" title="">Editar</a>
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