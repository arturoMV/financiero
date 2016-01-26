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
    @if(Auth::user() AND Auth::user()->tienePermiso('Agregar Partida', Auth::user()->id))

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
    <script type="text/javascript">
    
    </script>

    <form action="/partida" class="form-horizontal" method="post">
      <input type="hidden" name="_token" value="<% csrf_token() %>">  
      <div class="form-group">
        <label class="col-md-4 control-label">Código de Paritda</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="codPartida" id="codPartida" value="" required placeholder="0-00-00-00">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label">Nombre de Partida</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="vNombrePartida"  required placeholder="Nombre que identifica el gasto" pattern="[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+" title="Este campor solo acepta letras y numeros">
        </div>
        </div>
      
        <div class="form-group">
          <label class="col-md-4 control-label">Descripción</label>
          <div class="col-md-6">
            <textarea class="form-control" rows="5" required name="vDescripcion" pattern="[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+" title="Este campor solo acepta letras y numeros"></textarea>
          </div>
        </div>


        <div class="form-group">
          <div class="col-md-4 col-md-offset-4">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Agregar</button>
          </div>
        </div>
      <div class="col-md-5">
        <div class="modal fade" id="myModal2" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirmar</h4>
              </div>
              <div class="modal-body">
                <p>Estas seguro de que quieres agregar la partida.
                  <ul>
                    <li>Verifique que los datos introducidos sean correctos</li>
                  </ul>
                </p>
                
                  <input type="submit" name="" class="btn btn-success" value="Agregar">
                  <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
              </div>
            </div> 
          </div>
        </div> 
      </div>

      </form>
    </div>
      @else
      Debe estar autenticado y tener permisos para ver esta pagina
      @endif
  </section> 
  @endsection
