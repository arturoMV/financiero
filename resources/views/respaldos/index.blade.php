@extends('layouts.master')

@section('title', 'Respaldar Sistema')


@section('backup')
class="active"
@endsection
@section('content')

<section style="min-height:500px">

	@if(Auth::user() AND Auth::user()->tienePermiso('Ver Respaldos'))	


	<?php 
//$dir = "/xampp/htdocs/website/images/leyes/legislac"; 
	$dir = dirname('/var/www/html/financiero/public/respaldos/verdana'); 
	$dirr = '/respaldos/'; 
//$dirr = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; 

	$directorio=opendir($dir); 

	echo "<br><br>"; 
	echo "<h3>Respaldos</h3><br><br><ol>";
	echo "<li value='0' hidden></li>";
	while ($archivo = readdir($directorio)){ 
		if($archivo=='.' or $archivo=='..' or $archivo=='index.blade.php' or $archivo=='otro.HTM' or $archivo=='Thumbs.db'){ 
			echo ""; 
		}else { 
			$archivo2=str_replace(" ", "%20",$archivo);
			$enlace = $dirr.$archivo2;
			if (strpos($archivo,".")) {
				$NOMBRE = SUBSTR($archivo, 0, -4);
			}else
			{
				$NOMBRE = $archivo;
			}

			echo "<li>"; 
			echo "<a href=$enlace class='menu' style='font-family: verdana, sans-serif;
			color: #2F92D4;
			font-size: 20px;
			font-weight: bold;

			' >$NOMBRE<br></a>"; 

			echo "</li>"; 

		} 
	} 
	echo "</ol>";
	closedir($directorio); 
	?>
	@else
	<br>
	<br>
	Debe estar autenticado y tener permisos para ver esta pagina
	@endif
</section> 

@endsection
