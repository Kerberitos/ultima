@extends('layout')
@section('contenido')

<div class="contenedor-interno">
	<div class="text-center">
		<h3>Perfil y cuenta de usuario</h3>
	</div>
    <div class="row profile">
    	@if (Session::has('cambio_password'))
         	<p class="alert alert-success alert-size">{{ Session::get('cambio_password') }}</p>
        @endif

        @if (Session::has('error_de_servidor'))
	       	<p class="alert alert-danger alert-size">Hubo un error con el servidor, si el problema persiste, comunícate con nosotros.</p>
	    @endif

	   	<div class="col-xs-12 col-sm-4 col-md-4">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					@if($usuario->foto)
				 		<img src="{{ asset($cuenta->usuario->foto) }}" class="img-responsive" alt="">

					@else
						@if($usuario->genero=='male')
							<img src="{{ asset('assets/images/usuario_hombre.png')}}" class="img-responsive" alt="">
						@else
							<img src="{{ asset('assets/images/usuario_mujer.png')}}" class="img-responsive" alt="">
						@endif
					@endif
				</div>
				
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{$usuario->nombres}}
					</div>
					<div class="profile-usertitle-genero">
						{{$usuario->rolvistoso_title}}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<a href="{{ route('edicionfoto', $usuario->slug) }}" type="button" class="btn btn-success btn-sm" id="boton-foto-perfil">Cambiar foto</a>


					<!--button type="button" class="btn btn-danger btn-sm">Message</button-->
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" id="menu-perfil">
						<li>
							<a href="">
							<i class="glyphicon glyphicon-user"></i>
							Datos generales </a>
						</li>
						<li>
							<a href="">
							<i class="glyphicon glyphicon-cog"></i>
							Mi cuenta </a>
						</li>
						<li>
							<a href="">
							<i class="glyphicon glyphicon-ok"></i>
							Deseo ser administrador </a>
						</li>
						
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>

		<div class="col-xs-12 col-sm-8 col-md-8">
            <div id="contenido-perfil">
            	<div class="tab">
            		@include('modulos.datos.segmentos.datosgenerales')
            	</div>

            	<div class="tab">
            		@include('modulos.datos.segmentos.datoscuenta')
            	</div>

            	@if($usuario->rol_id==1)
	            	@if($usuario->postulante)
	            		<div class="tab">
	            			<p class="alert alert-info alert-size">{{$usuario->nombres}} ya has enviado una solicitud</p>
	            		</div>
	            	@else
            			<div class="tab">
            				@if($configuracion->solicitudes == 'SI')
            					@include('modulos.datos.segmentos.postularparaadmin')
            				@else
            					<p class="alert alert-success alert-size">{{$usuario->nombres}} por el momento Miradita Loja no requiere de nuevos administradores</p>
            				@endif
            			</div>
	            	@endif
	            @elseif($usuario->rol_id==2 | $usuario->rol_id==3)
	            	<div class="tab">
	            		<p class="alert alert-info alert-size">Ya eres parte del equipo de administradores de miradita</p>
	            	</div>
			   	@endif
            </div>
		</div>
	</div>
</div>
@include('modales.modalenviarpostulacion')
@stop