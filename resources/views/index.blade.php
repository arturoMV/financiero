<!DOCTYPE html>
@extends('layouts.master')
<html>
<head>
	@section('title', 'Inicio')
</head>
<body>
	@section('index')
		class="active"
	@endsection
	@section('content')
	@parent
	<section class="contenido">
		Este repositorio esta actualizado
	</section> 
	@endsection

</body>
</html>