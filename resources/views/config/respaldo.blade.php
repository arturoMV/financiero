@extends('layouts.master')

	@section('title', 'Inicio')


	@section('backup')
		class="active"
	@endsection
	@section('content')
	<section class="contenido">
		
		<form action="/financiero/public/respaldo" method="post">
			{!! csrf_field() !!}
			<input type="submit" value = "Respaldar" class="btn btn-primary">
			
		</form>

	</section> 
	@endsection
