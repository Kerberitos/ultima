@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h2>Recuperar contraseña</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            <p class="alert alert-info">Ingrese su correo, para recuperar el acceso a su cuenta.</p>
            
            {{ Form::open(['route'=>'password.recuperacion', 'method'=>'POST', 'role'=>'form', 'novalidate', 'id'=>'recuperarpass']) }}	
            	<div class="form-group">
					{{ Form::label('correo', 'Correo') }}      
            		<div>
               			
					
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su correo',
									'required' => 'required',
									'placeholder' => 'Correo de la cuenta',

									'data-validation'=>'email',
									'data-validation-error-msg'=>'No ha ingresado un correo valido',


								])
						}}
						
					</div>
					@if (Session::has('noexisteusuario_error'))
           				<p class="alert alert-danger errores">El correo ingresado no se encuentra asociado a ninguna cuenta, por favor revise si es correcto</p>
          @endif
					
					@if (Session::has('cuentanoactivada_error'))
						@if(Session::get('cuentanoactivada_error')=="eliminado")
							<p class="alert alert-danger">No existe cuenta asociada a este correo electrónico.</p>
						@elseif(Session::get('cuentanoactivada_error')=="bloqueado")
							<p class="alert alert-danger">Su cuenta en Miradita se encuentra suspendida, para mayor información, comuníquese con nosotros.</p>
						@else
							<p class="alert alert-danger">Su cuenta en miradita se encuentra desactivada, lo sentimos mucho pero no puede continuar con el proceso de recuperación de contraseña.</p>
						@endif
          @endif
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
                </div>
                
                
                <button type="submit" class="boton-espacio btn btn-success col-xs-12"><i class="glyphicon glyphicon-search">
        		</i> 
 			 		Buscar
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
            form : '#recuperarpass',
            //modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {
                //alert('El formulario es valido');
                //return false; // Will stop the submission of the form

                $('#recuperarpass').find('[type="submit"]').text('Buscando...').addClass('disabled');
                
            },

           /* onValidate : function() {
              return {
                element : $('#some-input'),
                 message : 'This input has an invalid value for some reason'
              }
            },*/

            /*onElementValidate : function(valid, $el, $form, errorMess) {
              console.log('Input ' +$el.attr('name')+ ' is ' + ( valid ? 'VALID':'NOT VALID') );
            }*/

        });
    </script>
@stop