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
        <label class="col-md-4 control-label">ID Partida</label>
        <div class="col-md-6">
          <input type="number" class="form-control" name="idPartida" placeholder="ID de Partida" maxlength="7">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Coordinacion</label>
        <div class="col-md-6">
          <select name="tPresupuesto_idPresupuesto" class="form-control" required>
            <option value="0">Selecione a que Presupuestpo pertenece la Partida</option>
            @foreach($presupuestos as $presupuesto)
              <option value="<% $presupuesto->idPresupuesto %>"><% $presupuesto->idPresupuesto %> - <% $presupuesto->vNombrePresupuesto %></option>
            @endforeach
          </select>
        </div>
        </div>
      
        <div class="form-group">
          <label class="col-md-4 control-label">Año</label>
          <div class="col-md-6">
            <input type="number" class="form-control" name="tPresupuesto_anno" value="<% $config->iValor %>" readonly maxlength="4">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Nombre de Partida</label>
          <div class="col-md-6">
            <input type="text" class="form-control"  name="vNombrePartida" placeholder="Nombre de la partida">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Presupuesto Inicial</label>
          <div class="col-md-6">
            <input type="number" class="form-control" ng-model="saldo" name="iPresupuestoInicial" placeholder="Monto presupuestado">
          </div>
        </div>

                <div class="form-group">
          <label class="col-md-4 control-label">Presupuesto Modificado</label>
          <div class="col-md-6">
            <input type="number" class="form-control"  value="{{saldo}}" name="iPresupuestoModificado" placeholder="Cambios en el presupuestado" readonly>
          </div>
        </div>


        <div class="form-group">
          <label class="col-md-4 control-label">Gasto de la  Partida</label>
          <div class="col-md-6">
            <input type="number" class="form-control" name="gasto" placeholder="El gasto aumenta con las transacciones" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Saldo de la Partida</label>
          <div class="col-md-6">
            <input type="number" class="form-control" name="saldo" value="{{saldo}}" readonly placeholder="El saldo se calcula con el gasto">
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
