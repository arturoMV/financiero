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
  <div class="alert alert-danger">
    <strong>Oops!</strong> Error en la transaccion<br><br>
    <ul>
      @foreach ($errors->all() as $error)
      <li><% $error %></li>
      @endforeach
    </ul>
  </div> 
  @endif
  <form class="col-md-12 alert container-fluid table-responsive form-horizontal" method="post" action="/financiero/public/transaccion" >
    {!!csrf_field()!!}
    <div class="col-md-12">
    </div>
    <div class="container-fluid col-md-7 ">
     

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
            <option value="Requisicion" >Requesicion Paq. Basico</option>
            <option value="Orden de servicio" >Ordenes de Servicio</option>
            <option value="Otros">Otros</option>
          </select>
        </div>
      </div>

      <div class="form-group">
      <label class="col-md-6 control-label">Observacion:</label>
      <div class="col-md-6">
        <textarea name="vDescripcionFactura" class="form-control" rows="2"></textarea> 
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
    
    <div class="container-fluid table-responsive col-md-12"  ng-controller="facturaTemplate">


      <table  class="table table-condensed text-center col-md-12">
        <thead>
          <tr>
            <th class="col-md-1 text-center">#</th>
            <th class="col-md-6 text-center">Partida</th>
            <th class="col-md-3 text-center">Detalle</th>
            <th class="col-md-3 text-center">Monto</th>


          </tr>
        </thead>
        <tbody id="factura" <% $count = 1 %>>
          <tr ng-repeat="x in factura">
            <td>{{$index+1}}</td>
           <td><div ng-controller="coordinacionTemplate">
              <div class="container-fluid search-container form-horizontal" ng-controller="presupuestoTemplate">
              <div class="container-fluid" ng-controller="partidaTemplate" >
                <div class="col-md-12">
                  <div class="panel panel-primary">
                    
                    <div class="panel-body">
                      <div class="form-group col-md-12">
                        <strong>Unidad Ejecutora</strong>
                        <select ng-model="coorSelected"  required class="form-control">
                          <option  ng-repeat="coordinacion in modelC" value="{{coordinacion.idCoordinacion}}">{{coordinacion.idCoordinacion}}-{{coordinacion.vNombreCoordinacion}}</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12" >
                        <strong>Presupuesto</strong>
                        <select ng-model="pSelected"  required class="form-control">
                          <option  ng-if="presupuesto.tCoordinacion_idCoordinacion == coorSelected" ng-repeat="presupuesto in modelPr" value="{{presupuesto.idPresupuesto}}">{{presupuesto.vNombrePresupuesto}}-{{presupuesto.anno}}</option>
                        </select>
                      </div>
                      <strong>Partida</strong>
                      <div class="form-group col-md-12">
                        <select ng-model="partSelected" required class="form-control">
                          <option ng-if="partida.tPresupuesto_idPresupuesto == pSelected" ng-repeat="partida in modelP" value="{{partida.id}}">{{partida.codPartida}}-{{partida.vNombrePartida}}</option>
                        </select>
                      </div>
                      <div><hr>
                        <div ng-if="partida.id == partSelected" ng-repeat="partida in modelP">
                          <strong>Presupuesto Incial: <small>{{partida.iPresupuestoInicial | currency: "₡":0}}</small><br>
                            Presupuesto Modificado: <small>{{partida.iPresupuestoModificado | currency: "₡":0}}</small> <br>
                            Gasto: <small>{{partida.iGasto | currency: "₡":0}} </small> <br>
                            Saldo: <small>{{partida.iSaldo | currency: "₡":0}}</small></strong>
                            <input type="hidden" name="id{{$index+1}}" required value="{{partida.id}}">
                          </div ng-model="x.maximo = partida.iSaldo">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                </div>
                </td>
<td>
<div class="form-group">
        <div class="col-md-12">
          <input type="text" class="form-control" ng-model="x.detalle" required name="detalle{{$index+1}}">
        </div>
      </div>  
    </td>
    <td>
      <div class="form-group">
        <div class="col-md-12">
          <input type="number" class="form-control" ng-model="x.monto" required name="iMontoFactura{{$index+1}}" min="0">
        </div>
        <br><br><br>
        <br><br><br>
        <br><br><br>   <br>

        <button type="button" class="btn btn-sm btn-danger" ng-click="eliminarFila()">Remover fila</button>
      </div>
</td>
                </tr>
                  <tr>
                  <td></td>
                  <td ></td>
                  <th class="text-right">Total:</th>
                  <td >{{calcularFactura()| currency:"₡":0}}</td>
                </tr>
              </tbody>
            </table>

            <div class="form-group">
              <input type="submit" value="Agregar Factura"  class="btn btn-primary pull-right">
            </div>
          </form>

          <button class="btn btn-primary btn-sm" ng-click="agregarFila()">Agregar Partida</button>
          </div>

        </div>

      </section>
      @else
      Debe estar autenticado y tener permisos para ver esta pagina
      @endif
      @endsection