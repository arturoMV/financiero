<!DOCTYPE html>
@extends('layouts.master')
<html>
<head>
	@section('title', 'Acerca de')
</head>
<body>
	@section('about')
		class="active"
	@endsection
	@section('content')
	@parent
	<section>
		<h3>Acerca de Nosotros</h3>
		<p>Esta pagina esta siendo desarollada como un proyecto de Practica empresarial supervisada por los estudiantes</p>
		<p><h4>Arturo Madrigal</h4></p>
		<p><h4>Miguel Castro</h4></p>
	</section> 
	@endsection

</body>
</html>