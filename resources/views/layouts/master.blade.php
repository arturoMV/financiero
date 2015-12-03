<!DOCTYPE html>
<html ng-app="starter">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
	<script src="{!! asset('js/controllers/partidaTemplate.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/partidas.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/controllers/usuarioTemplate.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/usuarios.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/factura.js') !!}"  type="text/javascript"></script>


	<title>Financiero - @yield('title')</title>

</head>
<body>
	<div class="container-fluid">
		@if(Auth::user())
		<h5 class="pull-right">Bienvenido: <%Auth::user()->name  %> <br> <a class="btn btn-danger pull-right cerrar" href="/financiero/public/auth/logout" title="login">Cerrar Sesion</a> </h5>
		@else
		<a  href="/financiero/public/auth/login" title="login" class="col-md-offset-10 btn btn-info login">Iniciar Sesion</a>
		<a  href="/financiero/public/auth/register" title="login" class=" btn btn-info login">Registrarse</a>
		@endif
	</div>
	<header id="header" class="container-fluid">
		<div class="col-xs-12 col-md-6">
			<h1>Sistema de Financiero</h1>
			<h3>Movimientos Presupuestarios</h3>
		</div>
		<div class="col-xs-12 col-md-6">
			<a href="/"><img src="/financiero/public/img/logo.png" alt="UCR" class="img-responsive"></a>
			<h3>Sede del Pacifico</h3>
		</div>
	</header>	
	<section>
		@if(Auth::user() AND Auth::user()->tienePermiso('Ver Menu', Auth::user()->id))
		<aside class="col-md-3">
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
							<li @yield('index')><a href="/financiero/public/" title="Inicio">Inicio</a></li>
							@if(Auth::user() AND Auth::user()->tienePermiso('Ver Coordinacion', Auth::user()->id))
							<li @yield('coord')><a href="/financiero/public/coordinacion" title="Coordinaciones">Coordinación</a></li>
							@endif
							
							<li @yield('presupuesto')><a href="/financiero/public/presupuesto" title="Presupuestos de Coordinacion">Presupuesto</a></li>
							@if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida', Auth::user()->id))
							<li @yield('partida')><a href="/financiero/public/partida" title="Partidas de Presupuesto">Partidas</a></li>
							@endif
							
							@if(Auth::user() AND Auth::user()->tienePermiso('Administrar Usuarios', Auth::user()->id))
							<li @yield('admU')><a href="/financiero/public/usuario" title="Acerca de">Administrar Usuarios</a></li>
							@endif
							<li @yield('about')><a href="/financiero/public/about" title="Acerca de">Acerca De</a></li>					
						</ul>
					</div>
				</div>
			</nav>		
		</aside>


		<div class="col-md-9">
			@yield('content')
		</div>
		@else
		<div class=" col-md-10 col-md-offset-1">
			@yield('content')
		</div>
		@endif
	</section>

	<footer class="col-md-12 text-center container-fluid" >
		<div class="col-md-8 col-md-offset-2">
			<nav class="nav navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"></a>
					</div>
				</div>
					<div id="navbar2"  class="navbar-collapse collapse">
						<ul class="nav-justified">
							<li><a href="/financiero/public/" title="index">Inicio</a></li>
							<li><a href="/financiero/public/docs" title="presupuesto">Documentacion</a></li>
							<li><a href="/financiero/public/map" title="partidas">Mapa del Sito</a></li>
							<li><a href="/financiero/public/contact" title="about">Contactenos</a></li>
						</ul>
					</div>

			</nav>
		</div>
		<h5 class="col-md-8 col-md-offset-2 text-center"> © 2014 Oficina de Administración Financiera - Universidad de Costa Rica</h5>
	</footer>

</body>
</html>