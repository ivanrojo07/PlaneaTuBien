@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Recibo'])
	<div class="card-body">
		<div class="d-flex justify-content-center mb-3">
			@if (sizeof($cotizacion->contratos()) > sizeof($presolicitud->recibos))
				{{-- true expr --}}
				<a href="{{ route('prospectos.presolicitud.recibos.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-success">Crear recibo</a>
			@else
				
			@endif
			<a href="{{ route('prospectos.presolicitud.manual',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Manual del consumidor</a>
			<a href="{{ route('prospectos.presolicitud.consentimiento_seguro',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Consentimiento de Seguro</a>
			<a href="{{ route('prospectos.presolicitud.aviso_privacidad',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Aviso de Privacidad</a>
			<a href="{{ route('prospectos.presolicitud.carta_bienvenida',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Carta de Bienvenida</a>
			<a href="{{ route('prospectos.presolicitud.cuestionario_calidad',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Cuestionario de Calidad</a>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">Número de contrato</th>
					<th scope="col">Monto</th>
					<th scope="col">Pago</th>
					<th scope="col">No.</th>
					<th scope="col">Banco</th>
					<th scope="col">Sucursal</th>
					<th scope="col">Total</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($presolicitud->recibos as $recibo)
					<tr>
						<th scope="row">{{$recibo->numero_contrato}}</th>
						<td>${{number_format($recibo->contrato->monto,2)}}</td>
						<td>{{$recibo->tipo_pago}}</td>
						<td>{{$recibo->numero}}</td>
						<td>{{$recibo->banco}}</td>
						<td>{{$recibo->sucursal}}</td>
						<td>${{number_format($recibo->total,2)}}</td>
						<td>
							<div class="d-flex justify-content-center mb-3">
								<a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">
								Imprimir Presolicitud</a>
								
						      	<a href="{{ route('prospectos.presolicitud.recibos.contrato',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Contrato</a>
						      	
						      	<a href="{{ route('prospectos.presolicitud.recibos.declaracion_salud',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Declaración de Salud</a>
						      	<a href="{{ route('recibos.checklist.index',['recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Checklist</a>
							</div>
							<div class="d-flex justify-content-center mb-3">
						      	<a href="{{ route('recibos.domiciliacion.index',['recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Formato de Domiciliación</a>
						      	<a href="{{ route('prospectos.presolicitud.recibos.ficha_deposito',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Ficha de Deposito</a>
					      	
					      		<a href="{{ route('prospectos.presolicitud.recibos.anexo_tanda',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Anexo {{$presolicitud->perfil->cotizacion->plan->nombre}}</a>
					      		<a href="{{ route('prospectos.presolicitud.recibos.anexo_tanda_clasica',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Anexo Tanda Clasica</a>
					      		<a href="{{ route('prospectos.presolicitud.recibos.anexo_inscripcion_diferida',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Anexo Inscripcion Diferida</a>
							</div>
						</td>
					</tr>
				@empty
					{{-- empty expr --}}
				@endforelse
			</tbody>
		</table>
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])
	

</div>
@endsection