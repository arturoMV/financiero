@extends('/layouts.master')
@section('title', 'Partida')

@section('partida')
class="active"
@endsection
@section('content')
@parent
@if(Auth::user() AND Auth::user()->tienePermiso('Ver Partida')AND Auth::user()->tieneCoordinacion($coordinacion->idCoordinacion))
<section>
  <div class="wrapper">
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
      <strong>Bien!</strong>Se realizaron cambios<br><br>
      <ul>
        <li><% $mensaje %></li>
      </ul>
    </div> 
    @endif

    <form class="col-md-12 form-horizontal" action="/financiero/public/partida/editar/<%$presupuesto_partida->id%>" method="post">
      <h2>Editar Presupuesto de la partida</h2>
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">Unidad Ejecutora</label>
        <p class="col-md-8 form-control-static">
          <a href="/financiero/public/coordinacion/<%$coordinacion->idCoordinacion%>" title="">
            <%$coordinacion->idCoordinacion%>-<% $coordinacion->vNombreCoordinacion %></a></p>         
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Presupuesto</label>
            <p class="col-md-8 form-control-static">
              <a href="/financiero/public/presupuesto/<%$presupuesto->idPresupuesto%>" title=""><%$presupuesto->vNombrePresupuesto%> - 
                <%$presupuesto->anno%></a></p>         
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Partida</label>
                <p class="col-md-2 form-control-static"><% $partida->codPartida %></p>

              </div >
              <div  class="form-group">
                <label class="col-md-4 control-label">Nombre de Partida</label>
                <p class="col-md-8 form-control-static"><%$partida->vNombrePartida%></p>      
              </div>

              <div  class="form-group">
                <label class="col-md-4 control-label">Presupuesto Inicial</label>
                <div class="col-md-4" ng-init="presu = <%$presupuesto_partida->iPresupuestoInicial%>"> 
                  <input type="number" class="form-control" ng-model="presu"   name="iPresupuestoInicial"  placeholder="presupuesto al Principio del periodo">{{presu | currency :"₡":0}}
                </div>      
              </div>


              <div class="col-md-6 form-group ">
                @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Editar</button>
                @endif
              </div> 

              <div class="col-md-5">
                @if(Auth::user() AND Auth::user()->tienePermiso('Editar Partida', Auth::user()->id))
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmar</h4>
                      </div>
                      <div class="modal-body">
                        <p>Estas seguro de que quieres modificar los datos de la partida.</p>
                        <p><div class="form-group">
                          <label class="col-md-4 control-label">Unidad Ejecutora</label>
                          <p class="col-md-8 form-control-static">
                            <a href="/financiero/public/coordinacion/<%$coordinacion->idCoordinacion%>" title="">
                              <%$coordinacion->idCoordinacion%>-<% $coordinacion->vNombreCoordinacion %></a></p>         
                            </div>

                            <div class="form-group">
                              <label class="col-md-4 control-label">Presupuesto</label>
                              <p class="col-md-8 form-control-static">
                                <a href="/financiero/public/presupuesto/<%$presupuesto->idPresupuesto%>" title=""><%$presupuesto->vNombrePresupuesto%> - 
                                  <%$presupuesto->anno%></a></p>         
                                </div>
                                <div class="form-group">
                                  <label class="col-md-4 control-label">Partida</label>
                                  <p class="col-md-4 form-control-static"><% $partida->codPartida %></p>

                                </div >
                                <div  class="form-group">
                                  <label class="col-md-4 control-label">Nombre de Partida</label>
                                  <p class="col-md-8 form-control-static"><%$partida->vNombrePartida%></p>      
                                </div>
                                <div  class="form-group">
                                  <label class="col-md-4 control-label">Presupuesto Inicial</label>
                                  <p class="col-md-8 form-control-static">{{presu | currency :"₡":0}}</p>      
                                </div>
                              </p>
                              <input type="submit" name="" class="btn btn-warning" value="Editar">
                              <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
                            </div>
                          </div> 
                        </div>
                      </div> 
                      @endif
                    </div>
                  </form>
                </div >

              </section> 
              @else
              Debe estar autenticado y tener permisos para ver esta pagina
              @endif
              @endsection
