@extends('layout')
@section('contenido')
	@parent
	<div class="contenedor-interno">
	<div class="text-center">		
		<h3>Mis mensajes</h3>
	</div>
		@if(Session::has('estatus_ok'))
			<p class="alert alert-success">{{Session::get('estatus_ok')}}</p>
		@endif
		@if(Session::has('estatus_error'))
			<p class="alert alert-danger">{{Session::get('estatus_error')}}</p>
		@endif

	@if (sizeof($mensajes)==0)
    	<p class="alert alert-info"> 
    		No hay ningún mensaje en la bandeja de entrada.
    	</p>
  	@else
        <div class="contenedor-paginacion col-xs-12">
		    <ul class="pagination pagination-sm">
		        <li class="disabled">
		        	<a>Pág<span class="hidden-xs">ina Nº</span> 
		        		{{$mensajes->getCurrentPage()}} 
		        			de 
		        		{{$mensajes->getLastPage()}}
		        	</a>
		        </li>
		    </ul>
		</div>
		

  		

	<div class="col-xs-12">
		<div class="table-responsive">	
			<table class="table table-condensed">
		    <thead>
		        <tr>
		            <th colspan="5">Bandeja de entrada ({{$mensajes->getTotal()}}) - No leídos: {{$mensajesnoleidos}}</th>
		          	
		        </tr>  	
		    </thead>
		    <tbody>
    	 	@foreach ($mensajes as $mensaje)
			    <tr class="mensaje-{{$mensaje->estatus_visto}}">
		        	
		          	<td>

		          		@if($mensaje->remitente_rol == 'S' )
		        			<a href="{{route('leermensaje', [$mensaje->id])}}">
			        			 Miradita Loja
			        		</a>
		        		@else
		        			<a href="{{route('leermensaje', [$mensaje->id])}}">
			        			{{  Helper::nombre_simple($mensaje->remitente_nombre) }}
			        		</a>
		        		@endif

		        	</td>
		        	<td class="ocultar-menor-a400">
		        		<a href="{{route('leermensaje', [$mensaje->id])}}">
		        			 {{ $mensaje->remitente_roltitle }}
		        		</a>
		        	</td>

				    <td class="ocultar-menor-a600">
				    	<a href="{{route('leermensaje', [$mensaje->id])}}">
				    		{{ str_limit($mensaje->mensaje, 15) }}
				    	</a>
				    </td>
				    <td> 
				    	<a href="{{route('leermensaje', [$mensaje->id])}}">
				        	<span class="hidden-xs">
				        		{{$mensaje->created_at->format('l')}}
				        	</span>
				        		{{$mensaje->created_at->format('j M Y')}} 
				        	<span class="ocultar-menor-a400">
				        		{{$mensaje->created_at->format(', H:i a')}} 
				        	</span>	

		            	</a>
		            </td>
	            	<td>
	            		<a href="{{route('leermensaje', [$mensaje->id])}}" title="ver" class="btn btn-primary btn-xs">
	            			<i class="glyphicon glyphicon-eye-open" aria-hidden="true">
	            			</i> 
	            		</a>
			            
			            <a href="{{route('eliminarmensaje', [$mensaje->id])}}" title="eliminar" class="btn btn-danger btn-xs">
			            	<i class="glyphicon glyphicon-remove" aria-hidden="true">
			            	</i> 
			            </a>  
		 	        </td>
		        </tr>
         	@endforeach
		    </tbody>
			</table>
		</div>
	</div><!--fin div col-xs-12-->
	@endif	
	{{$mensajes->links() }}
</div><!--fin contenedor interno-->
@stop
