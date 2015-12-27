@extends('layouts.master')
@section('title', 'Acerca de')
	@section('config')
		class="active"
	@endsection
	@section('content')
	@parent
	<section>
	<br><br>
	<h2>Configuracion del Sistema <br>
	<small>Eligue el  periodo de trabjo del sistema</small></h2>
		@if($cambio)
			<div class="col-md-6 alert alert-success">
				<h4>Se guardo satisfactoriamente, el año de trabajo es <%$config->iValor%></h4>	
			</div>
		@endif
		<form class="form-horizontal col-md-6" action="/financiero/public/configuracion" method="post">
		{!! csrf_field() !!}
	        <div class="form-group">
        		<label class="col-md-4 control-label">Año de trabajo</label>
        		<div class="col-md-2">
          			<input type="number" class="form-control" name="iValor" value="<% $config->iValor %>" required>
        		</div>
      		</div>

        	<div class="form-group">
        		<div class="col-md-1 col-md-offset-4">
					<input type="submit" value="Guardar" class="btn btn-primary">      
		  		</div>
      		</div>
		</form>

		<div class="col-md-6">
			<h3>Respaldar los datos</h3>
			<a href="/financiero/public/respaldo" title=""></a>
		</div>
	</section> 
	@endsection