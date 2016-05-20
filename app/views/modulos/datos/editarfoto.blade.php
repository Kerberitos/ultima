@extends('layout')
@section('scripts')
        <script src="{{ asset('assets/js/inputsfile.js') }}"></script>
@stop

@section('contenido')
	
<div class="contenedor-interno">		
	<div class="text-center espacio-inferior-mediano">
		<h2>Foto de perfil </h2>
		
	</div>
	<div class="row">
                

        	<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4 caja-sombra form-group">

        		{{ Form::open([route('edicionfoto',$usuario->slug), 'method'=>'POST', 'files' => true, 'role'=>'form', 'id'=>'form-fotoperfil', 'novalidate']) }}
                <p id="oso" class="informacion-adicional">Subir foto con formato .jpg o .png. Que su tamaño no supere los 3MB.</p>

        	   <input id="fotoperfil" name="fotoperfil" type="file" data-show-preview="true" data-validation="size mime" data-validation-allowing="jpg, png" data-validation-max-size="3000kb" data-validation-error-msg-size="La foto de perfil es demasiado pesada (Máximo 3 MB)" data-validation-error-msg-mime="Solo imágenes formato .jpg o .png" />



        		
        		{{ $errors->first('fotoperfil', '<p class="alert alert-danger alert-size espacio-superior-peq">:message </p>')}}
                
                @if (Session::has('status_error'))
                    <p class="alert alert-danger alert-size espacio-superior-peq">{{ Session::get('status_error') }}</p>
                @endif

                @if (Session::has('error_de_servidor'))
                    <p class="alert alert-danger alert-size">Hubo un error con el servidor, si el problema persiste, comunícate con nosotros.</p>
                @endif
    		</div>

    		<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
    			

                <button id="botonsito" type="submit" class="btn col-xs-12 btn-success">
                    Guardar
                </button>

                


				<a href="{{ route('perfil',[\Auth::user()->slug]) }}" class="btn btn-danger col-xs-12 espacio-superior-peq">
        			Cancelar
      			</a>
    		</div>

			{{ Form::hidden('actualfoto', $usuario->foto)}} 
		{{ Form::close() }}

	</div><!--fin row-->
	
	
</div><!--fin contenedor-interno-->
@stop

@section('scripts2')
    <script>

        
       $.validate({
            form : '#form-fotoperfil',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
           
            onSuccess : function() {
                $('#form-fotoperfil').find('[type="submit"]').text('Guardando...').addClass('disabled');
               
            },

 
        });
    </script>

   

@stop