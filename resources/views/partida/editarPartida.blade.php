@extends('/layouts.master')>
@section('title', 'Partida')
@section('partida')
  class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
<section>
  <div class="wrapper col-md-10">
    <br>
    <form class="col-md-10 form-horizontal" action="/financiero/public/partida/<%$partida->idPartida%>/put" 
    method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">    

      <div class="form-group">
        <label class="col-md-4 control-label">ID Partida</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="idPartida" value="<%$partida->idPartida%>" placeholder="ID de Partida">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">ID Presupuesto</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="idPresupuesto" value="<%$partida->idPresupuesto%>" placeholder="ID del Presupuesto">
        </div>
      </div>

      <div  class="form-group">
        <label class="col-md-4 control-label">Estado  </label>
        <div class="col-md-4">
          <select class="form-control" name="estado">
            <option value="Activo" 
            @if($partida->estado === "Activo")
            selected
            @endif
            >Activo</option>
            <option value="Inactivo" @if($partida->estado === "Inactivo")
              selected
              @endif>Inactivo</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Saldo</label>
          <div class="col-md-4">
            <input type="text" class="form-control" value="<%$partida->saldo%>" name="saldo"  placeholder="Saldo">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Descripcion</label>
          <div class="col-md-4">
            <input type="text" class="form-control" value="<%$partida->descripcion%>" 
            name="descripcion"  placeholder="Descripcion">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4 col-md-offset-3">
            <input type="submit" name="" class="btn btn-warning" value="Editar">

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar</button>

          </div>
        </div> 

      </form>

      <form class="col-md-1" action="/financiero/public/partida/<%$partida->idPartida%>/delete" method="post">
        <input type="hidden" name="_token" value="<% csrf_token() %>">
        @if(Auth::user() AND Auth::user()->tienePermiso('Borrar Partida', Auth::user()->id))
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
