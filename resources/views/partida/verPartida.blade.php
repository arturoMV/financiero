@extends('/layouts.master')
	@section('title', 'Partida')

  @section('partida')
    class="active"
  @endsection
	@section('content')
	@parent
    @if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida', Auth::user()->id))
  	<section>
  	<div class="wrapper">
      <form class="col-md-7 form-horizontal" action="/financiero/public/partida/<%$partida->idPartida%>/edit" method="get"> 
        <div class="form-group">
          <label class="col-md-4 control-label">ID Partida:</label>
          <p class="col-md-2 form-control-static"><%$partida->idPartida%></p>
       
       </div >

      <div class="form-group">
        <label class="col-md-4 control-label">ID Presupuesto:</label>
        <p class="col-md-8 form-control-static"><%$partida->tPresupuesto_idPresupuesto%></p>
         
      </div>

         <div  class="form-group">
          <label class="col-md-4 control-label">Estado:</label>
          <p class="col-md-8 form-control-static"><%$partida->estado%></p>	    
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Saldo:</label>
  		<p class="col-md-8 form-control-static"><%$partida->saldo%></p>
      </div>
  	

       <div class="form-group">
        <label class="col-md-4 control-label">Descripcion:</label>
        	<p class="col-md-8 form-control-static"><%$partida->descripcion%></p>
    
      </div>

       <div class="col-md-4 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
          <input type="submit" name="" class="btn btn-success pull-right" value="Editar">
        @endif
      </div> 
             
  	</form>
  	</div>
  	</section> 
    @else
      Debe estar autenticado y tener permisos para ver esta pagina
    @endif
  @endsection
