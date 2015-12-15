@extends('/layouts.master')
@section('title', 'Partida')
@section('coord')
class="active"
@endsection
@section('content')
@parent
<section>
  <div class="wrapper col-md-10">
    <br>
    @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Coordinacion'))
    <form action="/financiero/public/coordinacion" class="form-horizontal" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">Numero Coordinacion</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="idCoordinacion" placeholder="Numero de la Coordinacion">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Nombre</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="vNombreCoordinacion" placeholder="Nombre de la Coordinacion">
        </div>
      </div>
      <div class="form-group">
          <div class="col-md-4 col-md-offset-4">
            <input type="submit" class="btn btn-success" value="Agregar">
          </div>
      </div>

      </form>
      @else
      Debe estar autenticado y tener permisos para ver esta pagina
      @endif
    </div>	
  </section> 
  @endsection
