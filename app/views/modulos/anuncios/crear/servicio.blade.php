@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">

	<div class="text-center">
		<h2>Detalles del anuncio</h2>
	</div>

	<div class="row">
	{{ Form::open(['route'=>'serviciocreado', 'method'=>'POST', 'role'=>'form','files' => true, 'id'=>'crearservicio', 'novalidate']) }}		

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
							          {{ $categoria->categoria}}
							        </p>
							      </div> 
							    </div>
							    
							    <div class="row">
							      <div class="col-xs-12 col-sm-3 col-md-2">
							          <label>Subcategoría:</label>
							      </div>
							 
							      <div class="col-xs-12 col-sm-6 col-md-4">
							        <p >  
							          {{ $subcategoria->subcategoria}}
							        </p>
							      </div> 
							    </div>
							     <div class="row">
							      <div class="col-xs-12 col-sm-3 col-md-2">
							          <label>Lo que deseas hacer:</label>
							      </div>
							 
							      <div class="col-xs-12 col-sm-6 col-md-4">
							        <p >  
							          {{ $pregunta->opcion}}
							        </p>
							      </div> 
							    </div>
							    <a href="{{ URL::route('mostrar.pasouno') }}" class="enlace" title="">Cambiar</a>


			            </div>
        			</div>
				</div><!--fin row2-->
			</div><!--fin cabeza-->				

			
			<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  cuerpo">

				<!--Aqui debe ir segmento informacion del anuncio-->
				<div class="col-xs-12 col-sm-12 col-md-6 subcuerpo-izquierda">
					@include('modulos.anuncios.crear.segmentos.informacionanuncio')
					@include('modulos.anuncios.crear.segmentos.segmentofotoservicio')	


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
								
								
								'placeholder'=>'Calle José Martí y Olmedo, 18-18 Segunda planta', 
								
								'data-validation'=>"length",
								'data-validation-length'=>"0-100",
								'data-validation-error-msg-length'=>"Máximo 100 caracteres",
							]) 
						}}
						</div>
						{{ $errors->first('direccion', '<p class="alert alert-danger errores">:message </p>') }}  
					</div>





				</div>	<!--fin cuerpo izquierda-->

				<div class="col-xs-12 col-sm-12 col-md-6 subcuerpo-derecha">
					<!--Aqui debe ir segmento infromacion adicional-->							
					
					<!--Aqui debe ir segmento infromacion del anunciante-->							
    				@include('modulos.anuncios.crear.segmentos.informacionanunciante')
				</div>	<!--fin cuerpo derecha-->
			</div><!--fin cuerpo-->
			
			<!--input id="oculto" type="hidden" name="seccion_id" value=""-->
			<input id="oculto" type="hidden" name="seccion_id" value=2>
			<input id="oculto" type="hidden" name="categoria_id" value={{ $categoria->id }}>
			<input id="oculto" type="hidden" name="subcategoria_id" value= {{ $subcategoria->id }}>
			<input id="oculto" type="hidden" value= "{{$subcategoria->subcategoria}}" name="palabras_claves" >
			<input id="oculto" type="hidden" name="pregunta" value= {{ $pregunta->id }}>
			<div class="col-xs-12  col-sm-offset-4 col-sm-4 col-md-offset-3 col-md-6 pie">
				 <button type="submit" class="btn btn-primary col-xs-12 btn-success">
 			 		<i class="glyphicon glyphicon-ok">
        		</i> CREAR ANUNCIO
				</button>
				<a href="{{ URL::route('mostrar.pasouno') }}" class="btn btn-danger col-xs-12 boton-cancelar">
        		<i class="glyphicon glyphicon-menu-left">
        		</i>
        			REGRESAR
      			</a>
			</div>
	</div><!--fin row-->
	{{ Form::close() }}

</div><!--fin contenedor-interno-->
@stop

@section('scripts')
	<script>

	
       $.validate({
            form : '#crearservicio',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
           
            onSuccess : function() {
                //alert('El formulario es valido');
                //return false; // Will stop the submission of the form

                $('#crearservicio').find('[type="submit"]').text('Guardando...').addClass('disabled');
                
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

    <script>
    	 $('#descripcion-text').restrictLength( $('#max-length-element') );

	</script>

@stop