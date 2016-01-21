@extends('layouts.master')

@section('content')

<div class="wrapper col-md-10">
    <br>
    <h3>Restablecer contraseña</h3>
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

    @if ($mensaje) != null)
    <div class="alert alert-success">
        <strong>Bien!</strong>Se introdujo un correo válido<br><br>
        <ul>
            <li><% $mensaje %></li>
        </ul>
    </div> 
    @endif

    <form method="POST" class="form-horizontal" action="/password/email">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-4">
                <input type="email" class="col-md-2 form-control" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@ucr.ac.cr" title="El email debe ser del dominio @ucr.ac.cr" value="<% old('email') %>">
            </div>
        </div>
      
        <div class="col-md-4 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                 Enviar
            </button>
        </div>
    </form>
</div>

@endsection