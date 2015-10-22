@extends('/layouts.master')
<html>
<head>
	@section('title', 'Partida')
</head>
<body>

	@section('content')
	@parent
	<section>
	<div class="wrapper">
      	<form class="col-md-7 form-horizontal" action="/partida/{{$partida->id}}/edit" method="get"> 
      <div class="form-group">
        <label class="col-md-4 control-label">ID Partida:</label>
        <p class="col-md-2 form-control-static">{{$partida->idPartida}}</p>
     
    </div >

    <div class="form-group">
      <label class="col-md-4 control-label">ID Presupuesto:</label>
      <p class="col-md-2 form-control-static">{{$partida->idPresupuesto}}</p>
       
    </div>

       <div  class="form-group">
        <label class="col-md-4 control-label">Estado:</label>
        <p class="col-md-2 form-control-static">{{$partida->estado}}</p>	    
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Saldo:</label>
		<p class="col-md-2 form-control-static">{{$partida->saldo}}</p>
    </div>
	

     <div class="form-group">
      <label class="col-md-4 control-label">Descripcion:</label>
      	<p class="col-md-2 form-control-static">{{$partida->descripcion}}</p>
  
    </div>

     <div class="col-md-4 form-group ">
        <input type="submit" name="" class="btn btn-success pull-right" value="Editar">
    </div> 
           
	</form>
	</div>
	</section> 
	@endsection

</body>
</html>