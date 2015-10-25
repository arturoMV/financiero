<!DOCTYPE html>
@extends('layouts.master')
<html>
<head>
	@section('title', 'Inicio')
</head>
<body>

	@section('content')
	@parent
	<section class="contenido">
		este es el contenido
	</section> 
	@endsection

</body>
</html>