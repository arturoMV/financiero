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
    <form action="/partida" class="form-horizontal" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">ID Partida</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="idPartida" placeholder="ID de Partida">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">ID Presupuesto</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="idPresupuesto" placeholder="ID del Presupuesto">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Estado </label>
        <div class="col-md-4">
          <select name="estado" class="form-control">
            <option value="Activo" selected>Activo</option>
            <option value="Inactivo">Inactivo</option>
          </select></div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Saldo</label>
          <div class="col-md-4">
            <input type="text" class="form-control" name="saldo" placeholder="Saldo de la partida">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Descripcion</label>
          <div class="col-md-4">
            <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
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
