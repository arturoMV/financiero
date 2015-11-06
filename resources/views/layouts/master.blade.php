	<!DOCTYPE html>
	<html ng-app="starter">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon">
		<%-- <link rel="stylesheet" type="text/css" href="/css/style.css"> --%>
	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<link rel="stylesheet" type="text/css" href="/css/main.css">

	<!-- Latest compiled and minified JavaScript -->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"  type="text/javascript"></script>
	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 

		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
		<script src="{!! asset('js/app.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/controllers/partidaTemplate.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/partidas.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/controllers/usuarioTemplate.js') !!}"  type="text/javascript"></script>
		<script src="{!! asset('js/services/usuarios.js') !!}"  type="text/javascript"></script>
	

		<title>Financiero - @yield('title')</title>

	</head>
	<body>
	<div class="container-fluid">
	@if(Auth::user())
	<h5 class="pull-right">Bienvenido: <%Auth::user()->name  %> <br> <a class="btn btn-danger pull-right cerrar" href="/auth/logout" title="login">Cerrar Sesion</a> </h5>
	@else
	<a  href="/auth/login" title="login" class="pull-right btn btn-info login">Iniciar Sesion</a>
	@endif
		</div>
		<header id="header" class="container-fluid">
			<div class="col-xs-12 col-md-6">
			<h1>Sistema de Financiero</h1>
			<h3>Movimientos Presupuestarios</h3>
			</div>
			<div class="col-xs-12 col-md-6">
			<a href="/"><img src="/img/logo.png" alt="UCR" class="img-responsive"></a>
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
							<li @yield('index')><a href="/" title="Inicio">Inicio</a></li>
						    <li @yield('presupuesto')><a href="/presupuesto" title="Presupuestos de Coordinacion">Presupuesto</a></li>
						    @if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida', Auth::user()->id))
						      <li @yield('partida')><a href="/partida" title="Partidas de Presupuesto">Partidas</a></li>
						    @endif
						    @if(Auth::user() AND Auth::user()->tienePermiso('Administrar Usuarios', Auth::user()->id))
						      <li @yield('admU')><a href="/usuario" title="Acerca de">Administrar Usuarios</a></li>
						    @endif
						    <li @yield('about')><a href="/about" title="Acerca de">Acerca De</a></li>					
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

			<footer class="col-md-12 text-center" >
			<div class="col-md-2">
			</div>
			<nav class="col-md-8">
					<ul class="nav-justified">
	  					<li><a href="/" title="index">Inicio</a></li>
						<li><a href="/docs" title="presupuesto">Documentacion</a></li>
						<li><a href="/map" title="partidas">Mapa del Sito</a></li>
						<li><a href="/contact" title="about">Contactenos</a></li>
					</ul>
				</nav>
			<h5 class="col-md-12 text-center"> © 2014 Oficina de Administración Financiera - Universidad de Costa Rica</h5>
			</footer>

	</body>
	</html>