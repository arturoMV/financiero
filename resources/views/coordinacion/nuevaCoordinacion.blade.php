@extends('/layouts.master')
@section('title', 'Partida')
@section('coord')
class="active"
@endsection
@section('content')
@parent
<section>
  <div class="wrapper col-md-10">
    <br>
    @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Coordinacion'))

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Ops!</strong> Error al agregar<br><br>
            <ul>
              <li><%$errors%></li>
            </ul>
     </div> 
    @endif
    <form action="/coordinacion" class="form-horizontal" method="post" onsubmit="buttonName.disabled=true; return true;">
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">Numero Coordinación</label>
        <div class="col-md-4">
          <input type="number" class="form-control" name="idCoordinacion" placeholder="Numero de la Coordinación" min="1" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Nombre</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="vNombreCoordinacion" placeholder="Nombre de la Coordinación" 
          pattern="[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+" title="Este campor solo acepta letras y numeros" required>
        </div>
      </div>
      <div class="form-group">
          <div class="col-md-4 col-md-offset-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Agregar</button>
          </div>
      </div>

      <div class="col-md-5">
        @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Coordinacion'))
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirmar</h4>
              </div>
              <div class="modal-body">
              <p>Estas seguro de que quieres agregar la coordinación.</p>
              
                      <input type="submit" name="buttonName" class="btn btn-success" value="Agregar">
                      <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div> 
                </div>
              </div> 
              @endif
            </div>
      </form>
      @else
      Debe estar autenticado y tener permisos para ver esta pagina
      @endif
    </div>	
  </section> 
  @endsection
