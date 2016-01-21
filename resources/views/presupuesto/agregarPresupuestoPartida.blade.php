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
    @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Partida')AND Auth::user()->tieneCoordinacion($coordinacion->idCoordinacion) AND date('Y') == $presupuesto->anno)

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

    @if (count($mensaje) > 0)
    <div class="alert alert-success">
        <strong>Bien!</strong> Se le agrego una partida al presupuesto<br><br>
        
    </div> 
    @endif 

    <form action="/partida/<%$presupuesto->idPresupuesto%>/agregar" class="form-horizontal" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">Coordinación</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="coordo" readonly value="<%$coordinacion->idCoordinacion%>-<%$coordinacion->vNombreCoordinacion%>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Presupuesto</label>
        <div class="col-md-6">
           <input  class="form-control" name="vNombrePartida" readonly value="<%$presupuesto->vNombrePresupuesto%>-<%$presupuesto->anno%>">
        </div>
        </div>
      
        <div class="form-group">
          <label class="col-md-4 control-label">Partida</label>
          <div class="col-md-6">
            <select class="form-control" required name="tPartida_idPartida">
              @foreach($partida as $par)
              <option value="<%$par->idPartida%>"><%$par->codPartida%>  <%$par->vNombrePartida%></option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Monto Presupuestado</label>
          <div class="col-md-6">
            <input type="number" class="form-control" required name="iPresupuestoInicial" min="1"></textarea>
          </div>
        </div>


        <div class="form-group">
          <div class="col-md-4 col-md-offset-4">
            <input type="submit" class="btn btn-success" value="Agregar">
          </div>
        </div>

      </form>
      @else
      @if($date = date('Y') != $presupuesto->anno)
        No puede agregar una partida a un presupusto que no sea del presente año
      @else
        Debe estar autenticado y tener permisos para ver esta pagina
      @endif
      @endif
  </section> 
  @endsection
