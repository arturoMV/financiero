<!DOCTYPE html>
@extends('/layouts.master')
<html>
<head>
	@section('title', 'Partida')
</head>
<body>

	@section('content')
	@parent
  @if(Auth::user() AND Auth::user()->tienePermiso('partida_editar', Auth::user()->id))
	<section>
	<div class="wrapper">
      	<form class="col-md-4" action="/partida/<%$partida->id%>/put" method="post">
			<input type="hidden" name="_token" value="<% csrf_token() %>">    
      <div class="form-group">
        <label>ID Partida</label>
       <input type="text" class="form-control" name="idPartida" value="<%$partida->idPartida%>" placeholder="ID de Partida">
    </div >

    <div class="form-group">
      <label for=>ID Presupuesto</label>
          <input type="text" class="form-control" name="idPresupuesto" 
          value="<%$partida->idPresupuesto%>" placeholder="ID del Presupuesto">
    </divname="" >

       <div  class="form-group">
        <label>Estado
        <select class="form-control" name="estado">
        		<option value="Activo" 
              @if($partida->estado === "Activo")
                selected
                @endif
            >Activo</option>
        		<option value="Inactivo" @if($partida->estado === "Inactivo")
                selected
                @endif>Inactivo</option>
        	</select>
        </label>
    </div>

    <div class="form-group">
      <label for=>Saldo</label>
         <input type="" name="saldo" class="form-control" value="<%$partida->saldo%>" name="saldo"  placeholder="Saldo">
    </div>
	

     <div class="form-group">
      <label for=>Descripcion</label>
        <input type="text" class="form-control"  value="<%$partida->descripcion%>" 
        name="descripcion"  placeholder="Descripcion">
    </div>

     <div class="form-group">
        <input type="submit" name="" class="btn btn-success col-md-3" value="Editar">
    </div> 
           
	</form>

  <form class="col-md-1" action="/partida/<%$partida->id%>/delete" method="post">
  <input type="hidden" name="_token" value="<% csrf_token() %>">   
      <input type="submit" class="btn btn-danger"name="delete" value="Eliminar">
  </form>
	</div>
	</section> 
  @else
   Debe estar autenticado y tener permisos para ver esta seccion
  @endif
	@endsection

</body>
</html> 