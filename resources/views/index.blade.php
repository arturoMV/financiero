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
		este es el contenido
	</section> 
	@endsection

</body>
</html>