@extends('layouts.master')

@section('content')
            
@if (count($errors) > 0)
<br>
<div class="alert alert-danger">
    <strong>Oops!</strong> Hay problemas con las entradas<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li><% $error %></li>
        @endforeach
    </ul>
</div>
@endif
<div class="col-md-10">
<h3>Registro</h3>
    <form method="POST" class="form-horizontal" action="/auth/register">
        <input type="hidden" name="_token" value="<% csrf_token() %>">
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="name" value="<% old('name') %>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-4">
                <input type="email" class="col-md-2 form-control" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@ucr.ac.cr" title="El email debe ser del dominio @ucr.ac.cr" value="<% old('email') %>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Contraseña</label>
            <div class="col-md-4">
                <input type="password" class="col-md-2 col-lg-12 form-control" name="password">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Confirmar Contraseña</label>
            <div class="col-md-4">
               <input type="password" class="col-md-2 form-control" name="password_confirmation">
            </div>
        </div>

        <div class="col-md-4 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Registrarse
            </button>
        </div>
    </form>
</div>
@endsection