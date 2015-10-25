<!DOCTYPE html>
@extends('/layouts.master')
<html>
<head>
	@section('title', 'Partida')
</head>
<body>

	@section('content')
	@parent
	<section>
	<div class="wrapper col-md-10">
		<form action="/partida" class="form-horizontal col-md-6" method="post">
			<input type="hidden" name="_token" value="<% csrf_token() %>">  
	<div class="form-group">
      <label class="col-md-12 control-label">ID Partida</label>
		 <input type="text" class="form-control col-md-5" name="idPartida" placeholder="ID de Partida">
    </div>
    <div class="form-group">
      <label class="col-md-12 control-label">ID Presupuesto</label>
	<input type="text" name="idPresupuesto" class="form-control col-md-5" placeholder="ID del Presupuesto">
    </div>
    <div class="form-group">
      <label class="col-md-12 control-label">Estado
      <select name="estado" class="form-control">
        	<option value="Activo" selected>Activo</option>
        	<option value="Inactivo">Inactivo</option>
       </select><br></label>
		
    </div>
    <div class="form-group">
      <label class="col-md-12 control-label">Saldo</label>
		<input type="" name="saldo" class="form-control col-md-5" value="" placeholder="Saldo">
    </div>
    <div class="form-group">
      <label class="col-md-12 control-label">Descripcion</label>
		 <input type="" name="descripcion" class="form-control col-md-5" value="" placeholder="Descripcion">
    </div>
    <div class="form-group">
		  <input type="submit" class="btn btn-success" value="Agregar">
    </div>
            
		</form></div>	
	</section> 
	@endsection

</body>
</html>