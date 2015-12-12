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
  <form class="col-md-10 col-md-offset-1 alert bg-info container-fluid table-responsive form-horizontal" method="post" action="/financiero/public/transaccion" >
    {!!csrf_field()!!}
    <div class="col-md-12">
      <h4>
        Unidad Ejecutora: <small><%$coordinacion->vNombreCoordinacion%></small><br><br>
        Presupuesto: <small><%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%></small><br><br>

      </h4>
    </div>

    <input type="hidden" name="iSaldo" value="<%$presupuesto_partida->iSaldo%>">
    <input type="hidden" name="tPartida_idPartida" value="<%$presupuesto_partida->id%>">

    <div class="container-fluid col-md-7 ">
      <div class="form-group">
        <label class="col-md-6 control-label">Partida:</label>
        <div class="col-md-6">
          <input type="text"  class="form-control" readonly  name="tPartida_idPartidas" required value="<%$partida->codPartida%>">
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
  <div class="form-group">
        <label class="col-md-5 control-label">Fecha:</label>
        <div class="col-md-7">
          <input type="date"  class="form-control" name="dFechaFactura" required> 
        </div>
      </div>


      <div class="form-group text-left">
        <label class="col-md-6 control-label">Num. Documento:</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="vDocumento" value="No Aplica">
        </div>
      </div >
    </div>
<div class="form-group">
        <label class="col-md-3 control-label">Descripcion:</label>
        <div class="col-md-8">
          <textarea name="vDescripcionFactura" class="form-control" rows="2"></textarea> 
        </div>
      </div>
    <div class="container-fluid table-responsive"  ng-controller="facturaTemplate">
          <input type="number" name="iMontoFactura" hidden value="{{calcularFactura()}}">


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
              <th class="text-right">Saldo Disponible:</th>
              <td >{{<%$presupuesto_partida->iSaldo%> | currency:"₡":0  }}
              </td>
              <th class="text-right">Total:</th>
              <td >{{calcularFactura()| currency:"₡":0}}</td>
            </tr>
          </tbody>
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