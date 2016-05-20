@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h3 class="espacio-superior-mediano">Establecer nueva contraseña</h3>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            <p class="alert alert-info alert-size">Hola {{ $cuenta->usuario->nombres }} por favor establezca una nueva contraseña para poder acceder a su cuenta en miradita.</p>
            {{ Form::open(['route'=>'password.nuevo', 'method'=>'POST', 'role'=>'form', 'id'=>'recuperacionnewpass', 'novalidate']) }}	            	                
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
					
					<div>
						
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
            form : '#recuperacionnewpass',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {

                $('#recuperacionnewpass').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

        });
    </script>
@stop