
@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Comentarios denunciados</h4>
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

    	<div class="col-offset-md-1 col-md-11">
    	<?php $i=1  ?>
    	
    	@if (sizeof($comentarios)==0)
   			<div class="col-xs-12">

      			<p class="alert alert-info alert-size">No hay comentarios denunciados por revisar.</p>
			</div>    		
  		@else

  		<ul class="pagination pagination-sm">
			    <li class="disabled"><a >Total <span class="hidden-xs">de comentarios</span>: {{$comentarios->getTotal() }}</a></li>
			    <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$comentarios->getCurrentPage() }} de {{$comentarios->getLastPage() }}</a></li>
		</ul>

    	<div class="table-responsive">
	    	<table class="table table-hover">
	    		 <thead>
			        <tr>
			            <th>#</th>
			            
			            <th>Comentario</th>
			            <th>Estado</th>
			            <th class="hidden-xs">Estado revision</th>
			            <th>Acción</th>
			            
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($comentarios as $comentario)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			            
			            <td>{{ strtoupper(str_limit($comentario->comentario,15)) }}</td>
			            
			            <td>{{ $comentario->estatus }}</td>
			            <td class="hidden-xs">{{ $comentario->estatus_revision}}</td>
			           
	            		 @if(\Helper::compararCadenas($comentario->estatus_revision, "libre")) 
			            	<td>  <a href="{{ route('admin.revisarcomentario', [$comentario->id]) }}" title="Revisar" class="btn btn-success btn-xs">Revisar</a>  </td>
			            
			            @elseif(\Helper::compararCadenas($comentario->estatus_revision, "ocupado") & ($comentario->admin==\Auth::id() ) )
			            	<td>  <a href="{{ route('admin.revisarcomentario', [$comentario->id]) }}" title="Revisar" class="btn btn-info btn-xs">Retomar <span class="hidden-xs">revisión</span></a>  </td>
			            @else
			            	<td> Está siendo revisado </td>
			            @endif


			        </tr>
		        
	    			@endforeach
	    		</tbody>	          
			</table>
		</div>       
		@endif
         {{ $comentarios->links() }}
        </div>
    </div>
 	

</div><!--fin contenedor interno-->
@stop