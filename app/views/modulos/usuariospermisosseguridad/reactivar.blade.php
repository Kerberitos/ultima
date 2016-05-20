@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h3 class="espacio-superior-mediano">Reactivar cuenta</h3>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            <p class="alert alert-info text-center alert-size">Hola, por favor ingresa tu correo electrónico, para reactivar tu cuenta. Un mensaje será enviado al correo proporcionado</p>
            
            {{ Form::open(['route'=>'reactivacioncuenta', 'method'=>'POST', 'role'=>'form', 'id'=>'reactivarcuenta', 'novalidate']) }}	
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
									'data-validation-error-msg'=>'No has ingresado un correo valido',

									
									
								])
						}}
						
					</div>
					@if (Session::has('noexisteusuario_error'))
           				<p class="alert alert-danger alert-size espacio-superior-peq">El correo ingresado no se encuentra asociado a ninguna cuenta, por favor verifique si se encuentra bien escrito</p>
                	@endif
					@if (Session::has('cuentaestadonoeliminada_info'))
           				<p class="alert alert-info alert-size espacio-superior-peq">Su cuenta no necesita reactivación.</p>
                	@endif
					


					{{ $errors->first('correo', '<p class="alert alert-danger alert-size espacio-superior-peq">:message</p>')}}
                </div>
                
                
                <button type="submit" class="boton-espacio btn btn-success col-xs-12"><i class="glyphicon glyphicon-search">
        		</i> 
 			 		Buscar
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
            form : '#reactivarcuenta',
            //modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {

                $('#reactivarcuenta').find('[type="submit"]').text('Buscando...').addClass('disabled');
                
            },

        });
    </script>
@stop