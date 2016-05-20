@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Agenda de contactos</h4>
    </div>
    
    <div class="row">
    	@if (Session::has('agendar_error'))
			<p class="alert alert-danger alert-size">{{Session::get('agendar_error')}} </p>
   		@endif
   		@if (Session::has('agendar_ok'))
			<p class="alert alert-success alert-size">{{Session::get('agendar_ok')}} </p>
   		@endif
    		
	    	@if (sizeof($contactos)==0)
	  			@if (Session::has('status_nohaycoincidencias'))

				@else
					<div class="col-xs-12">
		      			<p class="alert alert-info alert-size">No hay contactos en la agenda</p>
		    		</div>
		   		@endif
	  		@else
	  		<div class="col-xs-12 col-sm-offset-1 col-sm-10">
		  		<ul class="pagination pagination-sm">
				    <li class="disabled"><a >Total <span class="hidden-xs">de contactos</span>: {{$contactos->getTotal() }}</a></li>
				    <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$contactos->getCurrentPage() }} de {{$contactos->getLastPage() }}</a></li>
				</ul>
			</div>	
			<div>
				<form action="{{route('miagenda')}}" method="GET" role="form">
				<div class="col-xs-12 col-sm-offset-1 col-sm-10">
				 	<a href="{{route('miagenda')}}" class="btn btn-success btn-sm btn-recargar pull-right" title="Recargar todos"><span class="icon-repeat" > </span> </a>
				 	
				</div>	
				<div class="col-xs-12 col-sm-offset-1 col-sm-3 col-md-2 espacio-inferior-peq ">
					<div >
					    <input type="text" class="form-control  input-sm" name="busqueda" placeholder="Nombre">
					</div>
				</div>	
				

				<div class="col-xs-12 col-sm-3 col-md-2 espacio-inferior-peq">
				 	<button type="submit" class="btn btn-primary btn-sm col-xs-12">Buscar</button>
				</div>
				</form>
			</div>

			@if (Session::has('status_nohaycoincidencias'))
				<div class="col-xs-12 col-sm-offset-1 col-sm-10">
					<p class="alert alert-success alert-size">{{Session::get('status_nohaycoincidencias')}} </p>	
				</div>
	   		@endif		
		<div class="col-xs-12 col-sm-offset-1 col-sm-10">
		
		@if($textobuscado!="")
			<p><span class="texto-negrita"> {{$contactos->getTotal() }} resultados para:</span> <span class="texto-azul">{{ $textobuscado }}</span></p>
		@endif
		
    	<div class="table-responsive">
	    	<table class="table">
	    		<thead>
			        <tr>
			           
			            <th>Contacto</th>
			          	
			            <th class="ocultar-menor-a400">Celular</th>
			           
			            <th>Accción </th>
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($contactos as $contacto)
			        <tr class="fila-tabla-miradita">
			            
			            
			            <td>
			            	<a href="{{route('vercontacto', [$contacto->id])}}">
		            			<span class="icon-user-2"></span>
		            			{{ ($contacto->nombre) }}
			            		
			            	</a>
			            </td>
			           
		           
			            <td class="ocultar-menor-a400">
			            	<a href="{{route('vercontacto', [$contacto->id])}}">
			            		<span class="icon-iphone"></span>
			            		{{ $contacto->celular }}
			            	</a>

			            </td>
			           
			            <td> 
			            	<a href="{{route('vercontacto', [$contacto->id])}}" title="Ver usuario" class="btn btn-success btn-xs" > 
			            		<i class="glyphicon glyphicon-eye-open" aria-hidden="true">  
	            				</i> 
	            				<span class="texto-blanco"> Ver <span class="ocultar-menor-a400">detalle</span></span>
	            			</a>
	            		</td>
			        </tr>
	    			@endforeach
	    		</tbody>	          
			</table>
		</div><!--fin table responsive-->  
		</div>
		@endif
		<div class="col-xs-12">
			{{ $contactos->appends(array("busqueda"=>Input::get("busqueda")))->links() }}	
		</div>
        
        
    </div><!--fin row-->
</div><!--fin contenedor interno-->
@stop