@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="text-center">
		<h2>Cambiar contraseña</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::open(['route'=>'cambiarpassword', 'method'=>'POST', 'role'=>'form', 'id'=>'cambiarpass','novalidate']) }}	            	                
				<div class="form-group">
        			{{ Form::label('actualpassword', 'Actual contraseña') }} 
					<div>
						{{ Form::password('actualpassword', 
								[
									'class' => 'form-control',
									'id'=>'validate-length',
									'title'=>'Debe introducir su contraseña actual',
									'placeholder' => 'Su contraseña actual',
									'required' => 'required',

									'data-validation'=>'length',
									'data-validation-length'=>'min8',
									
									'data-validation-error-msg'=>'Tu contraseña actual debe tener al menos 8 caracteres'





								])
						}}
						
					</div>
					

					@if (Session::has('password_error'))
           				<p class="alert alert-danger alert-size espacio-superior-peq">Contraseña incorrecta </p>
                    
                	@endif
				</div>

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
        			
        			{{ Form::label('password_confirmation', 'Repita nueva contraseña') }} 
					
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
               
                <a href="{{ route('perfil',[\Auth::user()->usuario->slug]) }}" class="btn btn-danger col-xs-12 btn-separado">
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
            form : '#cambiarpass',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {

                $('#cambiarpass').find('[type="submit"]').text('Buscando...').addClass('disabled');
                
            },

        });
    </script>
@stop