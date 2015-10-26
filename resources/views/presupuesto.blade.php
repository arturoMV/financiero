<!DOCTYPE html>
@extends('layouts.master')
<html>
<head>
	@section('title', 'Presupuesto')
</head>
<body>
	@section('presupuesto')
		class="active"
	@endsection
	@section('content')
	@parent
	<section>
		este es el contenido de Presupuesto
	</section> 
	@endsection

</body>
</html>