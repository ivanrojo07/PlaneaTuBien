@extends('principal')
@section('content')
<div class="card">
	<div class="card-header">
		<h5>
			Pre solicitud para {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
		</h5>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%"></div>
		</div>
	</div>
	<form method="POST" action="{{ route('prospectos.presolicitud.store',['prospecto'=>$prospecto]) }}">
		@csrf
		
		<ul class="nav nav-tabs">
		  <li class="nav-item">
		    <a class="nav-link active" href="#">SOLICITANTE</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">CÓNYUGE, CONCUBINO U  OBLIGADO SOLIDARIO</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">BENEFICIARIO</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">REFERENCIAS PERSONALES</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">RECIBO PROVISIONAL</a>
		  </li>
		</ul>
		<div class="card-body">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Apellido Paterno</label>
					<input type="text" class="form-control" name="paterno" required="" value="{{$prospecto->appaterno}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Apellido Materno</label>
					<input type="text" class="form-control" name="materno" required="" value="{{$prospecto->apmaterno}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Nombre(s)</label>
					<input type="text" class="form-control" name="nombre" required="" value="{{$prospecto->nombre}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Calle</label>
					<input type="text" class="form-control" required="" value="{{old('calle')}}" name="calle">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Número Exterior</label>
					<input type="text" class="form-control" value="{{old('numero_ext')}}" name="numero_ext" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Número Interior</label>
					<input type="text" class="form-control" value="{{old('numero_int')}}" name="numero_int">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Código Postal</label>
					<input type="text" class="form-control" value="{{old('cp')}}" name="cp" id="cp" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Colonia o Población</label>
					<select class="form-control" name="colonia" id="colonia" required="">
						<option>Seleccione una colonía ó población</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Alcaldía o Municipio</label>
					<input type="text" class="form-control" value="{{old('municipio')}}" name="municipio" id="municipio" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Estado</label>
					<input type="text" class="form-control" value="{{old('estado')}}" name="estado" id="estado" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">R.F.C.</label>
					<input type="text" class="form-control" value="{{old('rfc')}}" name="rfc" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Teléfono de Casa</label>
					<input type="text" class="form-control" value="{{old('tel_casa')}}" name="tel_casa" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Teléfono de Oficina</label>
					<input type="text" class="form-control" value="{{old('tel_oficina')}}" name="tel_oficina">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Teléfono Celular</label>
					<input type="text" class="form-control" value="{{old('tel_celular')}}" name="tel_celular" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Correo Electrónico</label>
					<input type="email" class="form-control" value="{{old('email')}}" name="email" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Fecha de Nacimiento</label>
					<input type="date" class="form-control" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento" min="{{(integer)date('Y')-64}}-{{date('m')}}-{{date('d')}}" max="{{(integer)date('Y')-18}}-{{date('m')}}-{{date('d')}}" required="" onchange="getAge(this.value)">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Lugar de Nacimiento</label>
					<input type="text" class="form-control" value="{{old('lugar_nacimiento')}}" name="lugar_nacimiento" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Nacionalidad</label>
					<input type="text" class="form-control" value="{{old('nacionalidad')}}" name="nacionalidad" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Sexo</label>
					<select class="form-control" name="sexo" required="">
						<option value="">Seleccione una opción</option>
						<option {{old('sexo') == "Masculino" ? 'selected' : ""}} value="Masculino">Masculino</option>
						<option {{old('sexo') == "Femenino" ? 'selected' : ""}} value="Femenino">Femenino</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Edad</label>
					<input type="number" class="form-control" id="edad" value="{{old('edad')}}" min="0" max="64" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Estado Civil</label>
					<select class="form-control" name="estado_civil" required="">
						<option value="">Seleccione una opción</option>
						<option {{old('estado_civil') == 'Soltero' ? 'selected' : ''}}value="Soltero">Soltero</option>
						<option {{old('estado_civil') == 'Casado' ? 'selected' : ''}}value="Casado">Casado</option>
						<option {{old('estado_civil') == 'Viudo' ? 'selected' : ''}}value="Viudo">Viudo</option>
						<option {{old('estado_civil') == 'Divorciado' ? 'selected' : ''}}value="Divorciado">Divorciado</option>
						<option {{old('estado_civil') == 'Unión Libre' ? 'selected' : ''}}value="Unión Libre">Unión Libre</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Profesión/Actividad</label>
					<input type="text" class="form-control" value="{{old('profesion')}}" name="profesion" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Empresa donde trabaja</label>
					<input type="text" class="form-control" value="{{old('empresa')}}" name="empresa">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Puesto</label>
					<input type="text" class="form-control" value="{{old('puesto')}}" name="puesto">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Antigüedad trabajo actual</label>
					<input type="text" class="form-control" value="{{old('antiguedad_actual')}}" name="antiguedad_actual" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Antigüedad trabajo anterior</label>
					<input type="text" class="form-control" value="{{old('antiguedad_anterior')}}" name="antiguedad_anterior" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Ingreso Mensual Familiar</label>
					<input type="text" class="form-control" value="{{old('ingreso_mensual')}}" name="ingreso_mensual" required="">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">¿Cómo se entero de nosotros?</label>
					<select name="enterarse" id="enterarse" required="" class="form-control">
						<option value="">Medío por el que se entero de nosotros</option>
						<option value="Internet">Internet</option>
						<option value="T.V.">T.V.</option>
						<option value="Periodico">Periodico</option>
						<option value="Otro">Otro</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" type="submit"><i class="fas fa-arrow-alt-circle-right"></i> Siguiente</button>
			</div>
		</div>

	</form>
</div>
@endsection
@push('scripts')
	<script>
		function getAge(dateString) 
		{
		    var today = new Date();
		    var birthDate = new Date(dateString);
		    var age = today.getFullYear() - birthDate.getFullYear();
		    var m = today.getMonth() - birthDate.getMonth();
		    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
		    {
		        age--;
		    }
		    $("#edad").val(age);
		    return age;
		}
		$("#cp").change(function(){
			var cp = $("#cp").val();

			$("#colonia").empty();
			$("#colonia").append("<option>Seleccione una colonía ó población</option>");
			$.ajax({
				url: `{{ url('cp') }}/${cp}`,
				dataType: 'json',
				success:function(result,status,xhr){
					console.log(result);
					let res_array = result.cp;
					res_array.forEach(function(item,index){
						var opt = `<option value="${item.poblacion}">${item.poblacion}</option>`
						$("#colonia").append(opt)
					})
				},
				error:function(xhr,status,error){
					alert(error);
				}
			});
		});
		$("#colonia").change(function(){
			var cp = $("#cp").val();
			var colonia = $("#colonia").val();
			$.ajax({
				url: `{{ url('cp') }}/${cp}/${colonia}`,
				dataType: 'json',
				success:function(result,status,xhr){
					let res = result.cp[0];
					$("#municipio").val(res.municipio);
					$("#estado").val(res.estado);
				},
				error:function(xhr,status,error){
					alert(error);
				}
			});
		});
	</script>
@endpush