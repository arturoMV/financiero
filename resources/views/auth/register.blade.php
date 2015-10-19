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

<form method="POST" action="/auth/login">
<input type="hidden" name="_token" value="{{ csrf_token() }}">  


<label class="col-md-4 control-label">Nombre</label><br>
<input type="text" class="form-control" name="name" value="{{ old('name') }}"><br>

<label class="col-md-4 control-label">Email</label><br>
<input type="email" class="form-control" name="email" value="{{ old('email') }}"><br>

<label class="col-md-4 control-label">Contraseña</label><br>
<input type="password" class="form-control" name="password"><br>

<label class="col-md-4 control-label">Confirmar Contraseña</label><br>
<input type="password" class="form-control" name="password_confirmation"><br>




<button type="submit" class="btn btn-primary">
    Register
</button>



</form>


@endsection