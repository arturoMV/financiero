@extends('/layouts.master')
@section('title', 'Presupuesto')
@section('presupuesto')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Editar Presupuesto'))
<section>
  <div class="wrapper col-md-10">
    <br>
    <form class="col-md-10 form-horizontal" action="/presupuesto/<%$presupuesto->idPresupuesto%>/put" 
      method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">    
      @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Oops!</strong> Error al eliminar<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li><% $error %></li>
            @endforeach
        </ul>
    </div> 
    @endif  

      <div class="form-group">
        <label class="col-md-4 control-label">Coordinación</label>
        <div class="col-md-6">
          <select name="tCoordinacion_idCoordinacion" class="form-control" required>
            <option value="0">Selecione a que unidad pertenece el Presupuesto</option>
            @foreach($coordinaciones as $coordinacion)
              <option 
                @if($coordinacion->idCoordinacion == $presupuesto->tCoordinacion_idCoordinacion)
                selected
                @endif
              value="<% $coordinacion->idCoordinacion %>"> <% $coordinacion->idCoordinacion %> - <% $coordinacion->vNombreCoordinacion %></option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Nombre</label>
        <div class="col-md-6">
          <input type="text" class="form-control" value="<%$presupuesto->vNombrePresupuesto%>" name="vNombrePresupuesto"  placeholder="Nombre de presupuesto" pattern="[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+" title="Este campor solo acepta letras y numeros">
        </div>
      </div>
       <div class="form-group">
      <label class="col-md-4 control-label">Año</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="anno" value="<%$presupuesto->anno%>" readonly>
        </div>
      </div>
     
      <div class="form-group">
        <div class="col-md-4 col-md-offset-3">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Confirmar</button>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar</button>

        </div>
      </div> 
      <div class="col-md-5">
        <div class="modal fade" id="myModal2" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirmar</h4>
              </div>
              <div class="modal-body">
                <p>Estas seguro de que quieres modificar el presupuesto.
                <ul>
                  <li>Verifique que los datos introducidos sean correctos</li>
                </ul></p>
                
                  <input type="submit" name="" class="btn btn-warning" value="Editar">
                  <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
              </div>
            </div> 
          </div>
        </div> 
      </div>
    </form>

    <form class="col-md-1" action="/presupuesto/<%$presupuesto->idPresupuesto%>/delete" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">
      @if(Auth::user() AND Auth::user()->tienePermiso('Borrar Presupuesto', Auth::user()->id))
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Confirmar</h4>
            </div>
            <div class="modal-body">
              <p>Estas seguro de que quieres eliminar.</p>
              <input type="submit" class="btn btn-danger"name="delete" value="Eliminar">
              <button type="button" class="btn btn-success pull-right" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div> 
      @endif
    </form>
  </div>
</section>
@else
Debe estar autenticado y tener permisos para ver esta seccion

@endif
@endsection
