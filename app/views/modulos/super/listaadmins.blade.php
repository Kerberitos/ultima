@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Actuales administradores de Miradita</h4>
    </div>
    
    <div class="row">
    	@if (Session::has('status_error'))
			<p class="alert alert-danger">{{Session::get('status_error')}} </p>
   		@endif
   		@if (Session::has('status_ok'))
			<p class="alert alert-success">{{Session::get('status_ok')}} </p>
   		@endif
    	<div class="col-offset-md-1 col-md-11">
    	<?php $i=1  ?>
    	<div class="table-responsive">
	    	<table class="table table-hover">
	    		<thead>
			        <tr>
			            <th>#</th>
			            
			            
			            <th>Nombres</th>
			          	<th>Rol</th>
			            
			            <th>Acción</th>
			            
			           
			            
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($usuarios as $usuario)
		        	 	@if(Auth::id()!=$usuario->id)
					        <tr class="warning">
					            <td>{{ $i++ }}</td>
					           
					            <td>{{ strtoupper($usuario->nombres) }}</td>
					            
					            <td>{{ $usuario->rol_title }}</td>
					            
					            <td> <a href="{{route('ver.admin',[$usuario->id])}}" title="">Ver admin</a></td>
					            
					        </tr>
					       
		        		@endif
	    			@endforeach          
			</table>
		</div>       
       
        </div>
    </div>
</div><!--fin contenedor interno-->
@stop