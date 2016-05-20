@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Detalle del historial de anuncio</h4>
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
    	
    	@if (sizeof($historialAnuncio)==0)
   			<div class="col-xs-12">
      			<p class="alert alert-info alert-size">No hay acciones sobre este anuncio.</p>
    		</div>
  		@else

  		


    	<div class="table-responsive">
	    	<table class="table table-hover">
	    		 <thead>
			        <tr>
			            <th>#</th>
			            
			            <th>Fecha</th>
			            <th>Acción</th>
			            <th>Administrador</th>
			            <th>Motivo</th>
			            
			            
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($historialAnuncio as $historia)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			            <td>{{ $historia->created_at->format('j-m-Y H:i a') }}</td>
			            <td>{{ $historia->accion }}</td>
			            <td>{{ $historia->usuario->nombres }}</td>
			            <td>{{ $historia->justificacion }}</td>
			            
			        </tr>
		        
	    			@endforeach
	    		</tbody>	          
			</table>
			</div> <!--fin table responsive-->      
			@endif
	        
        </div>
    </div><!--fin row-->
</div><!--fin contenedor interno-->
@stop