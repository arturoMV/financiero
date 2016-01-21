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


	<title>Movimientos Presupuestarios - @yield('title')</title>

</head>
<body>
@if(true)
	<div class="container-fluid">
		@if(Auth::user())
		<h5 class="pull-right">Bienvenido: <%Auth::user()->name  %> <br>
		 <a class="btn btn-danger pull-right cerrar" href="/auth/logout" title="login">Cerrar Sesión</a> </h5>
		@else
			<a  href="/auth/login" title="login" class="col-md-offset-10 btn btn-info login">Iniciar Sesión</a>
			<a  href="/auth/register" title="login" class=" btn btn-info login">Registrarse</a>
		@endif
	</div>
	<header id="header" class="container-fluid">
		
		<div class="col-xs-12 col-md-6">
			<a href="/home"><img src="/img/logo2.png" alt="UCR" class="img-responsive" id="imgBanner"></a>
		</div>
		<div class="col-xs-12 col-md-6" style="text-align: right;">
			<h1>Sistema de Financiero</h1>
			<h3>Movimientos Presupuestarios</h3>
		</div>
	</header>
@endif
	<section>
		@if(Auth::user() AND Auth::user()->tienePermiso('Ver Menu') AND true)
		<aside class="col-md-3 container fluid text-center col-md-offset-0" >
			<nav class="nav navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"></a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav nav-pills nav-stacked" >
							<li @yield('index')><a href="/" title="Inicio">Inicio</a></li>
							@if(Auth::user() AND Auth::user()->tienePermiso('Ver Coordinacion', Auth::user()->id))
							<li @yield('coord')><a href="/coordinacion" title="Coordinaciones">Coordinación</a></li>
							@endif
							
						    @if(Auth::user() AND Auth::user()->tienePermiso('Ver Presupuesto', Auth::user()->id))
							<li @yield('presupuesto')><a href="/presupuesto" title="Presupuestos de Unidad">Presuspuestos</a></li>
							@endif
							
							@if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida', Auth::user()->id))
							<li @yield('partida')><a href="/partida" title="Partidas de Presupuesto">Partidas</a></li>
							@endif

							@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Transaccion', Auth::user()->id))
							<li @yield('movimiento')><a href="/transaccion/create" title="Movimientos" >Nuevo Movimiento</a></li>
        					@endif

							@if(Auth::user() AND Auth::user()->tienePermiso('Ver Transferencia', Auth::user()->id))
							<li @yield('transferencia')><a href="/transferencia" title="Acerca de">Transferencias</a></li>
							@endif
							
							@if(Auth::user() AND Auth::user()->tienePermiso('Administrar Usuarios', Auth::user()->id))
							<li @yield('admU')><a href="/usuario" title="Acerca de">Administrar Usuarios</a></li>
							@endif

							@if(Auth::user() AND Auth::user()->tienePermiso('Configurar Sistema', Auth::user()->id))
							<li @yield('config')><a href="/configuracion" title="Configurar periodo">Configuración de Sistema</a></li>
							@endif		
							@if(Auth::user() AND Auth::user()->tienePermiso('Respaldar Sistema', Auth::user()->id))
							<li @yield('backup')><a href="/respaldo" title="Configurar periodo">Respaldar base de datos</a></li>
							@endif
						</ul>
					</div>
				</div>
			</nav>		
		</aside>


		<div class="col-md-9">
			@section('content')<br>
				<div class="col-md-12" ng-show="true">
   			 	</div>
   			 
   			@show
			</div>
		@else
		<div class=" col-md-10 col-md-offset-1">
			@section('content')<br>
				<div class="col-md-12" ng-show="true">
   			 	</div>
   			@show
 
		</div>
		@endif
	</section>
		<footer class="col-md-12 text-center container-fluid" >
		<h5 class="col-md-8 col-md-offset-2 text-center"> © 2015 Oficina de Administración Financiera - Universidad de Costa Rica</h5>
	</footer>


</body>
</html>