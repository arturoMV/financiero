@extends('/layouts.master')
@section('title', 'Partida')
@section('partida')
  class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
<section>
  <div class="wrapper">
    <br>
    <form class="col-md-12 form-horizontal" action="/financiero/public/partida/<%$partida->idPartida%>/put" 
    method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">    

<div class="form-group">
        <label class="col-md-4 control-label">ID Partida</label>
        <div class="col-md-6">
          <input type="number" class="form-control" name="idPartida" value="<%$partida->idPartida%>" placeholder="ID de Partida" maxlength="7">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Coordinacion</label>
        <div class="col-md-6">
          <select name="tPresupuesto_idPresupuesto" class="form-control" required>
            <option value="0">Selecione a que Presupuestpo pertenece la Partida</option>
            @foreach($presupuestos as $presupuesto)
              <option 
                @if($presupuesto->idPresupuesto == $partida->tPresupuesto_idPresupuesto)
                  selected
                @endif
                value="<% $presupuesto->idPresupuesto %>"><% $presupuesto->idPresupuesto %> - <% $presupuesto->vNombrePresupuesto %></option>
            @endforeach
          </select>
        </div>
        </div>
      
        <div class="form-group">
          <label class="col-md-4 control-label">Año</label>
          <div class="col-md-6">
            <input type="number" class="form-control" name="tPresupuesto_anno" value="<%$partida->tPresupuesto_anno%>" readonly maxlength="4">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Nombre de Partida</label>
          <div class="col-md-6">
            <input type="text" class="form-control"  name="vNombrePartida" value="<%$partida->vNombrePartida%>" placeholder="Nombre de la partida">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Presupuesto Inicial</label>
          <div class="col-md-6">
            <input type="number" class="form-control" value="<%$partida->iPresupuestoInicial%>" name="iPresupuestoInicial" placeholder="Monto presupuestado" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Presupuesto Modificado</label>
          <div class="col-md-6">
            <input type="number" class="form-control" value="<%$partida->iPresupuestoModificado%>" name="iPresupuestoModificado" placeholder="Monto presupuestado">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Gasto de la  Partida</label>
          <div class="col-md-6">
            <input type="number" class="form-control" name="gasto" value="<%$partida->gasto%>" placeholder="El gasto aumenta con las transacciones" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Saldo de la Partida</label>
          <div class="col-md-6">
            <input type="number" class="form-control" name="saldo" value="<%$partida->saldo%>" readonly placeholder="El saldo se calcula con el gasto">
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
