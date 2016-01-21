@extends('layouts.master')

	@section('title', 'Inicio')


	@section('backup')
		class="active"
	@endsection
	@section('content')
	<section class="contenido">
		
		<form action="/respaldo" method="post">
			{!! csrf_field() !!}

			<br><h3>Respaldo de la Base de datos</h3>
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
					<strong>Ops! </strong>No se pudo respaldar<br><br>
					<ul>
						<li><%$errors%></li>
					</ul>
				</div> 
			@endif 
			<p><h5>Presione el boton el boton para respaldar los archivos de la base de datos.<br>
			Esta operacion puede tardar varios minutos</h5></p>
			<input type="submit" value = "Respaldar" class="btn btn-primary">
			
		</form>

	</section> 
	@endsection
