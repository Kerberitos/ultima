@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="text-center">
		<h2>Editar datos</h2>
	</div>
	 <div class="row">
	 	
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::model($usuario,['route'=>'ediciondatos', 'method'=>'POST', 'role'=>'form','id'=>'editdatos', 'novalidate']) }}	
				<div class="form-group">

					@if($usuario->cambio==false)

						{{ Form::label('nombres','Nombre y apellido') }}
						<p class="alert alert-info">Tus nombres pueden modificarse una sola vez</p>
						<div class="input-group">
							<span class="input-group-addon success"><span class="glyphicon glyphicon-user"></span></span>
							{{Form::text('nombres', Input::old('nombres'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su nombre y apellido',
									'pattern'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,30}$",
									
									'data-validation'=>"required custom length",


									
									'data-validation-length'=>"8-30",
									'data-validation-regexp'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,35}$",

									'data-validation-error-msg-required'=>"Ingrese nombre del anunciante",
									'data-validation-error-msg-length'=>"Mínimo 8 y máximo 30 caracteres",
									'data-validation-error-msg-custom'=>"Por favor solo letras",
									



								])

							}}
						</div>
						
						{{ $errors->first('nombres', '<p class="alert alert-danger errores">:message </p>')}}
					@else
						<div class="text-center">
							<p class="mayusculas">{{$usuario->nombres}}</p>
						</div>

						
					@endif
					
				</div>

				<div class="form-group">
                	{{ Form::label('genero', 'Género') }} 
            		
					<div class="input-group">

						@if($usuario->genero=='male')
                        	<span class="input-group-addon success"><span class="icon-user-2"></span></span>
                        @else
                        	<span class="input-group-addon success"><span class="icon-user"></span></span>
                        @endif
                        
                        {{ Form::select('genero', array('fema'=>'Femenino', 'male'=>'Masculino'), $usuario->genero, array('class'=>'input form-control')) }}
                	</div>

				</div>


				<div class="form-group">
					{{ Form::label('telefono', 'Teléfono') }}      
            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="icon-phone"></span></span>
					
						{{ Form::text('telefono', Input::old('telefono'),
									[
										'class' => 'form-control',
										'title'=>'Debe introducir su teléfono',
										'placeholder'=>'Ejm: 072547750',

										'data-validation'=>"length number custom",

										'data-validation-optional'=>"true",
													
										'data-validation-length'=>"6-9",
										'data-validation-regexp'=>"[0-9]$",

										'data-validation-error-msg-length'=>"Entre 6 a 9 digitos",
										'data-validation-error-msg-number'=>"Ingrese solo digitos",
										'data-validation-error-msg-custom'=>"Ingrese solo digitos por favor",


									])
						}}
					</div>
					{{ $errors->first('telefono', '<p class="alert alert-danger errores">:message</p>')}}
                </div>

				<div class="form-group">
				{{ Form::label('celular', 'Celular') }}      
            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="glyphicon glyphicon-phone"></span></span>
					
						{{ Form::text('celular', Input::old('celular'),
									[
										'class' => 'form-control',
										'title'=>'Debe introducir su celular',
										//'placeholder'=>'Ejem: 09 6967 2916',

										'data-validation'=>"custom",

										'data-validation-regexp'=>"^0[0-9]{9}$",
										'data-validation-optional'=>"true",

										'data-validation-error-msg-custom'=>"Debe iniciar con 0, solo 10 dígitos",

									])
						}}
					</div>
					{{ $errors->first('celular', '<p class="alert alert-danger errores">:message</p>')}}
                </div>

             		

				<div class="form-group">
                	{{ Form::label('compania_id', 'Compania celular') }} 
            		
					<div class="input-group">
						<span class="input-group-addon success"><span class="glyphicon glyphicon-pushpin"></span></span>
						@if($usuario->compania_id==0)
                        	{{ Form::select('compania_id', array(''=>'Seleccione', '1'=>'Movistar', '2'=>'Claro', '3'=>'CNT'), '' , array('class'=>'input form-control')) }}
                        @else
                        	{{ Form::select('compania_id', array(''=>'-No asignar-', '1'=>'Movistar', '2'=>'Claro', '3'=>'CNT'), $usuario->compania_id, array('class'=>'input form-control')) }}
                        @endif
                        
                     
                	</div>
                	{{ $errors->first('compania_id', '<p class="alert alert-danger errores">:message</p>')}}

                	@if (Session::has('error_compania'))
						<p class="alert alert-danger alert-size espacio-superior-peq">{{Session::get('error_compania')}}</p>				       	
				    @endif
				</div>


           
                <button type="submit" class="btn btn-primary col-xs-12 btn-success btn-separado" >
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
            form : '#editdatos',
            //modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,

            onSuccess : function() {

                $('#editdatos').find('[type="submit"]').text('Guardando...').addClass('disabled');
                
            },


        });
    </script>

@stop