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
  <div class="col-md-10 col-md-offset-1 alert bg-success container-fluid table-responsive" >
    <br>
    <div class="container-fluid col-md-6 form-horizontal">
      <div class="form-group">
        <label class="col-md-6 control-label">Partida:</label>
        <pre class="col-md-5 form-control-static">46548</pre>
      </div >
    </div>

    <div class="container-fluid col-md-6 form-horizontal">

      <div class="form-group text-left">
        <label class="col-md-6 control-label"># de Factura:</label>
        <pre class="col-md-5 form-control-static">46548</pre>
      </div >

      <div class="form-group">
        <label class="col-md-6 control-label">Fecha:</label>
        <pre class="col-md-5 form-control-static">24/24/1943</pre>
      </div>
    </div>

    <div id="prueba">

    </div>
    <div class="container-fluid table-responsive">
      <table  class="table table-condensed text-center">

        <thead>
          <tr>

            <th class="col-md-4 text-center">Detalle</th>
            <th class="col-md-3 text-center">Precio</th>
            <th class="col-md-1 text-center">Cantidad</th>

            <th class="col-md-3 text-center">Monto</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="factura">
          <tr>
            <td contenteditable="">producto</td>
            <td contenteditable="" oninput="calcularMonto(this);">0</td>
            <td contenteditable="" class="has-error" id="input-Error1" oninput="calcularMonto(this);">0</td>
            <td>0</td>
            <td><button class="btn btn-danger btn-xs" onclick="eliminarFila(this)">x</button></td>
          </tr>

          <tr>
            <td><input type="text" name="" value="" placeholder="" class="form-control"></td>
            <td>
              <div class="input-group">
                <div class="input-group-addon">₡</div>
                <input type="number" class="form-control" id="exampleInputAmount" placeholder="Precio">
              </div>
            </td>
            <td><input type="number" name="" value="0" placeholder="" class="form-control"></td>
            <td><div class="input-group">
              <div class="input-group-addon">₡</div>
              <input class="form-control" type="text" placeholder="0" readonly>
            </div></td>
            <td><button class="btn btn-danger btn-xs" onclick="eliminarFila(this)">x</button></td>
          </tr>
          <tr>
            <td></td>

            <td></td>
            <th class="text-right">Total:</th>
            <td>Monto Total</td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <button class="btn btn-primary btn-xs" onclick="insertarFila()">+</button>
    </div>
  </div>



</section>
@else
Debe estar autenticado y tener permisos para ver esta pagina
@endif
@endsection