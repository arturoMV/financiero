@extends('layouts.master')
@section('title', 'Usuario')
@section('admU')
class="active"
@endsection
@section('content')
@parent
<section class="col-md-8 col-md-offset-2 form-horizontal">
	<form  class="form" action="/usuario/<% $usuario->id %>/coordinacion/put" 
	 method="post">
	 @if (count($errors) > 0)
    <div class="alert alert-success">
        <strong>Bien!</strong><br><br>
            <% $errors %>
     </div> 
    @endif
		<div class="panel panel-primary">
			<div class="panel-heading">
				<label class="form-label">Editar coordinaciones del usuario <% $usuario->name %></label>
			</div>

			<div class="panel-body">
				<p> Tenga en cuenta que modificar las coordinaciones de un usuario causa que el usuario tenga acceso solo a las coordinaciones elegidas</p <% $count = 0%>>
					{!! csrf_field() !!}
					@foreach($coordinaciones as $coordinacion)
					<div class="form-contol">
						<div class="col-sm-offset-2">
							<div class="checkbox">
								<label>
									@if(Auth::user()->verificarCoordinacion($coordinacion->idCoordinacion, $usuario->id))
									<input type="checkbox" checked value="<% $coordinacion->idCoordinacion %>" 
									name="<% $count %>">
									<% $coordinacion->idCoordinacion %>-<% $coordinacion->vNombreCoordinacion %> 
									@else 
									<input type="checkbox" value="<% $coordinacion->idCoordinacion %>" 
									name="<% $count %>">
									<% $coordinacion->idCoordinacion %>-<% $coordinacion->vNombreCoordinacion %>                    
									@endif
								</label>
							</div>
						</div <% $count++%>>
					</div>
					@endforeach
					<div class="form-group col-md-1 col-md-offset-3">
						<input type="submit" class="btn btn-warning" value="Editar">
					</div>
				</div>
			</div>  
		</form>
	</section> 
	@endsection