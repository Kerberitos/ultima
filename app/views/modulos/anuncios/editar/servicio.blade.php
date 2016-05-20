@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">

	<div class="text-center">
		<h2>Editar servicio</h2>
	</div>

	<div class="row">
	{{ Form::model($anuncio, ['route'=>'editarservicio', 'method'=>'PUT', 'role'=>'form','files' => true,  'id'=>'editservicio', 'novalidate']) }}		

		<div class="col-xs-12  col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10  cabeza">
			<div class="row">
				<div class="col-xs-12">
		            <div class="alert-message alert-message-info">
		                <h4>Información sobre sección y categoría</h4>
			                
				                <div class="row">
							      <div class="col-xs-12 col-sm-3 col-md-2">
							          <label>Sección:</label>
							      </div>
							 
							      <div class="col-xs-12 col-sm-6 col-md-4">
							        <p >  
							          Servicios
							        </p>
							      </div> 
							    </div>

							     <div class="row">
							      <div class="col-xs-12 col-sm-3 col-md-2">
							          <label>Categoría:</label>
							      </div>
							 
							      <div class="col-xs-12 col-sm-6 col-md-4">
							        <p >  
							          {{ $anuncio->categoria->categoria}}
							        </p>
							      </div> 
							    </div>
							    
							    <div class="row">
							      <div class="col-xs-12 col-sm-3 col-md-2">
							          <label>Subcategoría:</label>
							      </div>
							 
							      <div class="col-xs-12 col-sm-6 col-md-4">
							        <p >  
							          {{ $anuncio->subcategoria->subcategoria}}
							        </p>
							      </div> 
							    </div>
			            </div>
        			</div>
				</div><!--fin row2-->
			</div><!--fin cabeza-->				

			
			<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  cuerpo">

				<!--Aqui debe ir segmento informacion del anuncio-->

				<div class="col-xs-12 col-sm-12 col-md-6 subcuerpo-izquierda">
					@include('modulos.anuncios.editar.segmentoseditar.editinformacionanuncio')

					@include('modulos.anuncios.editar.segmentoseditar.editsegmentofotosservicios')	

				</div>	<!--fin cuerpo izquierda-->

				<div class="col-xs-12 col-sm-12 col-md-6 subcuerpo-derecha">
					<!--Aqui debe ir segmento infromacion adicional-->	
					@include('modulos.anuncios.editar.segmentoseditar.editinformacionanunciante')

					<div class="form-group">
						{{ Form::label('direccion','Dirección', ['class'=>'control-label']) }}
						<p class="informacion-adicional">La dirección es opcional</p>
						<div>
						
									
						{{ Form::textarea('direccion', null, 
							[
								'class' => 'form-control', 
								'size' => '3x1',
								'id'=>'direccion-text',
								'maxlength'=>'101',
								
								'data-validation'=>"length",
								'data-validation-length'=>"0-100",
								'data-validation-error-msg-length'=>"Máximo 100 caracteres",
							]) 
						}}
						</div>
						{{ $errors->first('direccion', '<p class="alert alert-danger errores">:message </p>') }}  
					</div>




					<!--Aqui debe ir segmento infromacion del anunciante-->							
    				
				</div>	<!--fin cuerpo derecha-->
			</div><!--fin cuerpo-->
			
			<!--input id="oculto" type="hidden" name="seccion_id" value=""-->
			<input id="oculto" type="hidden" name="anuncio" value={{$anuncio->id}}>

			<input id="oculto" type="hidden" name="seccion_id" value=2>
			<input id="oculto" type="hidden" name="categoria_id" value={{ $anuncio->categoria_id}}>
			<input id="oculto" type="hidden" name="subcategoria_id" value= {{ $anuncio->subcategoria_id}}>
			<input id="oculto" type="hidden" name="pregunta" value= {{ $pregunta->id }}>
			<div class="col-xs-12  col-sm-offset-4 col-sm-4 col-md-offset-3 col-md-6 pie">
				 <button type="submit" class="btn btn-primary col-xs-12 btn-success" data-loading-text="Creando..." id="boton-envio-registro">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> GUARDAR
				</button>
				<a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 boton-cancelar">
        		<i class="glyphicon glyphicon-remove-circle">
        		</i>
        			CANCELAR
      			</a>
			</div>
	</div><!--fin row-->
	{{ Form::close() }}

</div><!--fin contenedor-interno-->
@stop

@section('scripts')
	<script>
       $.validate({
            form : '#editservicio',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
           
            onSuccess : function() {
                $('#editservicio').find('[type="submit"]').text('Editando...').addClass('disabled');
            },
        });
    </script>

    <script>
    	 $('#descripcion-text').restrictLength( $('#max-length-element') );

	</script>

@stop