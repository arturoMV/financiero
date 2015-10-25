<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="http://oaf.ucr.ac.cr/sites/default/files/favicon.ico" type="image/vnd.microsoft.icon">
	<%-- <link rel="stylesheet" type="text/css" href="/css/style.css"> --%>
<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
<!-- Latest compiled and minified JavaScript -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"  type="text/javascript"></script>
	<%-- // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --%>
	<%-- <script src="/js/bootstrap-table.js"></script> --%>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="{!! asset('js/app.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/controllers/financieroTemplate.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/factories/partidasFactory.js') !!}"  type="text/javascript"></script>
	<script src="{!! asset('js/services/partidas.js') !!}"  type="text/javascript"></script>
</html>
	<title>Financiero - @yield('title')</title>

</head>
<body>
<div class="container-fluid">
@if(Auth::user())
<h5 class="pull-right">Bienvenido: <%Auth::user()->name  %> <br> <a class="btn btn-info" href="/auth/logout" title="login">Cerrar Sesion</a> </h5>
@else
<a  href="/auth/login" title="login" class="pull-right btn btn-info login">Iniciar Sesion</a>
@endif
	</div>
	</div>
	<header id="header" class="container-fluid">
		<div class="col-xs-12 col-md-6">
		<h1>Sistema de Financiero</h1>
		<h3>Movimientos Presupuestarios</h3>
		</div>
		<div class="col-xs-12 col-md-6">
		<a href="/"><img src="http://oaf.ucr.ac.cr/sites/all/themes/bootstrap-business/logo.png" alt="UCR" class="img-responsive"></a>
		<h3>Sede del Pacifico</h3>
		</div>
	</header>	
	<section>
	@if(Auth::user() AND Auth::user()->tienePermiso('menu_ver', Auth::user()->id))
		<aside class="col-md-3 ">
			<nav >
				<ul class="nav nav-stacked text-center">
					<li><a href="/" title="index">Inicio</a></li>
					<li><a href="/presupuesto" title="presupuesto">Presupuesto</a></li>
					<li><a href="/partida" title="partidas">Partidas</a></li>
					<li><a href="/about" title="about">Acerca De</a></li>
				</ul>
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
				<ul class="nav nav-pills nav-justified">
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