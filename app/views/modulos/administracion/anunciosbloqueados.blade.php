@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Anuncios bloqueados</h4>
    </div>
    
    <div class="row">
    	@if (Session::has('status_error'))
			<p class="alert alert-danger alert-size">{{Session::get('status_error')}} </p>
   		@endif
   		@if (Session::has('status_ok'))
			<p class="alert alert-success alert-size">{{Session::get('status_ok')}} </p>
   		@endif
   		@if (Session::has('error_de_servidor'))
			<p class="alert alert-success alert-size">{{Session::get('error_de_servidor')}} </p>
   		@endif
   		
    	<div class="col-xs-12">
	    	<?php $i=0  ?>
	    	
	    	@if (sizeof($anuncios)==0)
	   			<div class="col-xs-12">
	      			<p class="alert alert-info alert-size">No hay anuncios bloqueados.</p>
	    		</div>
	  		@else

	  		<ul class="pagination pagination-sm">
				    <li class="disabled"><a >Total <span class="hidden-xs">de anuncios</span>: {{$anuncios->getTotal() }}</a></li>
				    <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$anuncios->getCurrentPage() }} de {{$anuncios->getLastPage() }}</a></li>
			</ul>

	    	<div class="table-responsive">
		    	<table class="table table-hover">
		    		 <thead>
				        <tr>
				               
				            <th>Codigo anuncio</th>
				            <th>Administrador</th>
				            <th>Acción</th>
				            <th>Historial</th>
				            <th class="hidden-xs">Fecha de bloqueo</th>

				        </tr>
				    </thead>
		          
			        <tbody>
			        	 @foreach ($anuncios as $anuncio)
				        <tr class="warning">
				            <td>{{ $anuncio->id}}</td>
				            


				            <td>(cod {{ $anuncio->admin }}) {{ $administradores[$i++] }} </td>
				           
				            	<td>  <a href="{{ route('admin.revisaranuncio.bloqueado', [$anuncio->seccion_title, $anuncio->id]) }}" title="Visualizar" class="btn btn-success btn-xs"> Visualizar </a>  </td>
				            
				           
				            
				            <td>  <a href="{{ route('admin.ver.historialanuncio', [$anuncio->id]) }}" title="Visualizar" class="btn btn-primary btn-xs"> Historial Completo </a>  </td>

				            <td  class="hidden-xs">{{ $anuncio->updated_at->format('j-m-Y H:i a') }}</td>
				        </tr>
			        
		    			@endforeach
		    		</tbody>	          
				</table>
			</div> <!--fin table responsive-->      
			@endif
	        {{ $anuncios->links() }}
        </div>
    </div><!--fin row-->
 	

</div><!--fin contenedor interno-->
@stop