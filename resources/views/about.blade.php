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
		este es el contenido de acerca de
	</section> 
	@endsection

</body>
</html>