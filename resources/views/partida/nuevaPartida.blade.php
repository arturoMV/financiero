@extends('/layouts.master')
@section('title', 'Partida')
@section('partida')
class="active"
@endsection
@section('content')
@parent
<section>
  <div class="wrapper col-md-10">
    <br>
    @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Partida', Auth::user()->id))

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Oops!</strong> Hay problemas con las entradas<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li><% $error %></li>
            @endforeach
        </ul>
    </div> 
    @endif 

    <form action="/financiero/public/partida" class="form-horizontal" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">Codigo de Paritda</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="codPartida" required placeholder="0-00-00-00">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Nombre de Partida</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="vNombrePartida" required placeholder="Nombre que identifica el gasto">
        </div>
        </div>
      
        <div class="form-group">
          <label class="col-md-4 control-label">Descripcion</label>
          <div class="col-md-6">
            <textarea class="form-control" rows="5" required name="vDescripcion"></textarea>
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
  </section> 
  @endsection
