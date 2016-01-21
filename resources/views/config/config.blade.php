@extends('layouts.master')
@section('title', 'Acerca de')
	@section('config')
		class="active"
	@endsection
	@section('content')
	@parent
	<section>
	@if(Auth::user() AND Auth::user()->tienePermiso('Configurar Sistema'))

	<br><br>
	<h2>Configuración del Sistema <br>
	<small>Eligue el  periodo de trabjo del sistema</small></h2>
		@if($cambio)
			<div class="col-md-6 alert alert-success">
				<h4>Se guardo satisfactoriamente, el año de trabajo es <%$config->iValor%></h4>	
			</div>
		@endif
		<form class="form-horizontal col-md-12" action="/configuracion" method="post">
		{!! csrf_field() !!}
	        <div class="form-group">
        		<label class="col-md-2 control-label">Año de trabajo</label>
        		<div class="col-md-2">
        		@if(count($config)>0)
          			<input type="number" class="form-control" name="iValor" value="<% $config->iValor %>" required>
          		@else
          			<input type="number" class="form-control" name="iValor" value="2016" required>
          			<% Auth::user()->agregarAnno() %>
          		@endif

        		</div>
      		</div>
        	<div class="form-group">
        		<div class="col-md-1">
					<input type="submit" value="Guardar" class="btn btn-primary">      
		  		</div>
      		</div>
		</form>
	@else
	<br>
		Debe estar autenticado y tener permisos para ver esta sección
	@endif

	</section> 
	@endsection