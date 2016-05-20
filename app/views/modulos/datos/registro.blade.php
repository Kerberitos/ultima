@extends('layout')
@section('contenido')
	
<div class="contenedor-interno-ingresoregistro">		
	<div class="centrar-div espacio-inferior-mediano">
		<p class="titulo-ingresoregistro">Regístrate</p>
	</div>
	
	<div class="row">
		@if (Session::has('error_de_registro_servidor'))
	       	<p class="alert alert-danger alert-size">Hubo un error con el servidor, inténtalo nuevamente, si el problema persiste, comunícate con nosotros.</p>
	    @endif
	        
	    <div class="col-xs-12 col-sm-offset-2 col-sm-4">
	        {{ Form::open(['route'=>'registro', 'method'=>'POST', 'role'=>'form', 'id'=>'registration', 'novalidate']) }}	
	       	<p class="subtitulo-ingresoregistro"> Con tu correo electrónico</p>
									
				<div class="form-group">
					{{ Form::label('nombres','Nombre y apellido', ['class'=>'control-label']) }}
					<div class="">
						{{ Form::text('nombres',Input::old('nombres'),
							[
								'class' => 'form-control',
								'id' => 'nombres',
								'title' => 'Debe introducir su nombre y apellido',
								'placeholder' => 'Ejm: Edro Leal', 
								'required' => 'required',
								'pattern' => "^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,30}$",
								'data-validation' => "required custom length",
										
								'data-validation-length' => "8-30",
								'data-validation-regexp' => "^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,35}$",

								'data-validation-error-msg-required' => "Ingrese su nombre y apellido",
								'data-validation-error-msg-length' => "Mínimo 8 y máximo 30 caracteres",
								'data-validation-error-msg-custom' => "Por favor solo letras",
							])
						}}
					</div>
					{{ $errors->first('nombres', '<p class="alert alert-danger alert-size espacio-superior-peq">:message </p>') }}
				</div>
	    			
				<div class="form-group">
	       			{{ Form::label('correo', 'Tu correo', ['class' => 'control-label']) }} 
					<div>
						{{ Form::email('correo', Input::old('correo'),
							[
								'class' => 'form-control',
								'id' => 'correo',
								'title' => 'Debe introducir su correo',
								'placeholder' => 'edroleal@dominio.com', 
								'required' => 'required',
								'data-validation' => 'email',
								'data-validation-error-msg' => 'No has ingresado un correo valido',
							])
						}}
					</div>
					{{ $errors->first('correo', '<p class="alert alert-danger alert-size espacio-superior-peq">:message</p>')}}

					@if(Session::has('status_error'))
						<p class="alert alert-danger espacio-superior-peq alert-size">{{Session::get('status_error')}}</p>
					@endif
				</div>
	    			 
	       		<div class="form-group">
	       			{{ Form::label('password', 'Contraseña (No menos de 8 caracteres)', ['class'=>'control-label']) }} 
					<div>
						{{ Form::password('password', 
							[
								'class' => 'form-control',
								'required' => 'required',
								'title'=>'Debe introducir su contraseña',
								'placeholder' => 'mínimo 8 caracteres',

								'id'=>'password',
								'data-validation'=>'length',
								'data-validation-length'=>'min8',
										
								'data-validation-error-msg'=>'La contraseña debe contener al menos 8 caracteres'
							])
						}}
					</div>
					{{ $errors->first('password', '<p class="alert alert-danger alert-size espacio-superior-peq">:message </p>') }}
				</div>

				<div class="form-group">
	       			{{ Form::label('password_confirmation', 'Repite contraseña', ['class'=>'control-label']) }} 
					<div>
						{{ Form::password('password_confirmation', 
							[
								'class' => 'form-control',
								'required' => 'required',
								'placeholder' => 'Contraseña', 
							
								'data-validation'=>'confirmation',
								'data-validation-confirm'=>'password',
								'data-validation-error-msg'=>'Las contraseñas deben coincidir'
							])
						}}
					</div>
				</div>

	            <div class="form-group">
		           	{{ Form::label('genero', 'Género', ['class'=>'control-label']) }} 
	    			<div>
	                    <select class="form-control" name="genero" data-validation="required" data-validation-error-msg="Seleccione una opción" required>
	                        
	                    	<option value="">Seleccione</option>
	                    	<option value="male">Masculino</option>
	                    	<option value="fema">Femenino</option>
	                    
	                    </select>
					</div>
					{{ $errors->first('genero', '<p class="alert alert-danger alert-size espacio-superior-peq">:message </p>') }}
				</div>
				
				<div class="espacio-inferior-peq">
					<div>
						
					
						{{ Form::checkbox('politicas','si', null,
							[
								'required' => 'required',
								'data-validation' => "required",
								'data-validation-error-msg-required' => "Debe aceptar las políticas de uso del sitio",

							]) 

						}} Acepto las <a href="{{ route('politicas') }}" title="Políticas de uso de Miradita Loja" target="_blank" class="enlace"> políticas de uso </a>
					</div>
					{{ $errors->first('politicas', '<p class="alert alert-danger alert-size espacio-superior-peq">:message </p>') }}
				</div>

				<button type="submit" class="boton-espacio btn btn-primary col-xs-12 ">
			 		Registrarse
				</button>

	        {{ Form::close() }}
    	</div>
        
        <!--contenedor para social registro-->
    	<div class="col-xs-12 col-sm-offset-1 col-sm-4 contenedor-registro-social">
        	<p class="subtitulo-ingresoregistro">Ingresa con una red social</p>
        	@include('modulos.datos.segmentos.botonesregistrosocial')	
    	</div>
    </div><!--fin row-->
</div><!--fin contenedor-interno-->
@stop

@section('scripts')
	<script>
       $.validate({
            form : '#registration',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {
                $('#registration').find('[type="submit"]').text('Enviando...').addClass('disabled');
            },
        });
    </script>
@stop