  @extends('/layouts.master')
  <html>
  <head>
  @section('title', 'Usuario')
  </head>
  <body>
  @section('usuario')
    class="active"
  @endsection
  @section('content')
  @parent
    @if(Auth::user() AND Auth::user()->tienePermiso('Administrar Usuarios', Auth::user()->id))
  	<section>
  	<div class="wrapper">
    <br>
        <form class="col-md-7 form-horizontal" action="/usuario/<%$usuario->id%>/edit" method="get"> 
          <div class="form-group">
            <label class="col-md-4 control-label">Nombre de Usuario:</label>
            <p class="col-md-8 form-control-static"><% $usuario->name %></p>
          </div >
          <div class="form-group">
            <label class="col-md-4 control-label">Email:</label>
            <p class="col-md-8 form-control-static"><% $usuario->email %></p>
          </div>
            <div class="form-group">
            <label class="col-md-4 control-label">Rol:</label>
            <p class="col-md-8 form-control-static"><% $rol->nombreRol %></p>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Permisos:</label>
            <p class="col-md-8 form-control-static">

            @foreach($permisos as $permiso) 
              <%$permiso->nombrePermiso%><br>
            @endforeach
            </p>
          </div>
           <div class="col-md-4 form-group ">
              <input type="submit" name="" class="btn btn-success pull-right" value="Editar">
          </div> 
  	     </form>
  	</div>
  	</section>
    @else
      Debe estar autenticado y tener permisos para ver esta seccion
    @endif
  @endsection
  </body>
</html>
