@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h3>Compañeros administradores</h3>
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
    	


    	@if (sizeof($usuarios)==0 )
   			<div class="col-xs-12">
      			<p class="alert alert-info alert-size">No hay administradores en el sistema.</p>
    		</div>
  		@else

  		<ul class="pagination pagination-sm">
			    <li class="disabled"><a >Total <span class="hidden-xs">de administradores</span>: {{$usuarios->getTotal() }}</a></li>
			    <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$usuarios->getCurrentPage() }} de {{$usuarios->getLastPage() }}</a></li>
		</ul>
       @endif
        
        </div>
    </div>
    <div class="row caja-roja">
    	 @foreach ($usuarios as $usuario)
    	<div class="col-xs-12 col-sm-3 caja-admin">
    		

    		

    			@if($usuario->rol_id==2)
    				<p class="rol-admin">
					{{$usuario->rolvistoso_title}}
					</p>
				@else
					<p class="rol-admin-super">
					{{$usuario->rolvistoso_title}} ADMIN	
					</p>
				@endif	
			



    		<p class="nombre-admin text-center">{{$usuario->nombres}}</p>

    		<div class="foto-admin">
    			
    		
	    	@if($usuario->foto)
				 	<img src="{{ asset($usuario->foto) }}" class="img-responsive" alt="">

				@else
					@if($usuario->genero=='male')
						<img src="{{ asset('assets/images/usuario_hombre.png')}}" class="img-responsive" alt="">
					@else
						<img src="{{ asset('assets/images/usuario_mujer.png')}}" class="img-responsive" alt="">
					@endif
				@endif
			</div>

			<p class="genero-admin">
				{{$usuario->generoEres_title}}
			</p>
			<a href="{{ route('admin.veradministrador', [$usuario->id, $usuario->slug]) }}" title="Ver detalle de administrador" class="btn btn-success btn-xs">
				VER MÁS
			</a>
				
    	</div>
    	@endforeach
    </div>


    
    {{ $usuarios->links() }}
</div><!--fin contenedor interno-->
@stop