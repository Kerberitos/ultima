@extends('layout')
@section('contenido')

<div class="contenedor-interno">		
	
			
	<div class="text-center espacio-inferior-mediano">
		<h4>Bienvenido a clasificados Loja</h4>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<p class="alert alert-info text-center">Ha ingresado correctamente con su red social, por favor solo necesitamos nos facilite un correo electrónico para enviar notificaciones del sistema. 
			</p>
			<p class="text-info text-center espacio-inferior-mediano">
				Considere que en Miradita Loja su correo no se publica.
			</p>	
		</div>
		
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
        	{{ Form::open(['route'=>'completarcorreo', 'method'=>'POST', 'role'=>'form', 'id'=>'correosocial']) }}	
        	<div class="form-group">
        			
        			{{ Form::label('correo', 'Tu correo') }} 
					<div>
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'id'=>'validate-email',
									'title'=>'Debe introducir su correo',
									'placeholder' => 'edroleal@dominio.com', 
									'required' => 'required',


									'data-validation'=>'email',
									'data-validation-error-msg'=>'No has ingresado un correo valido',

								])
						}}
						
					</div>
					{{ $errors->first('correo', '<p class="alert alert-danger alert-size espacio-superior-peq">:message</p>')}}
			</div>
			<div class="form-group">
                	{{ Form::label('genero', 'Género') }} 
            		
					<div>
                        <select class="form-control" name="genero" title="Seleccione su género" data-validation="required" data-validation-error-msg="Selecciona una opción" required>
                            <option value="">Seleccione su género</option>
                            <option value="male">Hombre</option>
                            <option value="fema">Mujer</option>
                        </select>
                       
						
					</div>
					{{ $errors->first('genero', '<p class="alert alert-danger alert-size espacio-superior-peq">:message</p>')}}
			</div>


			<button type="submit" class="btn btn-success col-xs-12  btn-separado">
 			 	GUARDAR
			</button>
			

            {{ Form::close() }}

		</div>
	</div>
	
       
</div>
@stop

@section('scripts')
	<script>

	
       $.validate({
            form : '#correosocial',
            //modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,

            onSuccess : function() {

                $('#correosocial').find('[type="submit"]').text('Guardando...').addClass('disabled');
                
            },


        });
    </script>

@stop