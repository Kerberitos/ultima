@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h3 class="espacio-superior-mediano">Establecer nueva contraseña</h3>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            <p class="alert alert-info centrar">Hola {{ $cuenta->usuario->nombres }} ahora establece una nueva contraseña para poder usar con normalidad tu cuenta en miradita.</p>
            {{ Form::open(['route'=>'nuevopassword', 'method'=>'POST', 'role'=>'form', 'id'=>'reactivarynewpass', 'novalidate']) }}	            	                
				<div class="form-group">
        			{{ Form::label('password', 'Nueva contraseña') }} 
					<div>
						{{ Form::password('password', 
								[
									'class' => 'form-control',
									'id'=>'validate-length',
									'title'=>'Contraseña nueva',
									'placeholder' => 'Contraseña nueva',
									'required' => 'required',

									'data-validation'=>'length',
									'data-validation-length'=>'min8',
									
									'data-validation-error-msg'=>'La contraseña debe contener al menos 8 caracteres'

								])
						}}
						
					</div>
					{{ $errors->first('password', '<p class="alert alert-danger alert-size espacio-superior-peq">:message </p>') }}
				</div>


                <div class="form-group">
        			
        			{{ Form::label('password_confirmation', 'Repite contraseña') }} 
					
					<div >
						
						{{ Form::password('password_confirmation', 
								[
									'class' => 'form-control',
									'id'=>'validate-length',
									'placeholder' => 'Repita contraseña nueva', 
									'required' => 'required',

									'data-validation'=>'confirmation',
									'data-validation-confirm'=>'password',
									'data-validation-error-msg'=>'Las contraseñas deben coincidir'



								])
						}}
						
					</div>

				</div>
                {{ Form::hidden('correo', $cuenta->correo) }}
                <button type="submit" class="btn btn-primary col-xs-12 btn-success boton-espacio">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> Guardar
				</button>
               
                <a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 boton-espacio">
        		<i class="glyphicon glyphicon-remove-circle">
        		</i>
        			Cancelar
      			</a>
           
                
				
				
				
            {{ Form::close() }}
        </div>
    </div>

</div><!--fin contenedor-interno-->
@stop


@section('scripts')
	<script>
       $.validate({
            form : '#reactivarynewpass',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {

                $('#reactivarynewpass').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

        });
    </script>
@stop