<!DOCTYPE html>
<html ng-app="starter">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/vnd.microsoft.icon">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="/js/jquery-1.11.3.min.js"  type="text/javascript"></script>
	<script src="/js/bootstrap.min.js"></script> 
	<script src="/js/angular.min.js"></script>
	<script src="/js/jquery.maskedinput-1.3.min.js"></script>
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
	<script src="{!! asset('js/controllers/transaccionTemplate.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/transaccion.js') !!}"  type="text/javascript"></script>	
	<script src="{!! asset('js/controllers/reservaTemplate.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/reserva.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/factura.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/mascara.js') !!}"  type="text/javascript"></script>

		<title>Financiero - @yield('title')</title>
	</head>
	<body>
	<header  class="container-fluid">
		<div class="col-xs-12 col-md-6" style="color: black">
			<h1>Sistema de Financiero</h1>
			<h3>Movimientos Presupuestarios</h3>
		</div>
		<div class="col-xs-12 col-md-6" style="color: black">
			<h3>Sede del Pacífico</h3>
		</div>
	</header>
	<section>
		<div class="col-md-11 col-offset-1">
			<h4 class="push-right text-right"> <% $date = date('d/m/Y h:i:s a') %></h4><br> 
		</div>
		@yield('content')<br>
	</section>
	</body>
</html>