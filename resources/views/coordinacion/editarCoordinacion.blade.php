@extends('/layouts.master')>
@section('title', 'Coordinacion')
@section('coord')
  class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Editar Coordinacion', Auth::user()->id))
<section>
  <div class="wrapper col-md-10">
    <br>
    <form class="col-md-10 form-horizontal" action="/financiero/public/coordinacion/<%$coordinacion->idCoordinacion%>/put" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">    

      <div class="form-group">
        <label class="col-md-4 control-label">ID Coordinacion</label>
        <div class="col-md-8">
          <input type="text" class="form-control" name="idCoordinacion" value="<%$coordinacion->idCoordinacion%>" placeholder="ID de Coordinacion">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Nombre Coordinacion</label>
        <div class="col-md-8">
          <input type="text" class="form-control" name="vNombreCoordinacion" 
          value="<%$coordinacion->vNombreCoordinacion%>" placeholder="Nombre de la Coordinacion">
        </div>
      </div>
      <div class="form-group">
          <div class="col-md-4 col-md-offset-3">
            <input type="submit" name="" class="btn btn-warning" value="Editar">

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar</button>

          </div>
        </div> 

      </form>

      <form class="col-md-1" action="/financiero/public/coordinacion/<%$coordinacion->idCoordinacion%>/delete" method="post">
        <input type="hidden" name="_token" value="<% csrf_token() %>">
        @if(Auth::user() AND Auth::user()->tienePermiso('Borrar Coordinacion', Auth::user()->id))
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
