<!DOCTYPE html>
@extends('layouts.master')
<html ng-app="starter">
<head>
	@section('title', 'Partida')
</head>
<body>
	@section('content')
	@parent
	<section class="container-fluid" ng-controller="finansieroTemplate">
		<table class="col-xs-12">
			<tbody>
				<tr class="col-xs-12">
					<td class="col-xs-2">ID Partida</td>
					<td class="col-xs-2">ID Presupuesto</td>
					<td class="col-xs-2">Estado</td>
					<td class="col-xs-2">Saldo</td>
					<td class="col-xs-2">Descripción</td>
					<td class="col-xs-2"></td>
					<td class="col-xs-2"></td>
				</tr>
			</tbody>
		</table>
	</section>
	@endsection
</body>
</html>