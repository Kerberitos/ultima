
@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Respuestas denunciadas</h4>
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
    	@if (sizeof($respuestas)==0)
   			<div class="col-xs-12">
      			<p class="alert alert-info alert-size">No hay respuestas denunciadas por revisar.</p>
    		</div>
  		@else

  		<ul class="pagination pagination-sm">
			    <li class="disabled"><a >Total: {{$respuestas->getTotal() }}</a></li>
			    <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$respuestas->getCurrentPage() }} de {{$respuestas->getLastPage() }}</a></li>
		</ul>


    	<div class="table-responsive">
	    	<table class="table table-hover">
	    		 <thead>
			        <tr>
			            <th>#</th>
			            
			            <th>Respuesta</th>
			            <th>Estado</th>
			            <th class="hidden-xs">Estado revision</th>
			            <th>Acción</th>
			            
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($respuestas as $respuesta)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			            
			            <td>{{ strtoupper(str_limit($respuesta->respuesta,20)) }}</td>
			            
			            <td>{{ $respuesta->estatus }}</td>
			            <td class="hidden-xs">{{ $respuesta->estatus_revision}}</td>
			           
	            		 @if(strcmp ($respuesta->estatus_revision,"libre") == 0) 
			            	<td>  <a href="{{ route('admin.revisarrespuesta', [$respuesta->id]) }}" title="Revisar"class="btn btn-success btn-xs">Revisar</a>  </td>
			            
			            @elseif(strcmp ($respuesta->estatus_revision,"ocupado") == 0 & ($respuesta->admin==\Auth::id() ) )
			            	<td>  <a href="{{ route('admin.revisarrespuesta', [$respuesta->id]) }}" title="Revisar"class="btn btn-info btn-xs">Retomar <span class="hidden-xs">revisión</span></a>  </td>
			            @else
			            	<td> Está siendo revisado </td>
			            @endif


			        </tr>
		        
	    			@endforeach
	    		</tbody>	          
			</table>
		</div>     
		@endif  
         {{ $respuestas->links() }}
        </div>
    </div>
 	

</div><!--fin contenedor interno-->
@stop