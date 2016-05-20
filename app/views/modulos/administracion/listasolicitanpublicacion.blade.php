@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Anuncios que solicitan ser publicados</h4>
    </div>
    
    <div class="row">
    	@if (Session::has('status_error'))
			<p class="alert alert-danger alert-size">{{Session::get('status_error')}} </p>
   		@endif
   		@if (Session::has('status_ok'))
			<p class="alert alert-success alert-size">{{Session::get('status_ok')}} </p>
   		@endif
    	<div class="col-offset-md-1 col-md-11">
    	<?php $i=1  ?>
    	
    	@if (sizeof($anuncios)==0)
   			<div class="col-xs-12">
      			<p class="alert alert-info alert-size">No hay anuncios por revisar.</p>
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
			            <th>#</th>
			            
			            <th>Titulo</th>
			            <th  class="hidden-xs">Sección</th>
			            <th>Estado <span class="hidden-xs">revisión</span></th>
			            <th>Acción</th>
			            <th  class="hidden-xs">Fecha creación</th>
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($anuncios as $anuncio)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			            <td>{{ strtoupper(str_limit($anuncio->titulo,20)) }}</td>
			            <td  class="hidden-xs">{{ $anuncio->seccion_title }}</td>
			             <td>{{ $anuncio->estatus_revision}}</td>
			           


			            @if(strcmp ($anuncio->estatus_revision,"libre") == 0) 

			            	@if($anuncio->usuario_id != Auth::id())
			            		<td>  <a href="{{ route('admin.revisar', [$anuncio->seccion_title, $anuncio->id]) }}" title="Revisar anuncio" class="btn btn-success btn-xs">Revisar</a>  </td>

			            	@else
			            		<td><a title="Anuncio propio" class="btn btn-danger btn-xs">Sin acceso</a></td>
			            	@endif
			            	
			            
			            @elseif(strcmp ($anuncio->estatus_revision,"ocupado") == 0 & ($anuncio->admin==\Auth::id() ) )
			            	<td>  <a href="{{ route('admin.revisar', [$anuncio->seccion_title, $anuncio->id]) }}" title="Continuar revisión" class="btn btn-info btn-xs">Retomar <span class="hidden-xs"> revisión<span></a>  </td>
			            @else
			            	<td><a title="Revisión por otro administrador" class="btn btn-primary btn-xs"> En revisión </a> </td>
			            @endif
			            
			            
			            <td class="hidden-xs">{{ $anuncio->created_at->format('j-m-Y H:i a') }}</td>
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