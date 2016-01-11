
@extends('layouts.master')

@section('title', 'Transferencias')
@section('transferencia')
class="active"
@endsection
@section('content')
<section class="contenido">
	@if(Auth::user() AND Auth::user()->tienePermiso('Ver Transferencia'))
	<div class="container-fluid">
		<div class="col-md-12">
			<h2>Detalles de la transferencia de Presupuesto</h2>

			<h4>Documento: <small><%$transferencia->vDocumento%></small><br><br>
				Fecha: <small><%$transferencia->created_at%></small> <br><br>
				Monto Transferido: <small>{{<%$transferencia->iMontoTransferencia%>| currency: "₡":0}} </small> <br><br>
				Usuario que Realizo la transferencia: <small><%$usuario->name%></small><br><br>
				Correo del Usuario: <small><%$usuario->email%></small></h4>

		</div>
		<div class="col-md-6 form-horizontal">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Se transfirio de la partida
					@if(Auth::user()->tieneCoordinacion($coordinacionDe->idCoordinacion))
					<a href="/partida/<% $presupuesto_partidaDe->id%>" class="btn-xs btn-default pull-right" title="Ir a detalles de la Partida">Ver Partirda</a>
					@endif
				</div>
				<div class="panel-body">
					<div class="form-group col-md-12">
						<strong>Unidad Ejecutora</strong>
						<div class="col-md-12">

							<input  class="form-control" readonly value="<%$coordinacionDe->idCoordinacion%>-<%$coordinacionDe->vNombreCoordinacion%>">
						</div>
					</div>

					<div class="form-group col-md-12" >
						<strong>Presupuesto</strong>
						<div class="col-md-12">

							<input  class="form-control" readonly value="<%$presupuestoDe->vNombrePresupuesto%>-<%$presupuestoDe->anno%>">
						</div>
					</div>
					<div class="form-group col-md-12" >
						<strong>Partida</strong>
						<div class="col-md-12">
							<input  class="form-control" readonly value="<%$partidaDe->codPartida%>">
						</div>

					</div>
					<div class="form-group col-md-12" >
						<strong>Partida</strong>
						<div class="col-md-12">
							<input  class="form-control" readonly value="<%$partidaDe->vNombrePartida%>">
						</div>
					</div>
					<div>
					<h4>Estado de la partida</h4>
						<strong>Presupuesto Incial: <small>{{<%$presupuesto_partidaDe->iPresupuestoInicial%> | currency: "₡":0}}</small><br>
						Presupuesto con transferencias: <small>{{<%$presupuesto_partidaDe->iPresupuestoModificado%> | currency: "₡":0}}</small> <br>
						Gasto: <small>{{<%$presupuesto_partidaDe->iGasto%> | currency: "₡":0}} </small> <br>
						Saldo: <small>{{<%$presupuesto_partidaDe->iSaldo%> | currency: "₡":0}}</small></strong>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 form-horizontal">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Se transfirio a la Partida
					@if(Auth::user()->tieneCoordinacion($coordinacionA->idCoordinacion))
					<a href="/partida/<% $presupuesto_partidaA->id%>" class="btn-xs btn-default pull-right" title="Ir a detalles de la Partida">Ver Partirda</a>
					@endif
				</div>
				<div class="panel-body">
					<div class="form-group col-md-12">
						<strong>Unidad Ejecutora</strong>
						<div class="col-md-12">
							<input  class="form-control" readonly value="<%$coordinacionA->idCoordinacion%>-<%$coordinacionA->vNombreCoordinacion%>">
						</div>
					</div>

					<div class="form-group col-md-12" >
						<strong>Presupuesto</strong>
						<div class="col-md-12">
							<input  class="form-control" readonly value="<%$presupuestoA->vNombrePresupuesto%>-<%$presupuestoDe->anno%>">
						</div>
					</div>
					<div class="form-group col-md-12" >
						<strong class="col-md-6 control-strong">Partida</strong>
						<div class="col-md-12">
							<input  class="form-control" readonly value="<%$partidaA->codPartida%>">
						</div>
					</div>
					<div class="form-group col-md-12" >
						<strong>Partida</strong>								
						<div class="col-md-12">
							<input  class="form-control" readonly value="<%$partidaA->vNombrePartida%>">
						</div>
					</div>
					<div>
							<h4>Estado de la partida</h4>
							<strong>Presupuesto Incial: <small>{{<%$presupuesto_partidaA->iPresupuestoInicial%> | currency: "₡":0}}</small><br>
								Presupuesto Modificado: <small>{{<%$presupuesto_partidaA->iPresupuestoModificado%> | currency: "₡":0}}</small> <br>
								Gasto: <small>{{<%$presupuesto_partidaA->iGasto%> | currency: "₡":0}} </small> <br>
								Saldo: <small>{{<%$presupuesto_partidaA->iSaldo%> | currency: "₡":0}}</small></strong>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif
</section> 
@endsection
