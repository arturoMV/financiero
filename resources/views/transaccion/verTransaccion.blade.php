@extends('/layouts.master')
@section('title', 'Partida')

@section('partida')
class="active"
@endsection
@section('content')
@if(Auth::user())


<section class="container-fluid">
  <br>
  @if (count($errors) > 0)
  <div class="alert alert-danger col-md-6">
    <strong>Oops!</strong> Error en la transaccion<br><br>
    <ul>
      @foreach ($errors->all() as $error)
      <li><% $error %></li>
      @endforeach
    </ul>
  </div> 
  @endif
  <div class="col-md-11 container-fluid table-responsive form-horizontal">
  <div class="panel panel-primary" method="post" action="/financiero/public/transaccion" >
    <div class="panel panel-heading">
      <label> Unidad Ejecutora: <small><%$coordinacion->vNombreCoordinacion%></small></label>
      <label> Presupuesto: <small><%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%></small></label>
    </div>
    <div class="panel-body">
      <div class="container-fluid col-md-7 ">
        <div class="form-group">
          <label class="col-md-6 control-label">Partida:</label>
          <div class="col-md-6">
            <input type="text"  class="form-control" readonly  name="tPartida_idPartida" required value="<%$partida->codPartida%>">
          </div>      
        </div >

        <div class="form-group">
          <label class="col-md-6 control-label">Tipo de Transaccion:</label>
          <div class="col-md-6">
            <select name="vTipoFactura" class="form-control" required readonly>
              <option value="Factura credito" ><% $factura->vTipoFactura%></option>
            </select>
          </div>

        </div>
      </div>

      <div class="container-fluid col-md-5">
        <div class="form-group">
          <label class="col-md-5 control-label">Fecha:</label>
          <div class="col-md-7">
            <input type="date"  class="form-control" value="<% $factura->dFechaFactura%>" readonly name="dFechaFactura" required> 
          </div>
        </div>


        <div class="form-group text-left">
          <label class="col-md-6 control-label">Num. Documento:</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="vDocumento" value="<% $factura->vDocumento%>" readonly>
          </div>
        </div >
      </div>
      @if($factura->vDescripcionFactura!="")
      <div class="form-group">
        <label class="col-md-3 control-label">Descripcion:</label>
        <div class="col-md-8">
          <textarea name="vDescripcionFactura" class="form-control" rows="2" readonly><% $factura->vDescripcionFactura%></textarea>
        </div>
      </div>
      @endif
      <div class="container-fluid table-responsive">
        <table  class="table table-condensed text-center" ng-controller="facturaTemplate">
          <thead>
            <tr>
              <th class="col-md-1 text-center">#</th>
              <th class="col-md-4 text-center">Detalle</th>
              <th class="col-md-3 text-center">Monto</th>
              <th class="col-md-1 text-center">Cantidad</th>
              <th class="col-md-3 text-center">Total</th>
            </tr>
          </thead>
          <tbody id="factura">
            @foreach($detalles as $detalle)
            <tr>
              <td><% $detalle->iLinea%></td>
              <td><input type="text"  value="<% $detalle->vDetalle%>" required class="form-control" readonly></td>
              <td>
                <div class="input-group">
                  <div class="input-group-addon">₡</div>
                  <input type="text"  class="form-control" value='{{<% $detalle->iPrecio %>| currency:"₡":0}}'readonly>
                </div>
              </td>
              <td><input type="text" value="<% $detalle->iCantidad%>" class="form-control" readonly></td>
              <td><div class="input-group">
                <div class="input-group-addon">₡</div>
                <input class="form-control" type="text" value='{{<% $detalle->iTotalLinea%>| currency:"₡":0}}' readonly>
              </div></td>
            </tr> 
            @endforeach
            <tr>
              <td></td>
              <th></th>
              <td ></td>
              <th class="text-right">Total:</th>
              <td >{{<% $factura->iMontoFactura%>| currency:"₡":0}}</td>
            </tr>
          </tbody>
        </table>

        <div class="form-group">
          <a href="/financiero/public/partida/<%$presupuesto_partida->id%>" class="btn btn-primary pull-right" >Volver a la Partida</a>
        </div>
      </div>
    </div>
  </div>
  </div>

</section>
@else
Debe estar autenticado y tener permisos para ver esta pagina
@endif
@endsection