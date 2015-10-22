@extends('layouts.master')

@section('content')

                <h3>Register</h3>
           
                
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Oops!</strong> Hay problemas con las entradas<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-md-8">
<form method="POST" class="form-horizontal" action="/auth/register">
<input type="hidden" name="_token" value="{{ csrf_token() }}">  

    

<div class="form-group">
<label class="col-md-4 control-label">Nombre</label><br>
<input type="text" class="col-md-4 form-control" name="name" value="{{ old('name') }}">
</div>

<div class="form-group">
<label class="col-md-4 control-label">Email</label>
<input type="email" class="col-md-4 form-control" name="email" value="{{ old('email') }}">
</div>

<div class="form-group">
<label class="col-md-4 control-label">Contraseña</label>
<input type="password" class="col-md-4 form-control" name="password">
</div>

<div class="form-group">
<label class="col-md-4 control-label">Confirmar Contraseña</label>
<input type="password" class="col-md-4 form-control" name="password_confirmation">
</div>

<div class="form-group">
<button type="submit" class="btn btn-primary">
    Register
</button>
</div>
</div>
</form>


@endsection