@extends('layout')
@section('contenido')
	
<!--div class="contenedor-interno contenedor-crear-anuncio"-->
<div class="contenedor-interno">
	<div class="text-center espacio-inferior-mediano">
		<h2>Seleccione sección y categoría.</h2>
	</div>
	{{ Form::open(['route'=>'enviar.pasouno', 'method'=>'POST', 'role'=>'form','files' => true, 'id'=>'pasouno']) }}
	<div class="row">
		<!--div class="col-xs-12 anunciocabecera"--><!--anuncio cabecera-->
			<div class="col-xs-12  col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10  cabeza">
				<div class="row">
					<div class="col-xs-12">
						<div>
							<label><span class="texto-rojo">1. </span>Seleccione sección:</label>	
						</div>
				
						<div class="btn-group botonerasecciones" data-toggle="buttons">
							<label class="btn btn-primary btnseccion" id="btn_clasificados">
							<input class="input-opcion" value=1 type="radio" name="options" autocomplete="off">
							<span id="opcion1"></span> 
							Clasificados
							</label>
							
							<label class="btn btn-primary btnseccion" id="btn_servicios">
							<input class="input-opcion" value=2 type="radio" name="options" autocomplete="off">
							<span id="opcion2"></span>
							Servicios
							</label>
							
							<label class="btn btn-primary btnseccion" id="btn_empleos">
					    	<input class="input-opcion" value=3 type="radio" name="options" autocomplete="off">
					    	<span id="opcion3"></span> 
					    	Empleos
							</label>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6">
   						
    					<div class="form-group">
		            		<label><span class="texto-rojo">2. </span>Seleccione categoría:</label>
								<div>
			                        <select class="form-control" name="categoria" id="categoria" title="Seleccione una categoría" data-validation="required" data-validation-error-msg="Seleccione una categoría" required>
			                            <option value="">- Categorías -</option>
			                        </select>
			                       
									
								</div>
							</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
   						<div class="form-group">
		                	
		            		<label><span class="texto-rojo">3. </span>Seleccione subcategoría:</label>

							<div>
		                        <select class="form-control" name="subcategoria" id="subcategoria" title="Seleccione subcategoría" data-validation="required" data-validation-error-msg="Seleccione subcategoría" required>
		                            <option value="">- Subcategorías -</option>
		                        </select>
		                       
								
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4">
   						<div class="form-group">
		            		<label><span class="texto-rojo">4. </span>¿Qué desea hacer?:</label>
							<div>
		                        <select class="form-control" name="opcion" id="opcion_seccion" title="Seleccione opción" data-validation="required" data-validation-error-msg="Seleccione opción" required>
		                            <option value="">- Preguntas -</option>
		                        </select>
		                       
								
							</div>
						</div>
					</div>

				</div><!--fin row2-->
			</div><!--fin cabeza-->				
			
			<input id="oculto" type="hidden" name="seccion_id" value="">
			

			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4">
				 <button type="submit" class="btn btn-primary col-xs-12 btn-success">
 			 		 SIGUIENTE PASO <i class="glyphicon glyphicon-menu-right"></i>
				</button>
				<a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 boton-cancelar">
        		
        			CANCELAR
      			</a>
			</div>
	</div><!--fin row-->
	{{Form::close()}}


</div><!--fin contenedor-interno-->

@stop

@section('scripts')
	<script>
       $.validate({
            form : '#pasouno',
            modules : 'security',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            
            onSuccess : function() {
                $('#registration').find('[type="submit"]').text('Enviando...').addClass('disabled');
            },
        });
    </script>
@stop