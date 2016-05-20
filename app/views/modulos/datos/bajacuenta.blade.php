@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="text-center">
		<h2>Eliminar mi cuenta</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::model($cuenta,[route('bajacuenta',$cuenta->usuario->slug), 'method'=>'POST', 'role'=>'form', 'id'=>'bajacuenta', 'novalidate']) }}	
            	<div class="form-group">
					{{ Form::label('correo', 'Su correo asociado') }}      
            		<div>
               			
					
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
							
									'disabled'=>'disabled'
									
									
								])
					}}
					</div>
					
					{{ $errors->first('correo', '<p class="alert alert-danger alert-size espacio-superior-peq">:message</p>')}}
                </div>


                
				<div class="form-group">
				{{ Form::label('password', 'Introduzca su contraseña') }}     

            		<div>
               			
					
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
					{{ $errors->first('password', '<p class="alert alert-danger alert-size espacio-superior-peq">:message </p>') }}
					@if (Session::has('bajacuenta_error'))
           				<p class="alert alert-danger alert-size espacio-superior-peq">Contraseña incorrecta </p>
                    
                	@endif
                </div>

                
                <button type="submit" class="btn btn-primary col-xs-12 btn-success btn-separado">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> Eliminar mi cuenta
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
            form : '#bajacuenta',
            //modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,

            onSuccess : function() {

                $('#bajacuenta').find('[type="submit"]').text('Ejecutando...').addClass('disabled');
                
            },


        });
    </script>

@stop