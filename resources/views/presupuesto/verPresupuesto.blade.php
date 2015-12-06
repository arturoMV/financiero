@extends('/layouts.master')
  @section('title', 'Presupuesto')

  @section('presupuesto')
    class="active"
  @endsection
  @section('content')
  @parent
    @if(Auth::user() AND Auth::user()->tienePermiso('Ver Presupuesto', Auth::user()->id))
    <section>
    <div class="wrapper">
      <form class="col-md-7 form-horizontal" action="/financiero/public/presupuesto/<%$presupuesto->idPresupuesto%>/edit" method="get"> 
        <div class="form-group">
          <label class="col-md-4 control-label">ID Presupuesto:</label>
          <p class="col-md-2 form-control-static"><%$presupuesto->idPresupuesto%></p>
       
       </div >

      <div class="form-group">
        <label class="col-md-4 control-label">Año:</label>
        <p class="col-md-8 form-control-static"><%$presupuesto->anno%></p>
         
      </div>

         <div  class="form-group">
          <label class="col-md-4 control-label">Coordinacion:</label>
          <p class="col-md-8 form-control-static"><%$coordinacion->idCoordinacion%> - <%$coordinacion->vNombreCoordinacion%></p>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">Nombre:</label>
      <p class="col-md-8 form-control-static"><%$presupuesto->vNombrePresupuesto%></p>
      </div>
    

      <div class="form-group">
        <label class="col-md-4 control-label">Monto Presupuestado:</label>
          <p class="col-md-8 form-control-static"><%$presupuesto->iPresupuestoInicial%></p>
      </div>

       <div class="col-md-4 form-group ">
        @if(Auth::user() AND Auth::user()->tienePermiso('Editar Presupuesto', Auth::user()->id))
          <input type="submit" name="" class="btn btn-success pull-right" value="Editar">
        @endif
      </div> 
             
    </form>
    </div>
    </section> 
    @else
      Debe estar autenticado y tener permisos para ver esta pagina
    @endif
  @endsection
