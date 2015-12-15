<!DOCTYPE html>
<html ng-app="starter">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" href="/financiero/public/img/favicon.ico" type="image/vnd.microsoft.icon">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="/financiero/public/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/financiero/public/css/main.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"  type="text/javascript"></script>
		<script src="/financiero/public/js/bootstrap.min.js"></script> 
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
		<script src="{!! asset('js/app.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/controllers/coordinacionTemplate.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/coordinacion.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/controllers/presupuestoTemplate.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/presupuesto.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/controllers/partidaTemplate.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/partidas.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/controllers/usuarioTemplate.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/usuarios.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/controllers/transferenciaTemplate.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/transferencia.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/factura.js') !!}"  type="text/javascript"></script>


		<title>Financiero - @yield('title')</title>

	</head>
	<body>
	<header  class="container-fluid">
		<div class="col-xs-12 col-md-6" style="color: black">
			<h1>Sistema de Financiero</h1>
			<h3>Movimientos Presupuestarios</h3>
		</div>
		<div class="col-xs-12 col-md-6" style="color: black">
			<h3>Sede del Pacifico</h3>
		</div>
	</header>
	<section>
		@yield('content')<br>

	</section>

	</body>
</html>