@extends('layouts.master')

@section('content')

<div class="wrapper col-md-10">
    <br>
    <h3>Inicio de sesion</h3>
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
    <form method="POST" class="form-horizontal" action="/auth/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-4">
                <input type="email" class="col-md-2 form-control" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@ucr.ac.cr"value="<% old('email') %>" title="El email debe ser del dominio @ucr.ac.cr">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label">Contraseña</label>
            <div class="col-md-4">
                <input type="password" class="col-md-2 col-lg-12 form-control" name="password">
            </div>
        </div>

        <div class="checkbox col-md-4 col-md-offset-4">
            <label class="control-label">
                <input type="checkbox" name="remember"> Recuérdame!
            </label>
        </div>

        <div class="checkbox col-md-4 col-md-offset-4">
            <label class="control-label">
            <a href="/password/email" class="link">¿Olvidó su contraseña?</a>
            </label>
        </div>

        <div class="col-md-4 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Iniciar Sesión
            </button>
        </div>
    </form>
</div>

@endsection