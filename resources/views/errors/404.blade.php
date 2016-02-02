<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/vnd.microsoft.icon">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/css/main.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"  type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script> 
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
         <a class="btn btn-danger pull-right cerrar" href="/auth/logout" title="login">Cerrar Sesion</a> </h5>
        @else
        <a  href="/auth/login" title="login" class="col-md-offset-10 btn btn-info login">Iniciar Sesion</a>
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

    <div class="col-md-10 col-md-offset-2"><h2>Recurso no encontrado</h2>
    <div class="col-md-11 col-md-offset-1">
        <a href="/" title="Volver" class="btn btn-info pull- left">Volver al Inicio</a>      
        <img src="/img/404.png" alt="UCR" class="img-responsive"><br><br>
        </div>

    </div>    
    </body>
