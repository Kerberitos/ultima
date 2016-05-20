@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="text-center">
		<h2>Editar correo de la cuenta</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::model($cuenta,['route'=>'edicioncuenta', 'method'=>'POST', 'role'=>'form', 'id'=>'editcuenta', 'novalidate']) }}	
            	<div class="form-group">
					{{ Form::label('correo', 'Introduzca nuevo correo') }}      
            		<div>
               			
					
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su correo',

									'data-validation'=>'email',
									'data-validation-error-msg'=>'No has ingresado un correo valido',

									
									
								])
					}}
					</div>
					
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
                </div>

				<div class="form-group">
				{{ Form::label('password', 'Contraseña en Miradita Loja') }}     

            		<div>
               			<p class="informacion-adicional">Se solicita su contraseña por seguridad</p>
					
						{{ Form::password('password', 
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su contraseña',
									
									'data-validation'=>'length',
									'data-validation-length'=>'min8',
									
									'data-validation-error-msg'=>'La contraseña debe contener al menos 8 caracteres'

									
								])
					}}
					</div>
					{{ $errors->first('password', '<p class="alert alert-danger errores">:message </p>') }}
					@if (Session::has('password_error'))
           				<p class="alert alert-danger alert-size espacio-superior-peq">Contraseña incorrecta </p>
                    
                	@endif
                </div>

                {{ Form::hidden('actualcorreo', $cuenta->correo) }}


                <button type="submit" class="btn btn-primary col-xs-12 btn-success btn-separado">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> Guardar
				</button>
               
                <a href="{{ route('perfil',[\Auth::user()->usuario->slug])}}" class="btn btn-danger col-xs-12 btn-separado">
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
            form : '#editcuenta',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {

                $('#editcuenta').find('[type="submit"]').text('Guardando...').addClass('disabled');
                
            },

        });
    </script>
@stop