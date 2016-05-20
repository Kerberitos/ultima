@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h3 class="espacio-superior-mediano">Solicitar nuevo enlace</h3>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            <p class="alert alert-info alert-size text-center alert-size">Hola, por favor ingrese su correo electrónico, para enviarle un nuevo enlace de activación</p>
            
            {{ Form::open(['route'=>'nuevoenlaceactivacion', 'method'=>'POST', 'role'=>'form', 'id'=>'nuevoenlace', 'novalidate']) }}	
            	<div class="form-group">
					{{ Form::label('correo', 'Tu correo') }}      
            		<div>
               			
					
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su correo',
									'required' => 'required',
									'placeholder' => 'Correo de la cuenta', 

									'data-validation'=>'email',
									'data-validation-error-msg'=>'No ha ingresado un correo válido',

									
									
								])
						}}
						
					</div>
					@if (Session::has('noexisteusuario_error'))
           				<p class="alert alert-danger alert-size espacio-superior-peq">El correo ingresado no se encuentra asociado a ninguna cuenta, por favor verifica si se encuentra bien escrito</p>
                	@endif
					@if (Session::has('cuentaestadonodesactivada_info'))
           				<p class="alert alert-info">Su cuenta no está desactivada.</p>
                	@endif
					


					{{ $errors->first('correo', '<p class="alert alert-danger alert-size espacio-superior-peq">:message</p>')}}
                </div>
                
                
                <button type="submit" class="boton-espacio btn btn-success col-xs-12"><i class="icon-envelope-2">
        		</i> 
 			 		Enviar
				</button>
               
                <a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 boton-registro">
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
            form : '#nuevoenlace',
            //modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {

                $('#nuevoenlace').find('[type="submit"]').text('Buscando...').addClass('disabled');
                
            },

        });
    </script>
@stop