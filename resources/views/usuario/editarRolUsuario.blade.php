@extends('/layouts.master')

  @section('title', 'Usuario')
  @section('admU')
  class="active"
  @endsection
  @section('usuario')
  class="active"
  @endsection
  @section('content')
  @parent
  @if(Auth::user() AND Auth::user()->tienePermiso('Administrar Usuarios', Auth::user()->id))
  <!-- Contenido de editar rol Usuario -->
  <section>
    <div class="wrapper">
      <div class=" col-md-7 form-horizontal <% $count = 0 %>">
        <h3>Usuario seleccionado: <% $usuario->name %></h3>
        @foreach($rol as $rl)
       
        @if($rl->nombreRol == $rolU->nombreRol)
        <div class="panel panel-success">
          @else
          <div class="panel panel-primary">
            @endif
            <div class="panel-heading form-horizontal" style="height: 45px"  ng-init="ver<% $count%> = false">
              <div ng-show="!ver<%$count%>">
                <label class="pull-left control-label">Rol:
                  <small><%$rl->nombreRol%> </small>
                </label>
                @if($rl->nombreRol == $rolU->nombreRol)
                <label class="col-md-5 control-label">
                  <small>Rol asignado al usuario</small>
                </label> 
                @endif
              </div> 
              <button type="button" class="btn btn-xs btn-success pull-right" ng-show="!ver<%$count%>"
               ng-click="ver<%$count%> = true">+</button>
              <button type="button" class="btn btn-xs btn-danger pull-right" ng-show="ver<%$count%>"
              ng-click="ver<%$count%> = false">-</button>
              
            </div >
            <div ng-if="ver<%$count %>" class="panel-body form-horizontal">  
              <div class="form-group">
              <label class="col-md-4 control-label">Rol:</label>
              <p class="col-md-8 form-control-static">
                <%$rl->nombreRol%>
                </p class="<% $count++ %>">
            </div><div class="form-group">
              <label class="col-md-4 control-label">Permisos:</label>
              <p class="col-md-8 form-control-static">
                @foreach($permisos as $permiso)
                @if($rl->idRol == $permiso->idRol) 
                  <% $permiso->nombrePermiso %><br>
                @endif
                @endforeach
                </p class="<% $count++ %>">
            </div>
            
            
            <br>
            <button class="btn btn-success" data-toggle="modal" data-target="#seleccionar<%$rl->idRol%>">Seleccionar Rol</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#editar<%$rl->idRol%>">Editar Permisos</button>
            </div>
          </div>

          <!-- Ventana Modal de mensaje de confirmacion al seleccionar rol -->
          <form class="col-md-1" action="/usuario/<% $usuario->id %>/cambiar" method="post">
            <input type="hidden" name="_token" value="<% csrf_token() %>">
            <input type="hidden" name="idRol" value="<% $rl->idRol %>">
            <div class="modal fade" id="seleccionar<%$rl->idRol%>" role="dialog">
              <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmar</h4>
                  </div>
                  <div class="modal-body">
                    <p>¿Estas seguro de que quieres seleccionar el rol 
                      <% $rl->nombreRol%> para el usuario <% $usuario->name %>?
                    </p>
                    <input type="submit" class="btn btn-success"name="delete" value="Aceptar">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
                  </div>
                </div> 
              </div>
            </div> 
          </form>

          <!-- Ventana Modal de editar permisos de rol -->
          <form  class="form" action="/usuario/<% $rl->idRol %>/put" method="post">
            <div class="modal fade" id="editar<%$rl->idRol%>" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar rol <% $rl->nombreRol %></h4>
                    <p> Tenga en cuenta que modificar los permisos de un rol, cambia los permisos de todos los usuarios con este rol asignado</p>
                  </div>
                  <div class="modal-body col-md-offset-2">
                  {!! csrf_field() !!}
                    @foreach($permisoAll as $permiso)
                    <div>
                      <div class="col-sm-offset-2">
                        <div class="checkbox">
                          <label>
                           @if(Auth::user()->verificarPermiso($rl->nombreRol,$permiso->nombrePermiso)) 
                           <input type="checkbox" checked value="<% $permiso->idPermiso %>" 
                           name="<% $permiso->idPermiso %>">
                           <% $permiso->nombrePermiso %> 
                           @else 
                           <input type="checkbox"  value="<% $permiso->idPermiso %>" name="<% $permiso->idPermiso %>" >
                           <% $permiso->nombrePermiso %>                    
                           @endif
                         </label>
                       </div>
                     </div>
                   </div>
                   @endforeach
                 </div>
                 <div class="modal-footer">
                  <input type="submit" class="btn btn-success" value="Editar">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
              </div> 
            </div>
          </div> 
        </form>
        @endforeach
      </div>
    </div>

    <!-- Boton crear rol -->
    <div class="col-md-3">
      <br>
      <br>
      <br>
      <button type="button"data-toggle="modal" data-target="#crear" class="btn btn-info">Crear Rol</button>
    </div>

    <!-- Ventana Modal de crear rol -->
    <form  class="form-vertical" action="/usuario/rol/<% $usuario->id %>" method="post">
      {!! csrf_field() !!}
      <div class="modal fade" id="crear" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content col-md-12">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear rol </h4>
            </div>
            <div class="modal-body col-md-12">
              <div class="form-group col-md-6">
                <label>Nombre:</label>
                <input type="text" class="form-control" name="nombreRol" placeholder="Nombre del Rol">
              </div >

              <div class="form-group col-md-6">
                <label>Descripcion:</label>
                <input type="text" class="form-control" name="descripcionRol" placeholder="Descripcion del Rol">
              </div >
              <div class="col-md-12">
                @foreach($permisoAll as $permiso)
                <div class="col-sm-offset-2">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"  value="<% $permiso->idPermiso %>" name="<% $permiso->idPermiso %>">
                      <% $permiso->nombrePermiso %>                   
                    </label>
                  </div>
                </div>
                @endforeach
              </div>

            </div>
            <div class="modal-footer col-md-12">
              <input type="submit" class="btn btn-success">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
          </div> 
        </div>
      </div> 
    </form>
  </section>

  @else
  Debe estar autenticado y tener permisos para ver esta seccion
  @endif
  @endsection