@extends('layouts.master')

@section('content')
<div class="col-md-2">
    
</div >
   <div class="wrapper col-md-4">   
    <form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class="form-group">
        
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div class="form-group">

    <div>
      <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="checkbox">
        <label>
        <input type="checkbox" name="remember"> Recuerdame!
        </label>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Iniciar Sesion</button>
    </div>
</form>
</div>

@endsection