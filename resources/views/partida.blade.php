<!DOCTYPE html>
@extends('layouts.master')
<html>
<head>
	@section('title', 'Partida')
</head>
<body>
		
	@section('content')
	@parent

	<section>
		 <table  id="example" class="table table-hover display" cellspacing="0" width="100%">
			<caption><h2> Partidas</h2> <input type="text"  placeholder="Buscar"></input></caption>
			<thead>
				<tr>
					<th>ID Partida</th>
					<th>ID Presupuesto</th>
					<th>Estado</th>
					<th>Saldo</th>
					<th>Descripcion</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($partida as $par)
				<tr>
					<td>{{$par->idPartida}}</td>
					<td>{{$par->idPresupuesto}}</td>
					<td>{{$par->estado}}</td>
					<td>{{$par->saldo}}</td>
					<td>{{$par->descripcion}}</td>
					<td><a class="btn btn-default" href="/partida/{{$par->id}}">Ver</a></td>
					<td><a class="btn btn-default" href="/partida/{{$par->id}}/edit">Editar</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	
	

		<a class="btn btn-default" href="/partida/create" "email me">Nueva Partida</a>

	</section> 
	@endsection

</body>
</html>