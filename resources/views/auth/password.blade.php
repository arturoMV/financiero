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
    <form method="POST" class="form-horizontal" action="/financiero/public/password/email">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-4">
                <input type="email" class="col-md-2 form-control" name="email" value="<% old('email') %>">
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