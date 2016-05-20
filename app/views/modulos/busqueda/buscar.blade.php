@extends('layout')
@section('contenido')
<div class="contenedor-interno">
	<div class="text-center">
	    <h3>Búsqueda</h3>
	</div>
	<div class="row">
		<form action="{{route('busqueda')}}" method="GET" role="form" novalidate>


			<div class="col-xs-12 col-sm-3 col-md-3">
			{{ Form::label('busqueda','¿Qué busca?') }}
				<div>
					{{ Form::text('busqueda',$textobuscado,
						[
							'class' => 'form-control  input-sm',
							'title'=>'Palabra clave a buscar',
							'placeholder'=>'casa, celular, ...',
							'required' => 'required'
						])
					}}
					
				</div>
				<p class="informacion-adicional">Ingrese lo que desea buscar</p>
				{{ $errors->first('busqueda', '<p class="alert alert-danger errores">:message </p>') }}
			</div>



			<div class="col-xs-12 col-sm-3 col-md-3">
           		{{ Form::label('seccion', 'Sección') }} 
				<div>
                     <select class="form-control input-sm" name="seccion">
                    
                    @if($seccion==0)
                       	<option value=0 selected>Todas secciones</option>
                       	<option value=1>Clasificados</option>
                       	<option value=2>Servicios</option>
                       	<option value=3>Empleos</option>   	
                    @elseif($seccion==1)
                    	<option value=0 >Todas secciones</option>
                       	<option value=1 selected>Clasificados</option>
                       	<option value=2>Servicios</option>
                       	<option value=3>Empleos</option>
                   	@elseif($seccion==2)
                   		<option value=0 >Todas secciones</option>
                   		<option value=1 >Clasificados</option>
                       	<option value=2 selected>Servicios</option>
                       	<option value=3>Empleos</option>

                   	@elseif($seccion==3)
                   		<option value=0 >Todas secciones</option>
                   		<option value=1 >Clasificados</option>
                       	<option value=2>Servicios</option>
                       	<option value=3 selected>Empleos</option>

                   	@endif



                   	</select>
					
				</div>
				
			</div>
			
			<div class="col-xs-12 col-sm-3 col-md-3">
				
				<label class="font-white">Acción</label>
				

				<div>
					<button type="submit" class="btn btn-primary btn-sm col-xs-12 btn-success">
	 			 		<i class="glyphicon glyphicon-search">
	        			</i> BUSCAR
					</button>
				</div>
			</div>	
		

		</form>
	</div><!--fin row-->
	
	@if (Session::has('status_nohaycoincidencias'))
		<div class="col-xs-12">
			<p class="alert alert-success alert-size">{{Session::get('status_nohaycoincidencias')}} </p>	
		</div>
	@endif

	@if (sizeof($resultados)==0)

		@if (Session::has('status_nohaycoincidencias'))

		@else
			<div class="col-xs-12">
			<p class="alert alert-info alert-size">No ha realizado ninguna búsqueda</p>
			</div>
		@endif
	

	@else
	   
		<div class="contenedor-buscados">
			<p><label>Frase <span class="hidden-xs">buscada</span></label>: {{$textobuscado }}</p>
	        <p><label >Sección</label>	: {{$seccionseleccionada }}</p>
	          	
		</div>


	    <div class="contenedor-paginacion">
			
		
	     	
	      	
	      	<ul class="pagination pagination-sm">
	        	<li class="disabled"><a >Anuncios <span class="hidden-xs"> encontrados</span>: {{$resultados->getTotal() }}</a></li>
	          	<li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$resultados->getCurrentPage() }} de {{$resultados->getLastPage() }}</a></li>
	      	</ul>
		</div>
	@endif 	

	@foreach ($resultados as $resultado)
	<div class="col-xs-12 col-sm-12 col-md-12 cuadroproducto">
        <div class="row">
        	<div class="col-xs-12">
        		@if($resultado->seccion_id==1)
        			<h4><span class="label label-danger"> {{ $resultado->seccionInformativo_title}}</span></h4>

        		@elseif($resultado->seccion_id==2)
        			<h4><span class="label label-success"> {{ $resultado->seccionInformativo_title}}</span></h4>

        		@elseif($resultado->seccion_id==3)

        			<h4><span class="label label-primary"> {{ $resultado->seccionInformativo_title}}</span></h4>

        		@endif
        		





        	</div>
        	<div class="col-xs-12 fechas-anuncio">
                  <label>Publicado el:</label>
                      {{$resultado->publicaciondate->format('j/m/Y H:i')}}
            </div>
            <div class="col-xs-12 titulo-anuncio">
                    {{ mb_strtoupper(str_limit($resultado->titulo,50)) }}
            </div>

            <div class="col-xs-12">
            	@if($resultado->seccion_id==1)
                    <div>
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <label> Precio: </label> $ {{ $resultado->valor }} 
                      <label class="opcionvalor-anuncios">Precio {{($resultado->opcionvalor_title)}}</label>
                    </div>

                @elseif($resultado->seccion_id==3)

                	
                   
                    <div>
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <label> Sueldo: </label> $ {{ $resultado->valor }} 
                      <label class="opcionvalor-anuncios"> TRABAJO {{strtoupper($resultado->tipo_title)}}</label>
                    </div>
                   
                    
                

                @endif

                <p>
                	<span class="label label-info">Anunciante {{$resultado->pregunta_title}}</span>

                	<span class="label estado-producto-{{$resultado->estado}}">Es {{ $resultado->estado}}</span>
                </p>
            </div>


        	<div class="col-xs-5 col-sm-2 col-md-2">
                @if($resultado->imagen=="")
                    <img src="{{ asset('assets/images/anunciosinfoto.png')}}" class="img-responsive"  alt="">
                @else
                    <img src="{{ asset($resultado->imagen) }}" class="img-responsive" alt="">
                @endif       
            </div>

        	<div class="col-xs-7  col-sm-9 col-md-10 flotar-izquierda">
                
               
        		<div >
        			<p class="ocultar-textoa400">{{ nl2br(str_limit($resultado->descripcion,200)) }}</p>
        		</div>
                <div>
                    <?php $nombreseccion=$resultado->seccion_title ?>
                    
                      <a href="{{ route('veranuncio',[ $nombreseccion, $resultado->id ]) }}" class="botones-misanuncios btn btn-warning btn-xs" role="button">
                          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                          VER ANUNCIO
                      </a>

                </div>
            </div>
        </div><!--fin ROW-->
    </div><!--fin cuandroproducto-->
    @endforeach

    {{ $resultados->appends(array("busqueda"=>Input::get("busqueda"),"seccion"=>Input::get("seccion") ))->links() }}
</div>
@stop