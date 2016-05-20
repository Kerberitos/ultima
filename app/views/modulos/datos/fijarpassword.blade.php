@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="text-center">
		<h2>Establecer contraseña</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::open(['route'=>'fijarpassword', 'method'=>'POST', 'role'=>'form', 'id'=>'fijarpass']) }}	            	                
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
					{{ $errors->first('password', '<p class="alert alert-danger errores">:message </p>') }}
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
                
                <button type="submit" class="btn btn-primary col-xs-12 btn-success btn-separado">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> Guardar
				</button>
               
                <a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 boton-registro">
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
            form : '#fijarpass',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {

                $('#fijarpass').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

        });
    </script>
@stop