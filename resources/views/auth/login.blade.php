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
    <form method="POST" class="form-horizontal" action="/financiero/public/auth/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-4">
                <input type="email" class="col-md-2 form-control" name="email" value="<% old('email') %>">
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
                <input type="checkbox" name="remember"> Recuerdame!
            </label>
        </div>

        <div class="checkbox col-md-4 col-md-offset-4">
            <label class="control-label">
            <a href="/financiero/public/password/email" class="link">¿Olvido su contraseña?</a>
            </label>
        </div>

        <div class="col-md-4 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Iniciar Sesion
            </button>
        </div>
    </form>
</div>

@endsection