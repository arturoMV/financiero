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
        <h5 class="pull-right">Bienvenido: <%Auth::user()->name  %> <br>
         <a class="btn btn-danger pull-right cerrar" href="/financiero/public/auth/logout" title="login">Cerrar Sesion</a> </h5>
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
            <a href="/financiero/public"><img src="/financiero/public/img/logo.png" alt="UCR" class="img-responsive"></a>
            <h3>Sede del Pacifico</h3>
        </div>
    </header>   

    <div class="col-md-10 col-md-offset-2"><h2>Recurso no encontrado</h2>
    <div class="col-md-11 col-md-offset-1">
        <img src="/financiero/public/img/404.png" alt="UCR" class="img-responsive"><br><br>
        </div>
        <a href="/financiero/public" title="Volver" class="btn btn-info pull- left">Volver al Inicio</a>      

    </div>    
    </body>
