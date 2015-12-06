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
  <div class="col-md-10 col-md-offset-1 alert bg-info container-fluid table-responsive" >
    <br>
    <div class="container-fluid col-md-7 form-horizontal">
      <div class="form-group">
        <label class="col-md-6 control-label">Partida:</label>
        <div class="col-md-6">
          <input type="text"  class="form-control" readonly value="14451">
        </div>      
      </div >

      <div class="form-group">
        <label class="col-md-6 control-label">Tipo de Transaccion:</label>
        <div class="col-md-6">
          <select name="estado" class="form-control">
            <option value="Activo" >Factura Credito</option>
            <option value="Activo" selected>Factura Pendiente</option>
            <option value="Activo" >Reintegro de caja chica</option>
            <option value="Activo" >Solicitud GECO</option>
            <option value="Activo" >Pases adicionales</option>
            <option value="Activo" >Pases anulacion</option>
            <option value="Activo" >Requesicion Paq. Basico</option>
            <option value="Activo" >Ordenes de Servicio</option>
            <option value="Inactivo">Otros</option>
          </select>
        </div>

      </div>
    </div>

    <div class="container-fluid col-md-5 form-horizontal">

      <div class="form-group text-left">
        <label class="col-md-5 control-label"># de Factura:</label>
        <div class="col-md-7">
          <input type="text"  class="form-control" readonly value="14451">
        </div>
      </div >

      <div class="form-group">
        <label class="col-md-5 control-label">Fecha:</label>
        <div class="col-md-7">
          <input type="date"  class="form-control">
        </div>
      </div>
    </div>

    <div id="prueba">

    </div>
    <div class="container-fluid table-responsive"  ng-controller="facturaTemplate">
    <form action="/" method="get"> 

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
              <td>{{$index+1}}</td>
              <td><input type="text" name="" value="{{x.detalle}}" placeholder="" required class="form-control"></td>
              <td>
                <div class="input-group">
                  <div class="input-group-addon">₡</div>
                  <input type="number" ng-model="x.precio" class="form-control" id="exampleInputAmount" value="{{x.precio}}" min="0" required >
                </div>
              </td>
              <td><input type="number" ng-model="x.cantidad" value="{{x.cantidad}}" class="form-control"  min="0" required></td>
              <td><div class="input-group">
                <div class="input-group-addon">₡</div>
                <input class="form-control" type="text" placeholder="0" value="{{x.total = x.precio * x.cantidad}}" readonly>
              </div></td>
              <td><button class="btn btn-danger btn-xs" ng-click="eliminarFila($index)">x</button></td>
            </tr> 
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <th class="text-right">Total:</th>
              <td ng-bind="calcularFactura()"></td>

            </tr>

      </table>
      <div class="form-group">
        <input type="submit" value="Enviar" class="btn btn-primary pull-right">
      </div>
      </form>
            <button class="btn btn-primary btn-xs" ng-click="agregarFila()">+</button>

    </div>
  </div>
</section>
@else
Debe estar autenticado y tener permisos para ver esta pagina
@endif
@endsection