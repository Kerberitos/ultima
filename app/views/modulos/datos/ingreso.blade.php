@extends('layout')
@section('contenido')
	
<div class="contenedor-interno-ingresoregistro">
	<div class="centrar-div espacio-inferior-mediano">
        
    @if (Session::has('sesion_cerrada_ok'))
      <p class="alert alert-success alertas-formingreso">Ha cerrado sesión correctamente</p>
    @endif
    
    @if (Session::has('cuentaactiva_mensaje'))
      <p class="alert alert-success alertas-formingreso">Su cuenta se ha activado correctamente, ahora ingrese con su correo y contraseña</p>
    @endif

    @if (Session::has('cuentanoactivada_mensaje'))
      <p class="alert alert-danger alertas-formingreso">Su cuenta no pudo ser activada, el enlace de activación ha expirado</p>
    @endif
        
    <div>
      <p class="titulo-ingresoregistro">Inicia sesión</p>
    </div>
	</div>

	<div class="row">
	  <div class="col-xs-12 col-sm-offset-2 col-sm-4">
             
      {{ Form::open(['route'=>'ingreso', 'method'=>'POST', 'role'=>'form', 'novalidate', 'id'=>'ingreso']) }}	
      <p class="subtitulo-ingresoregistro">Con tu correo electrónico</p>
				  			
			<div class="form-group">
        			
      	{{ Form::label('correo', 'Tu correo', ['class'=>'control-label']) }} 
				<div >
					{{ Form::email('correo', Input::old('correo'),
						[
							'class' => 'form-control',
									
									'title'=>'Debe introducir su correo',
									'placeholder' => 'edroleal@dominio.com', 
									'required' => 'required',

									'data-validation'=>'email',
									'data-validation-error-msg'=>'No has ingresado un correo valido',
								])
						}}
						
					</div>
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
				</div>
    			
        		<div class="form-group">
        			{{ Form::label('password', 'Contraseña', ['class'=>'control-label']) }} 
					<div>
						{{ Form::password('password', 
								[
									'class' => 'form-control',
									
									'title'=>'Debe introducir su contraseña',
									'placeholder' => 'Tu contraseña',
									'required' => 'required',

									'data-validation'=>'length',
									'data-validation-length'=>'min8',
									
									'data-validation-error-msg'=>'Tu contraseña debe contener al menos 8 caracteres'

								])
						}}
						
					</div>
					{{ $errors->first('password', '<p class="alert alert-danger errores">:message </p>') }}
				</div>
				@if (Session::has('login_error'))
           			<p class="alert alert-danger alert-size">Contraseña incorrecta </p>
                    
        @endif
        
        @if (Session::has('no_existe_usuario_error'))
        		<p class="alert alert-danger alert-size">No existe usuario registrado con ese correo</p>
                    
        @endif
             
                <button type="submit" class="btn btn-primary col-xs-12 btn-success boton-espacio">
 			 		Ingresar
				</button>

				<div class="col-xs-12">
               		<p class="text-center"><strong class="subtitulo-normal">¿No tienes cuenta en miradita?</strong> <a href="{{ route('registro') }}" class="enlace">Regístrate ahora</a></p>
               		<p class="text-center"><a href="{{ route('password.recuperacion') }}" class="enlace">¿Has olvidado tu contraseña?</a></p>
            	</div>
				
            {{ Form::close() }}
        </div>
         
        <!--contenedor para social registro-->
        <div class="col-xs-12 col-sm-offset-1 col-sm-4 contenedor-registro-social">
        	<p class="subtitulo-ingresoregistro">Ingresa con una red social</p>
        		@include('modulos.datos.segmentos.botonesregistrosocial')	
        </div>
    </div>

</div><!--fin contenedor-interno-->
@stop

@section('scripts')
	<script>
       $.validate({
            form : '#ingreso',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {
                 $('#ingreso').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

 

        });
    </script>
@stop