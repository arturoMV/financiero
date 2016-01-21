<!DOCTYPE html>
@extends('layouts.master')
<html>
<head>
	@section('title', 'Tranferencias de presupuesto')
</head>
<body>
	@section('transferencia')
	class="active"
	@endsection
	@section('content')
	<section class="contenido" style="height: auto" ng-contoller="facturaTemplate">
	<br>

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
		@if(Auth::user() AND Auth::user()->tienePermiso('Agregar Transferencia', Auth::user()->id) AND date('Y') == $anno->iValor)				
		<h3>
			Agregar transferencias
		</h3>
		<p>			
		</p>

		<form class="form-horizontal" ng-controller="coordinacionTemplate" action="/transferencia/verificar" method="post" 
		ng-init="maximo">
            <input type="hidden" name="_token" value="<% csrf_token() %>">
            <div ng-repeat="a in maximo">
            	
            
			<div class="container-fluid search-container form-horizontal" ng-controller="presupuestoTemplate">
				<div class="container-fluid" ng-controller="partidaTemplate" >
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Transfererir de esta partida 
							</div>
							<div class="panel-body">
								<div class="form-group col-md-12">
									<strong>Unidad Ejecutora</strong>
									<select name="" ng-model="coorSelected" class="form-control">
										<option  ng-repeat="coordinacion in modelC" value="{{coordinacion.idCoordinacion}}">{{coordinacion.idCoordinacion}}-{{coordinacion.vNombreCoordinacion}}</option>
									</select>
								</div>
								<div class="form-group col-md-12" >
									<strong>Presupuesto</strong>

									<select name="" ng-model="pSelected" class="form-control">
										<option  ng-if="presupuesto.tCoordinacion_idCoordinacion == coorSelected" ng-repeat="presupuesto in modelPr" value="{{presupuesto.idPresupuesto}}">{{presupuesto.vNombrePresupuesto}}-{{presupuesto.anno}}</option>
									</select>
								</div>
								<strong>Partida</strong>
								<div class="form-group col-md-12">
									<select name="" ng-model="partSelected" class="form-control">
										<option ng-if="partida.tPresupuesto_idPresupuesto == pSelected" ng-repeat="partida in modelP" value="{{partida.id}}">{{partida.codPartida}}-{{partida.vNombrePartida}}</option>
									</select>
								</div>
								<div><hr>
									<div ng-if="partida.id == partSelected" ng-repeat="partida in modelP">
										<strong>Presupuesto Incial: <small>{{partida.iPresupuestoInicial | currency: "₡":0}}</small><br>
  											Presupuesto Modificado: <small>{{partida.iPresupuestoModificado | currency: "₡":0}}</small> <br>
									  		Gasto: <small>{{partida.iGasto | currency: "₡":0}} </small> <br>
									  		Saldo: <small ng-init="a.maximo = partida.iSaldo">{{partida.iSaldo | currency: "₡":0}}</small></strong><br>
											<input type="hidden" name="partidaDe" required value="{{partida.id}}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								A esta partida 
							</div>
							<div class="panel-body">
								<div class="form-group col-md-12">
									<strong>Unidad Ejecutora</strong>
									<select name="" ng-model="coorSelectedA" class="form-control">
										<option  ng-repeat="coordinacion in modelC" value="{{coordinacion.idCoordinacion}}">{{coordinacion.idCoordinacion}}-{{coordinacion.vNombreCoordinacion}}</option>
									</select>
								</div>
								<div class="form-group col-md-12" >
									<strong>Presupuesto</strong>

									<select name="" ng-model="pSelectedA" class="form-control">
										<option  ng-if="presupuesto.tCoordinacion_idCoordinacion == coorSelectedA" ng-repeat="presupuesto in modelPr" value="{{presupuesto.idPresupuesto}}">{{presupuesto.vNombrePresupuesto}}-{{presupuesto.anno}}</option>
									</select>
								</div>
								<strong>Partida</strong>
								<div class="form-group col-md-12">
									<select name="" ng-model="partSelectedA" class="form-control">
										<option ng-if="partida.tPresupuesto_idPresupuesto == pSelectedA" ng-repeat="partida in modelP" value="{{partida.id}}">{{partida.codPartida}}-{{partida.vNombrePartida}}</option>
									</select>
								</div>
								<div><hr>
									<div ng-if="partida.id == partSelectedA" ng-repeat="partida in modelP">
										<strong>Presupuesto Incial: <small>{{partida.iPresupuestoInicial | currency: "₡":0}}</small><br>
  											Presupuesto Modificado: <small>{{partida.iPresupuestoModificado | currency: "₡":0}}</small> <br>
									  		Gasto: <small >{{partida.iGasto | currency: "₡":0}} </small> <br>
									  		Saldo: <small >{{partida.iSaldo | currency: "₡":0}}</small></strong>
									  		<input type="hidden" required name="partidaA" value="{{partida.id}}">
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
        					<label class="col-md-4 control-label">Monto de Transferencia</label>
        					<div class="col-md-5">
          					<input type="number" min="0" max="{{a.maximo}}" class="form-control" required  name="iMontoTransferencia"  placeholder="Monto de Transferencia">
        					</div>
     					 {{x | currency: "₡":0}}

     					 </div>
     					 <div class="form-group">
        					<label class="col-md-4 control-label">Documento</label>
        					<div class="col-md-5">
          					<input type="text" class="form-control" name="vDocumento" required placeholder="Documento del movimiento presupuestario">
        					</div>
     					 </div>
     					 <div class="form-group">
						<input type="submit" class="btn btn-info col-md-offset-9" value="Continuar">				
					</div>
					</div>
										
				</div>
			</div>
			</div>
		</form>
		@else
			@if(date('Y') != $anno->iValor)
        		Solo se pueden agregar Transferencias al presente año. <br> 
       			Para agregar una nueva Transferenca presupuestatio debe <br><br>
       			<a href="/configuracion" class="btn btn-info">Configurar Año de Sistema</a>
    		@else
        		Debe estar autenticado y tener permisos para ver esta pagina
    		@endif
    	@endif
	</section> 
	@endsection

</body>
</html>