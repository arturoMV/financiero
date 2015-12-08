



@extends('/layouts.master')
  @section('title', 'Partida')

  @section('partida')
    class="active"
  @endsection
  @section('content')
  @parent
    @if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida', Auth::user()->id))
    <section>
    <div class="wrapper">
      <form class="col-md-12 form-horizontal" action="/financiero/public/partida/<%$partida->idPartida%>/edit" method="get"> 
        <div class="form-group">
          <label class="col-md-4 control-label">ID Partida</label>
          <p class="col-md-2 form-control-static"><%$partida->idPartida%></p>
       
       </div >

      <div class="form-group">
        <label class="col-md-4 control-label">ID Presupuesto</label>
        <p class="col-md-8 form-control-static">
        <a href="/financiero/public/presupuesto/<%$partida->tPresupuesto_idPresupuesto%>" title=""><%$presupuesto->tCoordinacion_idCoordinacion%>-<%$partida->tPresupuesto_anno%> - 
        <%$presupuesto->vNombrePresupuesto%></a></p>
         
      </div>

         <div  class="form-group">
          <label class="col-md-4 control-label">Nombre de Partida</label>
          <p class="col-md-8 form-control-static"><%$partida->vNombrePartida%></p>      
      </div>
      @if($partida->descripcion!="")
       <div class="form-group">
        <label class="col-md-4 control-label">Descripcion:</label>
          <p class="col-md-8 form-control-static"><%$partida->descripcion%></p>
      </div>
      @endif

       <div class="col-md-6 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
          <input type="submit" name="" class="btn btn-warning" value="Editar">
        @endif

         @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
         <a href="/financiero/public/transaccion/create/<%$partida->idPartida%>" name="" class="btn btn-primary">Agregar Transaccion</a>
        @endif
      </div> 
             
    </form>
    <div class="col-md-12">
      <hr>
  <h3>Estado de la partida</h3>
<div class="">
  <h4>Presupuesto Incial: <small>{{<%$partida->iPresupuestoInicial%> | currency: "₡":0}}</small><br>
  Presupuesto Modificado: <small>{{<%$partida->iPresupuestoModificado%> | currency: "₡":0}}</small> <br>
  Gasto: <small>{{<%$partida->gasto%> | currency: "₡":0}} </small> <br>
  Saldo: <small>{{<%$partida->saldo%> | currency: "₡":0}}</small></h4>
</div>
<div class="progress">
  <div class="progress-bar progress-bar-danger" style="width: <% $partida->calcularGastoPorcentaje() %>%">
    <span class="sr-only"></span>
    <% round($partida->calcularGastoPorcentaje(),2) %>%
  </div>
  <div class="progress-bar progress-bar-primary" style="width: <% $partida->calcularSaldoPorcentaje()%>%">
    <span class="sr-only"></span>
    <% round($partida->calcularSaldoPorcentaje(),2) %>%
  </div>
</div>
<div class="alert alert-warning col-md-1 col-md-offset-4">
  Gasto: <% round($partida->calcularGastoPorcentaje(),2) %>% <br>
</div>

<div class="alert alert-success col-md-1 col-md-offset-1">
  Saldo: <% round($partida->calcularSaldoPorcentaje(),2) %>%
</div>

<div class="col-md-12">
<br>
<hr>
  <h3>Ultimas Transacciones</h3>

</div>
    </div>
    </div>
      </section> 
    @else
      Debe estar autenticado y tener permisos para ver esta pagina
    @endif
  @endsection
