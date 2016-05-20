@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Mensajes desde contáctanos</h4>
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
    	<?php $i=1  ?>
    	
    	@if (sizeof($anuncios)==0)
   			<div class="col-xs-12">
      			<p class="alert alert-info alert-size">No hay mensajes en sugerencias por revisar.</p>
    		</div>
  		@else

  		<ul class="pagination pagination-sm">
			    <li class="disabled"><a >Total <span class="hidden-xs">de mensajes</span>: {{$anuncios->getTotal() }}</a></li>
			    <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$anuncios->getCurrentPage() }} de {{$anuncios->getLastPage() }}</a></li>
		</ul>


    	<div class="table-responsive">
	    	<table class="table table-hover">
	    		 <thead>
			        <tr>
			            <th>#</th>
			            
			            <th>Nombres</th>
			            <th  class="hidden-xs">Motivo</th>
			            <th>Estado <span class="hidden-xs">revisión</span></th>
			            <th>Acción</th>
			            <th  class="hidden-xs">Fecha recepción</th>
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($anuncios as $anuncio)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			            <td>{{ strtoupper(str_limit($anuncio->nombres)) }}</td>



			            <td  class="hidden-xs">{{ $anuncio->motivo_title }}</td>




			            <td>{{ $anuncio->estatus_visto}}</td>
			           


			            @if(strcmp ($anuncio->estatus_visto,"libre") == 0) 
			            	<td>  <a href="{{ route('admin.revisar.msmcontactanos', [$anuncio->id]) }}" title="Revisar anuncio" class="btn btn-success btn-xs">Revisar</a>  </td>
			            
			            @elseif(strcmp ($anuncio->estatus_visto,"ocupado") == 0 & ($anuncio->admin==\Auth::id() ) )
			            	<td>  <a href="{{ route('admin.revisar.msmcontactanos', [$anuncio->id]) }}" title="Continuar revisión" class="btn btn-info btn-xs">Retomar <span class="hidden-xs"> revisión<span></a>  </td>
			            @else
			            	<td> <span class="label label-bloqueado"> En revisión </span></td>
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