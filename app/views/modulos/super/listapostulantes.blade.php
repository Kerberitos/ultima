@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Postulaciones para administrador</h4>
    </div>
    
    <div class="row">
    	@if (Session::has('status_error'))
			<p class="alert alert-danger">{{Session::get('status_error')}} </p>
   		@endif
   		@if (Session::has('status_ok'))
			<p class="alert alert-success">{{Session::get('status_ok')}} </p>
   		@endif
    	
    	 @if (Session::has('error_de_servidor'))
	       	<p class="alert alert-danger alert-size">Hubo un error con el servidor, si el problema persiste, comunícate con nosotros.</p>
	    @endif
	    
    	<?php $i=1  ?>

    	@if (sizeof($usuarios)==0)
			<div class="col-xs-12">
		    	<p class="alert alert-info alert-size">No hay postulantes para administrador</p>
		    </div>
	  	@else
	  	<div class="col-xs-12">
		  	<ul class="pagination pagination-sm">
			    <li class="disabled"><a >Total <span class="hidden-xs">de usuarios</span>: {{$usuarios->getTotal() }}</a></li>
			    <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$usuarios->getCurrentPage() }} de {{$usuarios->getLastPage() }}</a></li>
			</ul>
		</div>



		<div class="col-xs-12">

    	<div class="table-responsive">
	    	<table class="table">
	    		<thead>
			        <tr>
			            
			            
			            
			             <th>#</th>
			            <th>Nombres</th>
			          	<th class="ocultar-menor-a600">Rol</th>
			            <th >Correo</th>
			            <th class="hidden-xs">Estado</th>
			            <th>Accción </th>
			           
			           
			            
			        </tr>
			    </thead>
	          
		        <tbody>
		        	@foreach ($usuarios as $postulante)
			        <tr class="fila-tabla-miradita">
			            <td>
			            	<a href="{{route('ver.postulante', [$postulante->usuario->id])}}">
			            		{{ $i++ }}
			            	</a>
			            </td>
			            
			            <td>
			            	<a href="{{route('ver.postulante', [$postulante->usuario->id])}}">
		            			{{ $postulante->usuario->nombres }}
			            		
			            	</a>
			            </td>
			            <td class="ocultar-menor-a600">
			            	<a href="{{route('ver.postulante', [$postulante->usuario->id])}}">

			            		@if($postulante->usuario->rol_id==1)
			            			<span class="label label-primary texto-blanco text-center">
				            			{{ $postulante->usuario->rolvistoso_title}}
				            		</span>	
			            		@elseif($postulante->usuario->rol_id==2)
			            			<span class="label label-warning texto-blanco text-center">
				            			{{ $postulante->usuario->rolvistoso_title}}
				            		</span>	


			            		@elseif($postulante->usuario->rol_id==3)
			            			<span class="label label-danger texto-blanco text-center">
				            			{{ $postulante->usuario->rolvistoso_title}}
				            		</span>	

			            		@endif
			            	</a>
			            </td>
		           
			            <td>
			            	<a href="{{route('ver.postulante', [$postulante->usuario->id])}}">
			            		{{ $postulante->usuario->cuenta->correo }}
			            	</a>

			            </td>
			            <td class="hidden-xs">
			            	<a href="{{route('ver.postulante', [$postulante->usuario->id])}}">
			            		{{ $postulante->usuario->cuenta->estado->estado }}
			            	</a>
			            </td>
			            <td> 
			            	<a href="{{route('ver.postulante', [$postulante->usuario->id])}}" title="Ver usuario" class="btn btn-success btn-xs" > 
			            		<i class="glyphicon glyphicon-eye-open" aria-hidden="true">  
	            				</i> 
	            				<span class="texto-blanco"> Ver </span>
	            			</a>
	            		</td>
			        </tr>
	    			@endforeach
	    			</tbody>
			</table>
		</div> <!--fin div table responsive-->  
		</div>
		@endif
		<div class="col-xs-12">      
       		{{ $usuarios->links() }}
        </div>
   </div><!--fin row-->
</div><!--fin contenedor interno-->
@stop