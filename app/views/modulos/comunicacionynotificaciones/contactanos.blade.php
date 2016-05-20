
@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		

	<p class="subtitulo">CONTÁCTANOS</p>
	@if(Session::has('status_ok'))
		<p class="alert alert-success">{{Session::get('status_ok')}}</p>
	@endif
	@if(Session::has('status_error'))
		<p class="alert alert-danger">{{Session::get('status_error')}}</p>
	@endif

	<div class="col-xs-12 col-sm-offset-3 col-sm-6">
            
          
        {{ Form::open(['route'=>'contactaradmin', 'method'=>'POST', 'role'=>'form', 'id'=>'contactanos', 'novalidate']) }}	
   								
				<div class="form-group">
					{{ Form::label('nombres','Su nombre', ['class'=>'control-label']) }}
					<div class="">
						{{ Form::text('nombres',Input::old('nombres'),
								[
									'class' => 'form-control',
									'id'=>'nombres',
									'title'=>'Debe introducir su nombre y apellido',
									'placeholder' => 'Ejm: Edro Leal', 
									'required' => 'required',
									'pattern'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,30}$",

									'data-validation'=>"required custom length",
									
									'data-validation-length'=>"8-30",
									'data-validation-regexp'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,35}$",

									'data-validation-error-msg-required'=>"Ingrese su nombre y apellido",
									'data-validation-error-msg-length'=>"Mínimo 8 y máximo 30 caracteres",
									'data-validation-error-msg-custom'=>"Por favor solo letras",
									

								])

						}}
						<!--span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span-->
					</div>
					{{ $errors->first('nombres', '<p class="alert alert-danger errores">:message </p>') }}
				</div>

				<div class="form-group">
        			
        			{{ Form::label('correo', 'Su correo', ['class'=>'control-label']) }} 
        			<p class="informacion-adicional">Para poder contactarlo</p>
					<div>
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'id'=>'correo',
									'title'=>'Debe introducir su correo',
									'placeholder' => 'edroleal@dominio.com', 
									'required' => 'required',
									'data-validation'=>'email',
									'data-validation-error-msg'=>'No has ingresado un correo valido',

								])
						}}
						<!--span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span-->
					</div>
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
				</div>

				 <div class="form-group">
                	{{ Form::label('motivo', 'Motivo para escribir', ['class'=>'control-label']) }} 
            		
					<div>
                        <select class="form-control" name="motivo" data-validation="required" data-validation-error-msg="Seleccione una opción" required>
                            <option value="">Seleccione opción</option>
                            <option value="1">Hacer sugerencias</option>
                            <option value="2">Informar errores de funcionamiento</option>
                            <option value="3">No puedo activar mi cuenta</option>
                            <option value="4">Mi cuenta está bloqueada</option>
                            <option value="5">Otros</option>
                        </select>
                       
						
					</div>
					{{ $errors->first('motivo', '<p class="alert alert-danger errores">:message </p>') }}
				</div>
				
				<div class="form-group">
					{{ Form::label('mensaje','Mensaje', ['class'=>'control-label']) }}
					<div>
					<p class="informacion-adicional">Puede escribir aún <span id="max-length-element">150</span> caracteres.</p>
								
					{{ Form::textarea('mensaje', null, 
						[
							'class' => 'form-control', 
							'size' => '3x4',
							'maxlength'=>'150',

							'id'=>'descripcion-text',
							'placeholder'=>'Escriba aquí su mensaje, mínimo 20 caracteres y máximo 150', 
							'required'=>'required',

							'data-validation'=>"required length",
							'data-validation-length'=>"min20",

							'data-validation-error-msg-required'=>"Ingrese el mensaje, mínimo 20 caracteres",
							'data-validation-error-msg-length'=>"Mínimo 20 caracteres",
						]) 
					}}
					</div>
					{{ $errors->first('mensaje', '<p class="alert alert-danger errores">:message </p>') }}  
				</div>
				
				<div class="form-group">
					{{ Form::label('captcha','Verifica que eres humano', ['class'=>'control-label']) }}

					<div id="reca">{{  Recaptcha::render() }}</div>
				</div>

				
				{{ $errors->first('g-recaptcha-response', '<p class="alert alert-danger errores">:message </p>') }}
	

				<button type="submit" class="boton-espacio btn btn-primary col-xs-12 ">
 			 		Enviar
				</button>
				 {{ Form::close() }}
	</div>

</div>	
       

@stop

@section('scripts')
	<script>

	
       $.validate({
            form : '#contactanos',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
           
            onSuccess : function() {
                //alert('El formulario es valido');
                //return false; // Will stop the submission of the form

                $('#contactanos').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

 
        });
    </script>

    <script>
    	 $('#descripcion-text').restrictLength( $('#max-length-element') );

	</script>

@stop