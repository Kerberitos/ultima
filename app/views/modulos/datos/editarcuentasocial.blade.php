@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="text-center">
		<h2>Editar cuenta</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{-- Form::model($usuario,['route'=>'edicioncuenta', 'method'=>'POST', 'role'=>'form', 'novalidate']) --}}	
            	<div class="form-group">

					{{ Form::label('correo', $cuenta->usuario->nombres.' tu correo es') }}      
            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="glyphicon glyphicon-envelope"></span></span>
					
						{{ Form::email('correo', $cuenta->correo,
								[
									'class' => 'form-control',
									'title'=>'Correo asociado a la red social',
									'disabled'=>'disabled'
									
								])
					}}
					</div>
					

					<p class="alert alert-info alert-size espacio-superior-peq">Este correo se encuentra asociado a una red social con la que estás registrado en el sistema, por ello no puedes modificar tu correo electrónico.
					</p>	


					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
                </div>

				{{-- Form::hidden('actualcorreo', $usuario->correo) --}}


                <a href="{{ URL::previous() }}" class="btn btn-primary col-xs-12 btn-success boton-registro" data-loading-text="Enviando...">
 			 		<i class="glyphicon glyphicon-ok">
        		</i> Comprendo
				</a>
               
                
           
                
				
				
				
            {{ Form::close() }}
        </div>
    </div>

</div><!--fin contenedor-interno-->
@stop

