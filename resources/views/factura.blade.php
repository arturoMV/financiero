@extends('/layouts.master')
@section('title', 'Partida')

@section('partida')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user())


<section class="container-fluid">
  <br>
  <form class="col-md-10 col-md-offset-1 alert bg-info container-fluid table-responsive form-horizontal" method="post" action="/financiero/public/transaccion" >
    <br>
    {!!csrf_field()!!}
    <div class="container-fluid col-md-7 ">
      <div class="form-group">
        <label class="col-md-6 control-label">Partida:</label>
        <div class="col-md-6">
          <input type="text"  class="form-control" readonly  name="tPartida_idPartida" required value="<%$partida->idPartida%>">
        </div>      
      </div >

      <div class="form-group">
        <label class="col-md-6 control-label">Tipo de Transaccion:</label>
        <div class="col-md-6">
          <select name="vTipoFactura" class="form-control" required>
            <option value="Factura credito" >Factura Credito</option>
            <option value="Factura pendiente" selected>Factura Pendiente</option>
            <option value="Reintegro de caja chica" >Reintegro de caja chica</option>
            <option value="Solicitud GECO" >Solicitud GECO</option>
            <option value="Pases Adicionales" >Pases adicionales</option>
            <option value="Pases Anulacion" >Pases anulacion</option>
            <option value="Requesicion" >Requesicion Paq. Basico</option>
            <option value="Orden de servicio" >Ordenes de Servicio</option>
            <option value="Otros">Otros</option>
          </select>
        </div>

      </div>
    </div>

    <div class="container-fluid col-md-5">

      <div class="form-group text-left">
        <label class="col-md-5 control-label"># de Factura:</label>
        <div class="col-md-7">
          <input type="text"  class="form-control" readonly value="<%$numFactura%>">
        </div>
      </div >

      <div class="form-group">
        <label class="col-md-5 control-label">Fecha:</label>
        <div class="col-md-7">
          <input type="date"  class="form-control" name="dFechaFactura" required> 
        </div>
      </div>

    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Descripcion:</label>
        <div class="col-md-8">
          <input type="text" name="vDescripcion" class="form-control">
        </div>
      </div>


    <div class="container-fluid table-responsive"  ng-controller="facturaTemplate">

        <table  class="table table-condensed text-center">

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
            <tr ng-repeat="x in factura">
              <td>{{$index+1}}<input type="number" name="linea{{$index+1}}" hidden value="{{$index+1}}" placeholder=""></td>
              <td><input type="text" name="detalle{{$index+1}}" value="{{x.detalle}}" required class="form-control"></td>
              <td>
                <div class="input-group">
                  <div class="input-group-addon">₡</div>
                  <input type="number" ng-model="x.precio" class="form-control"  name="precio{{$index+1}}" value="{{x.precio}}" min="0" required >
                </div>
              </td>
              <td><input type="number" ng-model="x.cantidad" name="cantidad{{$index+1}}" value="{{x.cantidad}}" class="form-control"  min="0" required></td>
              <td><div class="input-group">
                <div class="input-group-addon">₡</div>
                <input class="form-control" type="text" placeholder="0" name="total{{$index+1}}" value="{{x.total = x.precio * x.cantidad}}" readonly>
              </div></td>
              <td><button class="btn btn-danger btn-xs" ng-click="eliminarFila($index)">x</button></td>
            </tr> 
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <th class="text-right">Total:</th>
              <td >{{calcularFactura()| currency:"₡":0}}</td>
              <input type="number" name="iMontoFactura" hidden value="{{calcularFactura()}}" placeholder="">

            </tr>

          </table>
          <div class="form-group">
            <input type="submit" value="Agregar"  class="btn btn-primary pull-right">
          </div>
        </form>
        <button class="btn btn-primary btn-xs" ng-click="agregarFila()">+</button>

      </div>
      
  </section>
  @else
  Debe estar autenticado y tener permisos para ver esta pagina
  @endif
  @endsection