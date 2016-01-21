@extends('layouts.master')

	@section('title', 'Respaldar Sistema')


	@section('backup')
		class="active"
	@endsection
	@section('content')
	<section class="contenido">
		@if(Auth::user() AND Auth::user()->tienePermiso('Respaldar Sistema'))

		
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
			<p><h5>Presione el botón para respaldar los archivos de la base de datos.<br>
			Esta operación puede tardar varios minutos</h5></p>
			<input type="submit" value = "Respaldar" class="btn btn-primary">
			@if(Auth::user() AND Auth::user()->tienePermiso('Ver Respaldos'))
				<a href="/verRespaldosRealizados" class="btn btn-info">Ver Respaldos</a>
			@endif
			
		</form>
		@else 
			<br>
			Debe estar autenticado y tener permisos para ver esta sección
		@endif
	</section> 
	@endsection
