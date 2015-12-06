@extends('/layouts.master')
@section('title', 'Presupuesto')
@section('presupuesto')
class="active"
@endsection
@section('content')
@parent
<section>
  <div class="wrapper col-md-10">
    <br>
    @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Presupuesto', Auth::user()->id))
    
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
    <form action="/financiero/public/presupuesto" class="form-horizontal" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">ID Presupusto</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="idPresupuesto" placeholder="Id de Presupuesto">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Año</label>
        <div class="col-md-6">
          <input type="text" class="form-control" required name="anno" value="<% $config->iValor %>" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Coordinacion</label>
        <div class="col-md-6">
          <select name="tCoordinacion_idCoordinacion" class="form-control" required>
            <option value="0">Selecione a que unidad pertenece el Presupuesto</option>
            @foreach($coordinaciones as $coordinacion)
              <option value="<% $coordinacion->idCoordinacion %>"><% $coordinacion->idCoordinacion %> - <% $coordinacion->vNombreCoordinacion %></option>
            @endforeach
          </select>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-4 control-label">Nombre</label>
        <div class="col-md-6">
          <input type="text" class="form-control" required name="vNombrePresupuesto" placeholder="Nombre descriptivo del presupuesto">
        </div>
      </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Presupuesto Inicial</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="iPresupuestoInicial" required placeholder="Agregue partidas para modificar el total presupuestado" readonly>
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
